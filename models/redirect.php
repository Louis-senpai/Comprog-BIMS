<?php 
// a class that checks users role and permission if they have access to a page 
class Authentication extends MysqliDb{
    public $conn;
    public $settings;
    public $user_id;
    public $username;
    public $email;
    public $role;
    public $permissions;
    public $verified;
    public $email_notifications;
    public $notifications;
    public $activityLogger;
    public function __construct($conn, $settings, $user_id) {
        $this->conn = $conn;
        $this->settings = $settings;
        $this->user_id = $user_id;
        $this->activityLogger = new UserActivityLogs($conn);
        $this->loadUser();
    }
    public function loadUser() {
        $this->where('id', $this->user_id);
        $user = $this->getOne('Accounts');
        $this->username = $user['username'];
        $this->email = $user['email'];
        $this->role = $user['role'];
        $this->permissions = json_decode($user['permissions']);
        $this->verified = $user['verified'];
        $this->email_notifications = json_decode($user['email_notifications']);
        $this->notifications = json_decode($user['notifications']);
    }

    // function that check if user's role and only permit them to access an array of pages
    public function checkPermission($pageArray) {
        
    }
       
}

?>