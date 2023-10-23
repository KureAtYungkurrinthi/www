<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add_user"])) {
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        require_once "../includes/dbConnect.php";

        $insertUserSql = "INSERT INTO users (firstName, lastName, email, password, role) VALUES (?, ?, ?, ?, ?);";
        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $insertUserSql)) {
            mysqli_stmt_bind_param($statement, 'sssss', $firstName, $lastName, $email, $password, $role);

            if (mysqli_stmt_execute($statement)) {
                echo "User added successfully.";
                header("Location: ../users.php");
                exit();
            } else {
                echo "Error adding user: " . mysqli_stmt_error($statement);
            }

            mysqli_stmt_close($statement);
        } else {
            echo "SQL error: " . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
}
