<?php
$host = "delta.optiklink.com";
$user = "u126067_6YObtWKgqn";
$name = "s126067_student";
$pass = "!yQ4Q2@Da6BB!8VWIhLcKKMw";
$port = "3306";

$conn = mysqli_connect($host, $user, $pass, $name, $port);

$result = $conn->query("SELECT * FROM officers");
while ($row = $result->fetch_assoc()) {
    echo '<tr align="center">
            <td>' . $row['name'] . '</td>
            <td>' . $row['position'] . '</td>
            <td>
                <button onclick="editOfficer(' . $row['id'] . ', \'' . $row['name'] . '\', \'' . $row['position'] . '\')" class="text-blue-600">Edit</button>
                <button onclick="deleteOfficer(' . $row['id'] . ')" class="text-red-600">Delete</button>
            </td>
          </tr>';
}

$conn->close();
?>
