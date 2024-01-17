<?php 


class UserActivityLogs extends MysqliDb {
    protected $tableName = 'UserActivityLogs';

    public function __construct($conn) {
        parent::__construct($conn);
    }

    public function logActivity($userId, $activity) {
        // Log in the database
        $data = Array(
            "user_id" => $userId,
            "activity" => $activity
        );
        $id = $this->insert($this->tableName, $data);

        // Log in a JSON file
        $logEntry = array(
            "user_id" => $userId,
            "activity" => $activity,
            "timestamp" => date('Y-m-d H:i:s')
        );
        $logFile = 'user_activities.json';
        if (!file_exists($logFile)) {
            $logs = array();
        } else {
            $logs = json_decode(file_get_contents($logFile), true);
        }
        $logs[] = $logEntry;
        file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT));

        return $id;
    }
}


?>