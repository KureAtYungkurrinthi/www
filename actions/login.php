<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "../includes/dbConnect.php";

        // Select the user credentials from the database
        $sql = "SELECT * FROM Users WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                if ($password == $row['password']) {
                    // Start a session and redirect the user to a new page
                    session_start();
                    $_SESSION["user_email"] = $email;
                    $_SESSION["user_name"] = $row['firstName'] . " " . $row['lastName'];
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                }
            }
            echo "Invalid email or password. Please try again.";
        } else {
            echo "SQL statement failed";
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}