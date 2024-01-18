<?php
require_once '../config.php';

$result = $conn->query("SELECT * FROM officers");
while ($row = $result->fetch_assoc()) {
    echo '<tr align="center">
            <td>' . $row['name'] . '</td>
            <td>' . $row['position'] . '</td>
          </tr>';
}

?>
