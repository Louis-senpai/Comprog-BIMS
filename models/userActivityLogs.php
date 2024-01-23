<?php 


class UserActivityLogs extends MysqliDb {
    protected $tableName = 'useractivitylogs';
    protected $logFilePath = '/cache/history/user_activities.json'; // Default path

    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function setLogFilePath($path) {
        $this->logFilePath = $path;
    }

    public function getActivityLog() {
       
        return  $this->rawQuery("SELECT * FROM ". $this->tableName." ORDER BY timestamp DESC limit 5 ");
    }
    public function getActivitylogByID($id) {
        return  $this->rawQuery("SELECT * FROM ". $this->tableName." WHERE user_id = $id ORDER BY timestamp DESC limit 5 ");
    }

    public function logActivity($userId, $activity) {
        // Log in the database
        $data = [
            "user_id" => $userId,
            "activity" => $activity
        ];
        $id = $this->insert($this->tableName, $data);

        // Prepare log entry
        $logEntry = [
            "user_id" => $userId,
            "activity" => $activity,
            "timestamp" => date('Y-m-d H:i:s')
        ];

        // Ensure the directory exists
        $logDirectory = dirname($this->logFilePath);
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0755, true);
        }

        // Append log entry to the JSON file
        $logData = json_encode($logEntry, JSON_PRETTY_PRINT);
        file_put_contents($this->logFilePath, $logData . ",\n", FILE_APPEND | LOCK_EX);

        return $id;
    }
}

?>