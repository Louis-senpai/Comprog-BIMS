<?php 

// CREATE TABLE `Accounts` (
//     `id` int(11) NOT NULL AUTO_INCREMENT, `username` varchar(20) NOT NULL, `password` varchar(20) NOT NULL, `email` varchar(50) NOT NULL, `created_at` timestamp NOT NULL DEFAULT current_timestamp(), `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), PRIMARY KEY (`id`)
// ) ENGINE = InnoDB AUTO_INCREMENT = 15 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci

require_once 'userActivityLogs.php';







// Make a Accounts Model that uses the Accounts Table to get data
class Accounts extends MysqliDb {

        protected $tableName = 'accounts';
        protected $primaryKey = 'id';
        protected $activityLogger;

        protected $smtp;

    
        public function __construct($conn) {
            parent::__construct($conn);
            $this->activityLogger = new UserActivityLogs($conn);
           
           
        }
    
        public function registerUser($username, $password, $repeatPassword, $email) {
            // Check if the passwords match
            if ($password !== $repeatPassword) {
                $_SESSION['error_message'] = "Passwords do not match.";
                header('Location: signup.php');
                exit();
            }
    
            // Check if the email is already used
            $this->where('email', $email);
            if ($this->has($this->tableName)) {
                $_SESSION['error_message'] = "Email is already in use.";
                header('Location: signup.php');
                exit();
            }   
    
            // Hash the password for security
            $hashedPassword = md5($password);
            $permisions = array();
            $emailNotifs = array();
            $notifs = array();
            // Prepare the user data
            $data = Array (
                "username" => $username,
                "password" => $hashedPassword,
                "email" => $email,
                "role" => "none",
                "permissions" => json_encode($permisions),
                "verified" => 0,
                "email_notifications" => json_encode($emailNotifs),
                "notifications" => json_encode($notifs)
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
                $_SESSION['error_message'] = "Registration failed: " + $this->getLastError();
                header("Location: signup.php");
                exit();
            }
        }
        public function updateEmailNotif($emailNotifsJson, $id){
            $this->where('id', $id);
            $data = Array (
                "email_notifications" => $emailNotifsJson
            );
            $this->update($this->tableName, $data);

        }
        public function updatePushNotif($pushNotifs, $id){
            $this->where('id', $id);
            $data = Array (
                "notifications" => $pushNotifs
            );
            $this->update($this->tableName, $data);
        }
      
        public function registerWithAdmin($username, $password, $repeatPassword, $permission, $email, $role) {
            // Check if the passwords match
            if ($password !== $repeatPassword) {
                $_SESSION['error_message'] = "Passwords do not match.";
                header('Location: /admin/addAccounts.php');
            }
    
            // Check if the email is already used
            $this->where('email', $email);
            if ($this->has($this->tableName)) {
                $_SESSION['error_message'] = "Email is already in use.";
                header('Location: /admin/addAccounts.php');
            }
    
            // Hash the password for security
            $hashedPassword = md5($password);
            $emailNotifs = array();
            $notifs = array();
            // Prepare the user data
            $data = Array (
                "username" => $username,
                "password" => $hashedPassword,
                "email" => $email,
                "role" => $role,
                "permissions" => $permission,
                "verified" => 1,
                "email_notifications" => json_encode($emailNotifs),
                "notifications" => json_encode($notifs)
            );
    
            // Insert the user data into the database
            $id = $this->insert($this->tableName, $data);
    
            if ($id) {
                // If the insert was successful, redirect to the addAccount page with a success message
                $_SESSION['success_message'] = "Account successfully created!";
                
            } else {
                // Handle error case
                $_SESSION['success_message'] = "Registration failed: " + $this->getLastError();
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
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['permissions'] = json_decode($user['permissions']);
                    $_SESSION['image_url'] = $user['image_url'];
                    $_SESSION['emailNotifs'] = json_decode($user['email_notifications']);
                    $_SESSION['notifications'] = json_decode($user['notifications']);
                    
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
        public function updateProfileImage($userId, $imageName){
            $this->where('id', $userId);
            $data = Array (
                "image_url" => $imageName
            );
            if ($this->update('Accounts', $data)){
                return true;
            } else {
                return false;
            }
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
        // delete the account
        public function deleteAccount($id){
            $this->where('id', $id);
            if ($this->delete($this->tableName)){
                return true;
            } else {
                return false;
            }
        }

 
        public function verifyRole($role){
           
            if ($_SESSION['role'] === $role){
                return true;
            } else {
                return false;
            }
        }
        public function notVerifyRole($role){
            if ($_SESSION['role']!= $role){
                return true;
            } else {
                return false;
            }
        }
        public function getPaginatedSurveys($limit, $offset, $searchTerm) {
            if (!empty($searchTerm)) {
                // Assuming you want to search in the FirstName and LastName columns.
                // You can add more columns to the search condition as needed.
                $this->where('username', '%' . $searchTerm . '%', 'LIKE');
                $this->orWhere('email', '%' . $searchTerm . '%', 'LIKE');
            }
            
            // Enable pagination with totalCount for the pagination calculation
            $this->withTotalCount();
            
            // Get the results from the database
            $results = $this->get($this->tableName, [$offset, $limit]);
            
            // Return the results and the total count for pagination
            return [
                'results' => $results,
                'totalCount' => $this->totalCount
            ];

        }
        public function getTotalAccounts(){
            return $this->getValue($this->tableName, "count(id)");
        }
        // a function that update the verify column to 1
        public function verifyAccount($id){
            $this->where('id', $id);
            $data = Array (
                "verified" => 1
            );
            if ($this->update('Accounts', $data)){
                return true;
            } else {
                return false;
            }
        }
        //function that verify the permission of the user in the session and the permission that is passed in the parameter, the permission session is in array format
        public function verifyPermission($permission){
            if (in_array($permission, $_SESSION['permissions'])) {
                return true;
            } else {
                return false;
            }
        }
        public function veirfyNotifPermission($permission){
            if (!in_array($permission, $_SESSION['emailNotifs'])) {
                return true;
            } else {
                return false;
            }
        }
        public function getAccountsForNotification($permission) {
            $accounts = $this->get($this->tableName);
            $accountsWithPermission = [];
        
            foreach ($accounts as $account) {
                $permissions = json_decode($account['permissions'], true);
                if (in_array($permission, $permissions)) {
                    $accountsWithPermission[] = $account;
                }
            }
        
            return $accountsWithPermission;
        }
        

        
    }

    

   

?>