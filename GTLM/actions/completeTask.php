<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["taskID"])) {
        $taskID = $_GET["taskID"];
        require_once "../includes/dbConnect.php";

        // SQL query to delete task
        $sql = "UPDATE Tasks SET status='Completed' WHERE taskID=?;";

        // Prepare and bind parameters
        $stmt = mysqli_stmt_init($conn);
        if(mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'i', $taskID);

            // Execute statement
            if (mysqli_stmt_execute($stmt)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}