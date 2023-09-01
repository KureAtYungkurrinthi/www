<!DOCTYPE html>
<html lang="en">

<head>
    <title>Workshop 04: Add new student</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Brett Wilkinson" />
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <h1>Student List</h1>
    <p><a href="update.php">Update Results</a></p>
    
    <!-- 2. set up a new button to show outstanding fees -->
    
    <?php
    require_once "inc/dbconn.inc.php";

    $sql = "SELECT id, name, mark FROM StudentResults;";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li id=\"student\" class=\" \"><p>" . $row["name"] . ", current result: " . $row["mark"] . "</p></li>";
            }
            echo "</ul>";
            // Free up memory consumed by the $result object
            mysqli_free_result($result);
        }
    }
    mysqli_close($conn);
    ?>

    <!-- 1. create a button to add a new student -->
    
</body>

</html>