<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Wang Shengfan" />
    <title>Practical 3: Current tasks</title>
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
        if (mysqli_num_rows($result) >= 1) {
            echo '<ul id="task">';
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . $row["name"] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "Task table is empty.";
            exit;
        }

        mysqli_free_result($result);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit;
    }

    mysqli_close($conn);
    ?>
</body>

</html>