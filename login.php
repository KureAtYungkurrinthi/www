<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="styles/login.css"/>
    <meta name="author" content="Group 5"/>
    <meta name="description" content="Login Page"/>
    <title>Login Page</title>
</head>

<body>
<h1>Welcome to Flinders Care</h1>
<form action="login.php" method="post">
    <label> Email
        <input type="email" name="email" placeholder="Enter Email" required/>
    </label>
    <label> Password
        <input type="password" name="pass" placeholder="Enter Password" required/>
    </label>
    <button type="submit">Login</button>
    <label id="remember">
        <input type="checkbox" name="remember" checked="checked"> Remember me
    </label>
</form>
</body>

</html>