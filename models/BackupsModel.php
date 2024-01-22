<?php 
require_once '../models/Backup.php';
class BackupModel extends Backup_Database {
    // Constructor
    public function __construct($host, $user, $pass, $dbName, $charset = 'utf8', $backupName = 'Backup') {
        // Call the parent constructor with the necessary parameters
        parent::__construct($host, $user, $pass, $dbName, $charset, $backupName);
    }

    // You can add additional methods or override existing ones if needed
    public function startBackup($tables = '*') {
        // Call the backupTables method from the parent class
        return $this->backupTables($tables);
    }

    // function to return an array of backups that was made in the directory ../backups/
    public function getBackups() {
        $backups = array();
        if ($handle = opendir('../backups/')) {
            while (false!== ($entry = readdir($handle))) {
                if ($entry!= "." && $entry!= "..") {
                    $backups[] = $entry;
                }
            }
            closedir($handle);
        }
        return $backups;
    }
    // function that counts the backups in the directory../backups/
    public function getBackupCount() {
        $backups = $this->getBackups();
        return count($backups);
    }
    public function GetPanginatedBackup($perPage= 10, $page = 1, $search = '') {
        $backups = array();
        $offset = ($page - 1) * $perPage;
        $searchPattern = !empty($search) ? "*$search*" : "*";

        if ($handle = opendir('../backups/')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != ".." && fnmatch($searchPattern, $entry)) {
                    $backups[] = $entry;
                }
            }
            closedir($handle);
        }
        // Sort backups by date or name if needed
        usort($backups, function($a, $b) {
            return filemtime("../backups/$b") - filemtime("../backups/$a");
        });
        $paginatedBackups = array_slice($backups, $offset, $perPage);

        return $paginatedBackups;
    }
    
}

$Backup = new BackupModel($host, $user, $pass, $name,);
// header('Content-Type: application/json');
// echo json_encode($Backup->getPanginatedBackup());
?>