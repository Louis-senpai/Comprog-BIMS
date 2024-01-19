<?php 

// CREATE TABLE `Accounts` (
//     `id` int(11) NOT NULL AUTO_INCREMENT, `username` varchar(20) NOT NULL, `password` varchar(20) NOT NULL, `email` varchar(50) NOT NULL, `created_at` timestamp NOT NULL DEFAULT current_timestamp(), `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), PRIMARY KEY (`id`)
// ) ENGINE = InnoDB AUTO_INCREMENT = 15 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci

require_once 'userActivityLogs.php';

// Make a Accounts Model that uses the Accounts Table to get data
class Accounts extends MysqliDb {

        protected $tableName = 'Accounts';
        protected $primaryKey = 'id';
        protected $activityLogger;
        public function __construct($conn) {
            parent::__construct($conn);
            $this->activityLogger = new UserActivityLogs($conn);
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
        public function registerWithAdmin($username, $password, $repeatPassword, $permission, $email, $role) {
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
                "email" => $email,
                "role" => $role,
                "permission" => $permission
            );
    
            // Insert the user data into the database
            $id = $this->insert($this->tableName, $data);
    
            if ($id) {
                // If the insert was successful, redirect to the addAccount page with a success message
                $_SESSION['success_message'] = "Account successfully created!";
                header("Location: addAccount.php");
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
                    $this->activityLogger->logActivity($user['id'], "User {$user['username']} has loged in logged in");
                    header("Location: /admin/home.php");
                    exit();
                } else {
                    // Password is incorrect, set an error message
                    $_SESSION['error_message'] = "Incorrect password!";
                    header("Location: index.php");
                    exit();
                } 
            } else {
                // Email does not exist, set an error message
                $_SESSION['error_message'] = "Email does not exist! Please register.";;
                header("Location: index.php");
                exit();
            }
        }

        public function UpdatePassword($id, $password){
            $hashedPassword = md5($password);
            $this->where('id', $id);
            if ($this->update('Accounts', ['password' => $hashedPassword])){
                return true;
            } else {
                return false;
            }
            
        }
        public function logoutUser($userId, $username) {
            // Clear the session or perform other logout operations
            $this->activityLogger->logActivity($userId, "User $username has logged out");
            session_destroy();
            header('Location: ../index.php');
            // Log the logout activity
            
        }

        public function getAccount($id) {
            $this->where('id', $id);
            $account = $this->getOne($this->tableName);
            return $account;
        }

        // a update functions that will update the account from the form and has a array of selected permissions
        public function updateAccount($id, $username, $email, $permissions, $role){
            $this->where('id', $id);
            $data = Array (
                "username" => $username,
                "email" => $email,
                "role" => $role,
                "permissions" => $permissions
            );
            if ($this->update('Accounts', $data)){
                return true;
            } else {
                return false;
            }
        }
        

        
    }

    

   

?>