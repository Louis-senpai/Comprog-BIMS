<?php
require_once '../includes/components/header.php';


// Function to handle adding an officer
function addOfficer($conn, $name, $position) {
    $sql = "INSERT INTO officers (name, position) VALUES ('$name', '$position')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return "Officer added successfully.";
    } else {
        return "Error adding officer: " . mysqli_error($conn);
    }
}

// Function to handle editing an officer
function editOfficer($conn, $id, $name, $position) {
    $sql = "UPDATE officers SET name = '$name', position = '$position' WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return "Officer updated successfully.";
    } else {
        return "Error updating officer: " . mysqli_error($conn);
    }
}

// Function to handle deleting an officer
function deleteOfficer($conn, $id) {
    $sql = "DELETE FROM officers WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        return "Officer deleted successfully.";
    } else {
        return "Error deleting officer: " . mysqli_error($conn);
    }
}

// Handle form submission for adding/editing/deleting officers
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $addResult = addOfficer($conn, $_POST['name'], $_POST['position']);
        echo '<script>alert("' . $addResult . '");</script>';
    } elseif (isset($_POST['edit'])) {
        $editResult = editOfficer($conn, $_POST['edit_id'], $_POST['edit_name'], $_POST['edit_position']);
        echo '<script>alert("' . $editResult . '");</script>';
    } elseif (isset($_POST['delete'])) {
        $deleteResult = deleteOfficer($conn, $_POST['delete_id']);
        echo '<script>alert("' . $deleteResult . '");</script>';
    }
}

// Fetch and display current officers' information
$sql = "SELECT * FROM officers";
$result = mysqli_query($conn, $sql);
?>

<body class="bg-gray-50 dark:bg-gray-800">

    <?php require_once "../includes/components/nav.php";?>
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <?php require_once '../includes/components/sidebar.php';?>

        <div id="main-content" class="relative w-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">

            <main>
                <div class="px-4 pt-6 pr-4">
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Officers Management</h1>

                    <!-- Form for Adding/Editing Officers -->
                    <form action="" method="post" class="mt-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                        <input type="text" name="name" required class="mt-1 p-2 border rounded-md w-full">

                        <label for="position" class="block mt-4 text-sm font-medium text-gray-700">Position:</label>
                        <input type="text" name="position" required class="mt-1 p-2 border rounded-md w-full">

                        <button type="submit" name="add" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md">Add Officer</button>
                    </form>

                    <!-- Display Current Officers' Information -->
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white mt-8">Current Officers</h2>
                    <table class="mt-4 w-full border-collapse border">
                        <thead>
                            <tr>
                                <th class="p-2">Name</th>
                                <th class="p-2">Position</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr align='center'>";
                                echo "<td class='p-2'>" . $row['name'] . "</td>";
                                echo "<td class='p-2'>" . $row['position'] . "</td>";
                                echo "<td class='p-2'>
                                        <form action='' method='post'>
                                            <input type='hidden' name='edit_id' value='{$row['id']}'>
                                            <input type='hidden' name='edit_name' value='{$row['name']}'>
                                            <input type='hidden' name='edit_position' value='{$row['position']}'>
                                            <button type='submit' name='edit' class='text-blue-600'>Edit</button>
                                        </form>
                                        <form action='' method='post'>
                                            <input type='hidden' name='delete_id' value='{$row['id']}'>
                                            <button type='submit' name='delete' class='text-red-600'>Delete</button>
                                        </form>
                                    </td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Included Footer.php -->
                <?php 
                    require_once "../includes/components/footer.php";
                ?>
            </main>
        </div>
    </div>
</body>

</html>
