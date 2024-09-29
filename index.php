<?php
// Configuration
$db_host = 'sql12.freesqldatabase.com';
$db_username = 'sql12733850';
$db_password = 'RZwFCyWcgR';
$db_name = 'sql12733850';

// Create connection
$conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);

// Check connection
if (!$conn) {
    die("Connection failed");
}

// Add task
if (isset($_POST['add_task'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task, completed) VALUES ('$task', 0)";
    $conn->query($sql);
    header('Location: index.php');
    exit;
}

// Delete task
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM tasks WHERE id = $id";
    $conn->query($sql);
    header('Location: index.php');
    exit;
}

// View tasks
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Task List</title>
</head>

<body>
    <h1>Task List</h1>
    <form action="index.php" method="post">
        <input type="text" name="task" placeholder="Add new task">
        <button type="submit" name="add_task">Add Task</button>
    </form>
    <ul>
        <?php
        while ($row = $result->fetch_assoc()) {
            ?>
            <li>
                <?php echo $row['task']; ?>
                <a href="index.php?delete=<?php echo $row['id']; ?>">Delete</a>
            </li>
            <?php
        }
        ?>
    </ul>
</body>

</html>