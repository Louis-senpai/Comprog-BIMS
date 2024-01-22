<?php
// RestoreBackup.php

require_once '../models/Restore.php'; // Make sure to require the original Restore_Database class

class RestoreBackup extends Restore_Database {

    /**
     * Constructor
     */
    public function __construct($conn, $backupDir) {
        parent::__construct($conn, $backupDir);
    }

    /**
     * Restore a backup from a specified file
     * @param string $backupFilename Name of the backup file to restore
     * @return bool True on success, false on failure
     */
    public function restoreFromFile($backupFilename) {
        $this->backupFile = $backupFilename;
        return $this->restoreDb();
    }

    /**
     * Restore the latest backup file from the backup directory
     * @return bool True on success, false on failure
     */
    public function restoreLatestBackup() {
        $latestBackupFile = $this->getLatestBackupFile();
        if ($latestBackupFile) {
            $this->backupFile = $latestBackupFile;
            return $this->restoreDb();
        }
        return false;
    }

    /**
     * Get the latest backup file from the backup directory
     * @return string|false Filename of the latest backup or false if not found
     */
    private function getLatestBackupFile() {
        $backupDir = $this->backupDir;
        $latestBackupFile = null;
        $latestBackupTime = 0;

        if ($handle = opendir($backupDir)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $filePath = $backupDir . '/' . $entry;
                    if (is_file($filePath) && filemtime($filePath) > $latestBackupTime) {
                        $latestBackupTime = filemtime($filePath);
                        $latestBackupFile = $entry;
                    }
                }
            }
            closedir($handle);
        }

        return $latestBackupFile;
    }
}

// Usage example:
$restoreBackup = new RestoreBackup($conn, '../backups');
// $result = $restoreBackup->restoreLatestBackup() ? 'OK' : 'KO';
// echo "Restoration result: " . $result;
