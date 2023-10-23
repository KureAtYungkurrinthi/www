<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["roomNumber"]) && isset($_POST["roomType"])) {
        $roomNumber = $_POST["roomNumber"];
        $roomType = $_POST["roomType"];

        require_once "../includes/dbConnect.php";

        $sql = "INSERT INTO Rooms(roomNumber, roomType) VALUES(?, ?);";
        $statement = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($statement, $sql)) {
            mysqli_stmt_bind_param($statement, 'ss', $roomNumber, $roomType);

            if (mysqli_stmt_execute($statement)) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            mysqli_stmt_close($statement);
        }
        mysqli_close($conn);
    }
}