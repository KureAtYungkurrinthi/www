<!DOCTYPE html>
<html lang="en">

<head>
    <title>Practical 3: Current tasks</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Wang Shengfan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <script src="scripts/script.js" defer></script>
</head>

<body>
    <?php require_once "inc/menu.inc.php"; ?>
    <h1>Current</h1>
    <?php
    require_once "inc/dbconn.inc.php";

    $sql = "SELECT id, name FROM Task WHERE completed=0;";
    if ($result = mysqli_query($conn, $sql)) {
        $numRows = mysqli_num_rows($result);
        if ($numRows < 1) {
            echo "<h2>No tasks</h2>";
        } else {
            if ($numRows == 1) {
                echo "<h2>1 task</h2>";
            } else {
                echo "<h2>" . $numRows . " tasks</h2>";
            }
            echo '<ul id="task">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<li><a href="complete.php?id=' . $row["id"] . '">' . $row["name"] . '</a></li>';
            }
            echo "</ul>";
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
    ?>
</body>

</html>