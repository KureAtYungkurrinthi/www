<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = 12345;
$dbname = "flinderscare";

// Establish database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["pass"];

    // Sanitize user inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the user exists in the 'users' table
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User found, redirect to a success page or perform desired actions
        // For example, you can set a session variable to indicate the user is logged in
        // User found, fetch the user's name from the database
        $row = $result->fetch_assoc();
        session_start();
        $_SESSION["user_email"] = $email;
        $_SESSION["user_name"] = $row['firstName'];
        // Redirect to a success page
        header("Location: index.php");
        exit();
    } else {
        // Invalid credentials, display an error message
        echo "Invalid email or password. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
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
            <input type="password" name="pass" placeholder="Enter Password" required />
        </label>
        <button type="submit">Login</button>
        <label id="remember">
            <input type="checkbox" name="remember" checked="checked"> Remember me
        </label>
    </form>
</body>

</html>