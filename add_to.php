<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "todo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert task into the database
$task = $_POST['task'];
$sql = "INSERT INTO todo (task) VALUES ('$task')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>