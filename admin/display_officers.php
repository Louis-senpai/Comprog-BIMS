<?php
require_once '../config.php';

$result = $conn->query("SELECT * FROM officers");
while ($row = $result->fetch_assoc()) {
  echo '<tr align="center">
            <td class="p-2 border border-gray-300">' . $row['name'] . '</td>
            <td class="p-2 border border-gray-300">' . $row['position'] . '</td>
            <td class="p-2 border border-gray-300">' . $row['phone_number'] . '</td>
          </tr>';


}

?>
