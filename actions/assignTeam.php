<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["assign_team"])) {
        $userId = $_POST["userId"];
        $teamId = $_POST["teamId"];

        require_once "../includes/dbConnect.php";

        $updateUserSql = "UPDATE users SET teamID = ? WHERE userID = ?";
        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $updateUserSql)) {
            mysqli_stmt_bind_param($statement, 'ss', $teamId, $userId);
            if (mysqli_stmt_execute($statement)) {
                echo "Team assigned successfully.";
                header("Location: ../users.php");
                exit();
            } else {
                echo "Error assigning team: " . mysqli_stmt_error($statement);
            }

            mysqli_stmt_close($statement);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
