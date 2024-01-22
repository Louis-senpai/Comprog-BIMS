<?php 
session_start();
require_once('../config.php');
require('../vendor/autoload.php');
require('../models/BackupsModel.php');


// Get the search term from the query parameters
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

// Define the limit and offset for pagination
$limit = 50; // Number of results per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Get the paginated survey results
$paginatedResults = $Backup->GetPanginatedBackup($limit, $offset, $searchTerm);
//example output ["-20240122_004342.sql.gz","-20240122_004224.sql.gz","adawdw-20240122_002215.sql.gz","-20240122_002157.sql.gz","-20240122_002007.sql.gz","Backup-20240122_001542.sql.gz","1-20240122_001356.sql.gz","myphp-backup-s126067_student-20240122_000704.sql.gz","myphp-backup-s126067_student-20240122_000652.sql.gz","myphp-backup-s126067_student-20240122_000640.sql.gz"]



$results = json_encode($paginatedResults);
foreach ($paginatedResults as $row) {
    // Encode the filename for use in the URL
    $encodedFilename = urlencode($row);
    // Get the full path to the backup file
    $filePath = '../backups/' . $row;
    
    // Get the last modification time of the file
    $lastModTime = file_exists($filePath) ? filemtime($filePath) : null;
    
    // Format the last modification time for display
    $formattedTime = $lastModTime ? date("F d, Y H:i:s", $lastModTime) : "Unknown";
?>
<tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
    <td class="p-4 text-base font-semibold text-gray-900 dark:text-white"><?php echo htmlspecialchars($row); ?></td>
    <td class="p-4 text-base text-gray-900 dark:text-white"><?php echo $formattedTime; ?></td>
    <td class="p-4 pr-4 space-x-2 whitespace-nowrap">
        <div style="display: flex; gap: 10px;">
            <!-- Download Backup File -->
            <a href="../api/downloadBackup.php?file=<?php echo $encodedFilename; ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M8.707 10.293a1 1 0 010 1.414L5.414 15H9a1 1 0 110 2H3a1 1 0 01-1-1v-6a1 1 0 112 0v3.586l3.293-3.293a1 1 0 011.414 0z">
                    </path>
                    <path d="M3 5a1 1 0 011-1h12a1 1 0 110 2H5a1 1 0 01-1-1z"></path>
                    <path d="M12 11a1 1 0 100 2h4a1 1 0 100-2h-4z"></path>
                </svg>
                Download
            </a>
            <!-- Delete Backup File -->
            <a href="../api/deleteBackup.php?file=<?php echo $encodedFilename; ?>"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900"
                onclick="return confirm('Are you sure you want to delete this backup?');">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6 3a1 1 0 011-1h6a1 1 0 011 1v1h4a1 1 0 110 2H3a1 1 0 110-2h4V3z"
                        clip-rule="evenodd"></path>
                    <path fill-rule="evenodd" d="M4 6a1 1 0 011-1h10a1 1 0 011 1v10a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"
                        clip-rule="evenodd"></path>
                </svg>
                Delete
            </a>
            <!-- Restore Backup File -->
            <button hx-get="/api/RestoreStart.php?file=<?php echo $encodedFilename; ?>" hx-target="#Progress_bar"
                hx-swap="innerHTML" hx-trigger="click"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-600 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900"
                hx-confirm='are you sure you want to restore this backup?'>
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                        clip-rule="evenodd"></path>
                </svg>
                Restore
            </button>

        </div>
    </td>
</tr>
<?php 
}



?>