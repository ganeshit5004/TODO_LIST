<!DOCTYPE html>
<html>
<head>
    <title>Todo Application</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Todo Application</h1>
        <form action="add_to.php" method="POST">
            <input type="text" name="task" placeholder="Enter task..." required>
            <button type="submit">Add Task</button>
        </form>
        
        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root","", "todo");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Retrieve tasks from the database
        $sql = "SELECT * FROM todo";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            
            while ($row = mysqli_fetch_assoc($result)) {
                $task_id = $row['id'];
                $task_name = $row['task'];
                
                echo "<li>
                        <span>$task_name</span>
                        <a href='update_to.php?id=$task_id'>Update</a>
                        <a href='delete_to.php?id=$task_id'>Delete</a>
                      </li>";
            }
            
            echo "</ul>";
        } else {
            echo "No tasks found.";
        }
        
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>