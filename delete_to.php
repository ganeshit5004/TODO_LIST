<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "todo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    
    // Delete the task from the database
    $sql = "DELETE FROM todo WHERE id = $task_id";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
}

mysqli_close($conn);
?>