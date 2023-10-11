<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/login.css" />
    <meta name="author" content="Group 5" />
    <meta name="description" content="Login Page" />
    <title>Login Page</title>
</head>

<body>
    <h1>Welcome to Flinders Care</h1>
    <form action="login.php" method="post">
        <label> Email
            <input type="email" name="email" placeholder="Enter Email" required />
        </label>
        <label> Password
            <input type="password" name="password" placeholder="Enter Password" required />
        </label>
        <button type="submit">Login</button>
        <label id="remember">
            <input type="checkbox" name="remember" checked="checked"> Remember me
        </label>
    </form>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        require_once "includes/dbConnect.php";

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
                    header("Location: index.php");
                    exit();
                }
            }
            echo "Invalid email or password. Please try again.";
        } else {
            echo "SQL statement failed";
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}