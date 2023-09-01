<!DOCTYPE html>
<html lang="en">
<head>
    <title>Workshop 04: Update student mark</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Brett Wilkinson" />
</head>
<body>
    <h1>Student List</h1>
    
    <!-- set up anchor to load a form on a new page -->

    <?php
    require_once "inc/dbconn.inc.php";

    $sql = "SELECT id, name, mark FROM StudentResults;";
    if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li><p>" . $row["name"] . ", current result: " . $row["mark"] . "</p></li>";
            }
            echo "</ul>";
            // Free up memory consumed by the $result object
            mysqli_free_result($result);
        }
    }
    mysqli_close($conn);
    ?>

</body>
</html>
