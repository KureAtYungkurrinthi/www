<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["task-name"])) {
        $taskName = $_POST["task-name"];

        require_once "inc/dbconn.inc.php";
        $sql = "INSERT INTO Task(name) VALUES(?);";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 's', htmlspecialchars($_POST["task-name"]));
        if (mysqli_stmt_execute($statement)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
