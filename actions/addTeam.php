<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_team"])) {
        $teamName = $_POST["teamName"];
        $description = $_POST["description"];

        require_once "../includes/dbConnect.php";

        $sql = "INSERT INTO teams (teamName, description) VALUES (?, ?);";
        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $sql)) {
            mysqli_stmt_bind_param($statement, 'ss', $teamName, $description);

            if (mysqli_stmt_execute($statement)) {
                echo "Team added successfully.";
                header("Location: ../users.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_stmt_close($statement);
        } else {
            echo "SQL statement failed.";
        }

        mysqli_close($conn);
    }
}
