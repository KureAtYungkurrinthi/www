<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        require_once "inc/dbconn.inc.php";
        $sql = "UPDATE Task SET completed=1 WHERE id=?;";
        $statement = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($statement, $sql);
        mysqli_stmt_bind_param($statement, 'i', $id);
        if (mysqli_stmt_execute($statement)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}
