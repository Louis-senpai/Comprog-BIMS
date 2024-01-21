<?php
require_once '../config.php';

$result = $conn->query("SELECT * FROM officers");
while ($row = $result->fetch_assoc()) {
  echo '<tr style="border: 1px solid #E5E7EB; text-align: center;">
            <td>' . $row['name'] . '</td>
            <td>' . $row['position'] . '</td>
          </tr>';


}

?>
