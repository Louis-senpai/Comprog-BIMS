<?php
require_once '../includes/components/header.php';

$result = $conn->query("SELECT * FROM officers");
while ($row = $result->fetch_assoc()) {
    echo '<li class="py-3 sm:py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center min-w-0">
                    <div class="ml-3">
                        <p class="font-medium text-gray-900 truncate dark:text-white">' . $row['name'] . ' - ' . $row['position'] . '</p>
                    </div>
                </div>
                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                    <button onclick="editOfficer(' . $row['id'] . ', \'' . $row['name'] . '\', \'' . $row['position'] . '\')" class="mr-2 text-blue-600">Edit</button>
                    <button onclick="deleteOfficer(' . $row['id'] . ')" class="text-red-600">Delete</button>
                </div>
            </div>
          </li>';
}

$conn->close();
?>
