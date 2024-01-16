<?php 

// CREATE TABLE `Accounts` (
//     `id` int(11) NOT NULL AUTO_INCREMENT, `username` varchar(20) NOT NULL, `password` varchar(20) NOT NULL, `email` varchar(50) NOT NULL, `created_at` timestamp NOT NULL DEFAULT current_timestamp(), `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), PRIMARY KEY (`id`)
// ) ENGINE = InnoDB AUTO_INCREMENT = 15 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci

$db1 = new MysqliDb($conn);

// Make a Accounts Model that uses the Accounts Table to get data
class Accounts extends MysqliDb {

        protected $tableName = 'Accounts';
        protected $primaryKey = 'id';
    
        public function __construct($conn) {
            parent::__construct($conn);
        }
    
        public function registerUser($username, $password, $repeatPassword, $email) {
            // Check if the passwords match
            if ($password !== $repeatPassword) {
                return "Passwords do not match.";
            }
    
            // Check if the email is already used
            $this->where('email', $email);
            if ($this->has($this->tableName)) {
                return "Email is already in use.";
            }
    
            // Hash the password for security
            $hashedPassword = md5($password);
    
            // Prepare the user data
            $data = Array (
                "username" => $username,
                "password" => $hashedPassword,
                "email" => $email
            );
    
            // Insert the user data into the database
            $id = $this->insert($this->tableName, $data);
    
            if ($id) {
                // If the insert was successful, redirect to the index page with a success message
                $_SESSION['success_message'] = "Account successfully created!";
                header("Location: index.php");
                exit();
            } else {
                // Handle error case
                return "Registration failed: " + $this->getLastError();
            }
        }
        public function loginUser($email, $password) {
            // Check if the email exists in the database
            $this->where('email', $email);
            $user = $this->getOne($this->tableName);

            $hashedPassword = md5($password);
            
            if ($user) {
                // Verify the password with the hashed password in the database
                if ($hashedPassword === $user['password']) {
                    // Password is correct, set session variables
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['logged_in'] = true;
                    
                    // Set a success message
                    $_SESSION['success_message'] = "You have successfully logged in!";
                    // Redirect to the dashboard or home page
                    header("Location: /admin/home.php");
                    exit();
                } else {
                    // Password is incorrect, set an error message
                    $_SESSION['error_message'] = "Incorrect password! $hashedPassword";
                    header("Location: index.php");
                    exit();
                } 
            } else {
                // Email does not exist, set an error message
                $_SESSION['error_message'] = "Email does not exist!";
                header("Location: index.php");
                exit();
            }
        }
        
    }

    

   

?>