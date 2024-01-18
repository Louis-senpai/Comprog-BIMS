<?php
require_once '../includes/components/header.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add') {
        $name = $_POST['name'];
        $position = $_POST['position'];

        $sql = "INSERT INTO officers (name, position) VALUES ('$name', '$position')";
        $conn->query($sql);
    } elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $position = $_POST['position'];

        $sql = "UPDATE officers SET name='$name', position='$position' WHERE id=$id";
        $conn->query($sql);
    } elseif ($action === 'delete') {
        $id = $_POST['id'];

        $sql = "DELETE FROM officers WHERE id=$id";
        $conn->query($sql);
    }

    // Fetch and display the updated list of officers after the action
    include 'get_officers.php';
}

$conn->close();
?>
