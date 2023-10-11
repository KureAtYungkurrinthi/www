<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["userID"])) {
        $userID = $_GET["userID"];

        require_once "../includes/dbConnect.php";

        $sql = "DELETE FROM users WHERE userID = ?;";
        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $sql)) {
            mysqli_stmt_bind_param($statement, 'i', $userID);
            if (mysqli_stmt_execute($statement)) {
                echo "User deleted successfully.";
                header("Location: ../users.php");
                exit();
            } else {
                echo "Error deleting user: " . mysqli_stmt_error($statement);
            }
        } else {
            echo "SQL error: " . mysqli_error($conn);
        }

        mysqli_stmt_close($statement);
        mysqli_close($conn);
    } else {
        echo "User ID not provided.";
    }
}
