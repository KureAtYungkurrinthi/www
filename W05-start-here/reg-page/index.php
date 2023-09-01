<!-- 1. define the db connection -->
<!-- 2. set the form action to the page loaded from the server -->
<!-- 3. define the php script after the page content - print_r POST -->
<!-- 3.1. assign the values from POST to variables -->
<!-- 4. construct the sql query and write to db -->
<!-- 5. hash the password - change the query -->
<!-- 6. use filters to avoid malicious attacks -->
<!-- 7. verify that content has been added to the form fields -->
<!-- 8. implement a try catch to ensure unique users -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>

<body>
    <h1>Sign Up Page</h1>

    <div class="centred-form">
        <form action="index.php" method="POST">
            <div class="form-row">
                <label class="form-label">Username</label>
                <input class="form-input" type="text" name="username">
            </div>
            <div class="form-row">
                <label class="form-label">Password</label>
                <input class="form-input" type="password" name="password">
            </div>
            <div class="form-row">
                <label class="form-label">Work Location</label>
                <input class="form-input" type="text" name="address">
            </div>
            <div class="form-row">
                <label class="form-label">Date of Birth</label>
                <input class="form-input" type="date" name="dob">
            </div>
            <div class="form-row">
                <label class="form-label">Role</label>
                <select class="form-input" name="userRole">
                    <option>Select...</option>
                    <option>Administrator</option>
                    <option>Manager</option>
                    <option>Line Worker</option>
                    <option>Labourer</option>
                </select>
            </div>
    </div>
    <div class="centred-btn-container">
        <input class="submit-btn" type="submit" name="submit" value="Register">
    </div>
    </form>
</body>

</html>