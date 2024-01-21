<?php 
require_once 'config.php';  
require_once 'vendor/autoload.php';
require_once 'models/accounts.php';
require_once 'models/settings.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$Settings = new Settings('settings.json');
session_start();

// Function to insert the code into the Codes table
function insertOrUpdateCode($code, $account_id) {
    global $conn;
    // Check if there's already a code for this account_id
    $stmt = $conn->prepare("SELECT * FROM Codes WHERE account_id = ?");
    $stmt->bind_param("i", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // If a code exists, update it
        $stmt = $conn->prepare("UPDATE Codes SET code = ? WHERE account_id = ?");
        $stmt->bind_param("si", $code, $account_id);
    } else {
        // If no code exists, insert a new one
        $stmt = $conn->prepare("INSERT INTO Codes (code, account_id) VALUES (?, ?)");
        $stmt->bind_param("si", $code, $account_id);
    }
    $stmt->execute();
    $stmt->close();
}

// Function to find an account by email
function findAccountByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Accounts WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

$SMTP = $Settings->getSMTP();

// Check if the email form has been submitted
if (isset($_POST['forgot'])) {
    $email = $_POST['email'];
    
    // Check if the email exists in the Accounts table
    $account = findAccountByEmail($email);
    
    if ($account) {
        // Generate a random 6-digit code
        $code = mt_rand(100000, 999999);
        
        // Send the code to the user's email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host       =  $SMTP['host'];// Set the SMTP server to send through
            $mail->SMTPAuth   = true;
            $mail->Username   = $SMTP['user'];; // SMTP username
            $mail->Password   = $SMTP['password']; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = $SMTP['port'];
            
            // Recipients
            $mail->setFrom($Settings->get('websiteEmail'), $Settings->get('name'));
            $mail->addAddress($email); // Add a recipient
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your Password Reset Code';
            $mail->Body    = 'Your password reset code is: ' . $code;
            
            $mail->send();
            $_SESSION['code_sent'] = true;
        } catch (Exception $e) {
            $_SESSION['email_error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
        // Insert the code into the Codes table
        $account_id = $account['id']; // Assuming the account's ID is in the 'id' field
        insertOrUpdateCode($code, $account_id);
        
        // Store the account ID in the session to use later
        $_SESSION['reset_account_id'] = $account_id;
        

     
    
    } else {
        $_SESSION['email_error'] = 'Email not found';
    }
}

if(isset($_POST['code'])){
    verifyCode();

}
function verifyCode(){
    global $conn;
    $code = $_POST['code'];
    $account_id = $_SESSION['reset_account_id'];
    $stmt = $conn->prepare("SELECT * FROM Codes WHERE code = ? AND account_id = ?");
    $stmt->bind_param("si", $code, $account_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['reset_success'] = true;
        header("Location: reset_password.php");
    } else {
        $_SESSION['code_error'] = 'Incorrect Code';
        header("Location: forgot.php");
    }
}
$filename = basename($_SERVER['PHP_SELF']);
$filename = substr($filename, 0, -4);

?>

<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIMS | <?php echo $filename;?></title>
    <script src="js/tailwind.config.js"></script>
    <script src="js/tailwindcss.js"></script>
</head>
<body class="">
<section class="bg-gray-200 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-16 mr-2" src="includes/images/logo1.png" alt="logo">
          BIMS    
      </a>
      <?php 
      if (!isset($_POST['forgot'])){
      ?>
      <div class="w-full p-6 bg-white rounded-lg shadow-lg dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
      <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                Forgot your password?
            </h2>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                Don't fret! Just type in your email and we will send you a code to reset your password!
            </p>
          <?php if (isset($_SESSION['email_error'])) {
        echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium"> alert!</span> '.$_SESSION['email_error'].'
      </div>';
      }
        ?>
          <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="forgot.php" method="post">
              <div>
                  <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                  <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
              </div>
              
              <button type="submit" name="forgot" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset passwod</button>
          </form>
          <a href="index.php" class="text-blue-500"> go back</a>
      </div>
      <?php 
      } if(isset($_SESSION['code_sent'])) {

      ?>
      <div class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
      <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
         Input the Code
      </h2>
      <?php if (isset($_SESSION['code_error'])){
        echo '<div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <span class="font-medium"> alert!</span> Incorrect Code and try again.
      </div>';
      }
        ?>
      <form class="mt-4 space-y-4 lg:mt-5 md:space-y-5" action="forgot.php" method="post">
          <div>
              <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">6 digit Code</label>
              <input type="text" name="code" id="code" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="6 digit code" required="">
          </div>
         
          <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset passwod</button>
      </form>
  </div>
      <?php
      }
      ?>
  </div>
</section>
</html>