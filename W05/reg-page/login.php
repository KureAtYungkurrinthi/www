<!-- 1. rename index.php to registration.php -->
<!-- 2. copy and rename registration.php to login.php -->
<!-- 3. change page title -->
<!-- 4. remove address, dob, userRole -->
<!-- 5. define select query, check result, get row -->
<!-- 6. echo id, username content -->
<!-- 7. check password is correct -->
<!-- 7.1 if correct echo password, address, dob, userRole -->
<!-- 7.2 if not correct echo error message -->
<!-- 8. add an else clause to result - user does not exist -->

<?php
require_once "inc/dbconn.inc.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>
    <h1>Login Page</h1>

    <div class="centred-form">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div class="form-row">
                <label class="form-label">Username</label><input class="form-input" type="text" name="username">
            </div>
            <div class="form-row">
                <label class="form-label">Password</label><input class="form-input" type="password" name="password">
            </div>
    </div>
    <div class="centred-btn-container">
        <input class="submit-btn" type="submit" name="submit" value="Login">
    </div>
    </form>
</body>

</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($username)) {
        echo "<p style=\"text-align: center; margin-top: 10px;\">Please enter a username</p>";
    } elseif (empty($password)) {
        echo "<p style=\"text-align: center; margin-top: 10px;\">Please enter a password</p>";
    } else {
        $sql = "SELECT * FROM users WHERE username = '$username';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<p style=\"text-align:center; margin-top:10px;\">ID: " . $row["id"] . "<br>";
            echo "Username: " . $row["username"] . "<br>";
            if (password_verify($password, $row["password"])) {
                echo "<b>password is correct</b><br>";
                echo "Password: " . $row["password"] . "<br>";
                echo "Address: " . $row["address"] . "<br>";
                echo "DoB: " . $row["dob"] . "<br>";
                echo "User role: " . $row["userRole"] . "</p>";
            } else {
                echo "<i style=\"color: red\">password incorrect</i></p><br>";
            }
        }else{
            echo "<p style=\"color: red; text-align: center; margin-top:10px;\"><i>User does not exist</i></p><br>";
        }
    }
}

mysqli_close($conn);
?>