<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "todo");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];
    
    // Retrieve the task from the database
    $sql = "SELECT * FROM todo WHERE id = $task_id";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $task_name = $row['task'];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $new_task_name = $_POST['task'];
            
            // Update the task in the database
            $sql = "UPDATE todo SET task = '$new_task_name' WHERE id = $task_id";
            
            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Task</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Task</h1>
        <form action="" method="POST">
            <input type="text" name="task" value="<?php echo $task_name; ?>" required>
            <button type="submit">Update Task</button>
        </form>
    </div>
</body>
</html>
<?php
    } else {
        echo "Task not found.";
    }
} else {
    header("Location: index.php");
}

mysqli_close($conn);
?>