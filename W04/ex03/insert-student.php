<?php

echo "<pre>";
print_r($_GET);
echo "</pre>";

if (isset($_GET["student-name"])) {
    require_once "inc/dbconn.inc.php";

    // Use a prepared statement to prevent injection attacks
    $sql = "INSERT INTO StudentResults(name) VALUES(?);";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 's', $_GET["student-name"]);

    if (mysqli_stmt_execute($statement)) {
        // Task updated successfully. Return the user to the tasks page.
        header("location: index.php");
    }
    else {
        echo mysqli_error($conn);
    }
    mysqli_close($conn);
}