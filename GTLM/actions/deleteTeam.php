<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["teamID"])) {
        $teamID = $_GET["teamID"];

        require_once "../includes/dbConnect.php";

        $sql = "DELETE FROM teams WHERE teamID = ?;";
        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $sql)) {
            mysqli_stmt_bind_param($statement, 'i', $teamID);
            if (mysqli_stmt_execute($statement)) {
                echo "Team deleted successfully.";
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } else {
                echo "Error deleting team: " . mysqli_stmt_error($statement);
            }
        } else {
            echo "SQL error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($statement);
        mysqli_close($conn);
    } else {
        echo "Team ID not provided.";
    }
}