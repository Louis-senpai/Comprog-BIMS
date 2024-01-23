<?php 
require '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
echo $GLOBALS['a'];
// make a Email class that exdends the PHPMailer class and let me use easy functions
class Gmail extends PHPMailer {

    // private variables
    private $email;
    private $password;
    private $host;
    private $port;
    private $user;
    private $name;
    private $subject;

    private $Settings;

    // construct function
    public function __construct($email, $password, $host, $port, $user, $name) {
        parent::__construct();

        $this->Settings = new Settings();
        $this->email = $email;
        $this->password = $password;
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->name = $name;
        $this->isSMTP();
        $this->Host = $this->host;
        $this->SMTPAuth = true;
        $this->Username = $this->user;
        $this->Password = $this->password;
        $this->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->Port = $this->port;
        $this->setFrom($this->user, $this->name);
    }
    // send a email to marianolouis18@gmail.com
    public function sendPushNotif($email, $name, $body, $title) {
        $this->addAddress($email, $name);
        $this->AltBody = $body;
        $this->Subject = $this->name.' | '. $title;
        $this->Body = $body;
        if (!$this->send()) {
            return false;
        } else {
            return true;
        }
    }
    public function sendNewResidentNotification($recipientEmail, $recipientName, $residentName) {
        $this->addAddress($recipientEmail, $recipientName);
        $this->Subject = 'New Resident Added';
        $this->Body = "Hello {$recipientName},\n\nA new resident named {$residentName} has been added.";
        $this->AltBody = "Hello {$recipientName}, A new resident named {$residentName} has been added.";

        if (!$this->send()) {
            return false;
        } else {
            return true;
        }
    }
    
    
    


    
}

$smtp1 = $Settings->getSMTP();

$host = $smtp1['host'];
$port = $smtp1['port'];
$user = $smtp1['user'];
$password = $smtp1['password'];
$name = $Settings->get('name');
$subject = 'Your Password Reset Code';

$email = new Gmail($Settings->get('websiteEmail'), $password, $host, $port, $user, $name, $subject);

// if($email->sendPushNotif('marianolouis18@gmail.com', 'name')){
//     echo "Email sent!";
// }else{
//     echo "Email not sent";
// }


?>