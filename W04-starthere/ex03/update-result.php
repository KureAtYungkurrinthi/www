<?php

if (isset($_POST["studentID"])) {
    $id = $_POST["studentID"];
    $newMark = $_POST["newMark"];
    require_once "inc/dbconn.inc.php";

    // Use a prepared statement to prevent injection attacks
    $sql = "UPDATE StudentResults SET mark=? WHERE id=?;";
    $statement = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($statement, $sql);
    mysqli_stmt_bind_param($statement, 'ii', $newMark, $id);

    if (mysqli_stmt_execute($statement)) {
        // Task updated successfully. Return the user to the tasks page.
        header("location: index.php");
    }
    else {
        echo mysqli_error($conn);
    }
    // mysqli_stmt_close($statement);
    mysqli_close($conn);

}
?>