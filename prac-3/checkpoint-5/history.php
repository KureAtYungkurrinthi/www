<!DOCTYPE html>
<html lang="en">

<head>
    <title>Practical 3: History</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Wang Shengfan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/style.css" />
    <script src="scripts/script.js" defer></script>
</head>

<body>
    <?php require_once "inc/menu.inc.php"; ?>
    <h1>History</h1>
    <?php
    require_once "inc/dbconn.inc.php";

    $sql = "SELECT name FROM Task WHERE completed=1 ORDER BY updated DESC;";
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
            echo '<ul id="task-completed">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row["name"] . "</li>";
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