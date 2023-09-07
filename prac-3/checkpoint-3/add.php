<!DOCTYPE html>
<html lang="en">

<head>
    <title>Practical 3: Add</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Wang Shengfan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <script src="scripts/script.js" defer></script>
</head>

<body>
    <?php require_once "inc/menu.inc.php"; ?>
    <h1>Add a new task</h1>
    <form action="add-task.php" method="post">
        <input type="text" name="task-name" id="task-name" placeholder="Enter the task name" required />
        <input type="submit" id="task-submit" value="Add Task" />
    </form>
</body>

</html>