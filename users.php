<?php require_once "includes/sessionValidator.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Group 5" />
    <meta name="description" content="User and Team Management" />
    <title>User and Team Management</title>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css" />
    <link rel="stylesheet" href="styles/users.css" />
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>



</head>

<body>
    <?php require_once "menu.php"; ?>
    <?php
    // Database connection details
    $host = "localhost";
    $username = "root";
    $password = "12345";
    $dbname = "flinderscare";

    // Establish database connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to list users and their teams
    function listUsersAndTeams($conn)
    {
        $sql = "SELECT users.userID, users.firstName, users.lastName, users.email, teams.teamName
            FROM users
            LEFT JOIN teams ON users.teamID = teams.teamID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Users and Teams</h2>";
            echo "<table border='1' id='users-teams-table'>";
            echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Team</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["firstName"] . "</td>";
                echo "<td>" . $row["lastName"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . ($row["teamName"] ? $row["teamName"] : "Not Assigned") . "</td>";
                echo "<td><a class='del-button' href='delete_user.php?userID=" . $row["userID"] . "'>Del User</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No users found.";
        }
    }

    function teamList($conn)
    {
        $sql = "SELECT *
            FROM teams";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Teams</h2>";
            echo "<table border='1' id='teams-table'>";
            echo "<tr><th>Team Name</th><th>Description</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["teamName"] . "</td>";
                echo "<td>" . $row["description"] . "</td>";
                echo "<td><a class='del-button' href='delete_team.php?teamID=" . $row["teamID"] . "'>Del Team</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Teams users found.";
        }
    }

    // Handle form submissions to add users and teams
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["add_user"])) {
            $firstName = $_POST["firstName"];
            $lastName = $_POST["lastName"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            // $teamId = $_POST["teamId"];
            $role = $_POST["role"];

            // $userAdded = true; // Initialize the variable to false
            // Add user to the 'users' table
            $insertUserSql = "INSERT INTO users (firstName, lastName, email, password, role)
                          VALUES ('$firstName', '$lastName', '$email', '$password', '$role')";
            if ($conn->query($insertUserSql) === TRUE) {
                echo "User added successfully.";
                // $userAdded = true;
            } else {
                echo "Error adding user: " . $conn->error;
            }
        } elseif (isset($_POST["add_team"])) {
            $teamName = $_POST["teamName"];
            $description = $_POST["description"];

            // Add team to the 'teams' table
            $insertTeamSql = "INSERT INTO teams (teamName, description) VALUES ('$teamName', '$description')";
            if ($conn->query($insertTeamSql) === TRUE) {
                echo "Team added successfully.";
            } else {
                echo "Error adding team: " . $conn->error;
            }
        } elseif (isset($_POST["assign_team"])) {
            $userId = $_POST["userId"]; // The selected user ID
            $teamId = $_POST["teamId"]; // The selected team ID

            // Perform the assignment by updating the user's team ID in the database
            $updateUserSql = "UPDATE users SET teamID = '$teamId' WHERE userID = '$userId'";

            if ($conn->query($updateUserSql) === TRUE) {
                echo "Team assigned successfully.";
            } else {
                echo "Error assigning team: " . $conn->error;
            }
        }
    }


    ?>

    <main>

        <?php listUsersAndTeams($conn);
        teamList($conn);
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add-user-form">
            <h2 class="form_title">Add User</h2>
            <input type="text" name="firstName" placeholder="First Name" required class='input-field' /><br>
            <input type="text" name="lastName" placeholder="Last Name" required class='input-field' /><br>
            <input type="email" name="email" placeholder="Email" required class='input-field' /><br>
            <input type="password" name="password" placeholder="Password" required class='input-field' /><br>
            <!-- <select name="teamId" required class='input-field'>
                <?php
                // Populate the dropdown with available teams
                // $teamQuery = "SELECT * FROM teams";
                // $teamResult = $conn->query($teamQuery);

                // while ($row = $teamResult->fetch_assoc()) {
                //     echo "<option value='" . $row["teamID"] . "'>" . $row["teamName"] . "</option>";
                // }
                ?>
            </select><br> -->
            <input type="text" name="role" placeholder="Role" required class='input-field' /><br>
            <button type="submit" name="add_user" class='submit-button'>Add User</button>
        </form>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add-team-form">
            <h2 class="form_title">Add Team</h2>
            <input type="text" name="teamName" placeholder="Team Name" required class='input-field' /><br>
            <input type="text" name="description" placeholder="Description" required class='input-field' /><br>
            <button type="submit" name="add_team" class='submit-button'>Add Team</button>
        </form>

        <!-- assign team to user  -->

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="add-team-form">
            <h2 class="form_title">Assign Team</h2>

            <select name="userId" required class='input-field'>
                <option>Select User</option>
                <?php
                // Populate the dropdown with available teams
                $teamQuery = "SELECT * FROM users";
                $teamResult = $conn->query($teamQuery);

                while ($row = $teamResult->fetch_assoc()) {
                    echo "<option value='" . $row["userID"] . "'>" . $row["firstName"] . "</option>";
                }
                ?>
            </select><br>

            <select name="teamId" required class='input-field'>
                <option>Select Team</option>
                <?php
                // Populate the dropdown with available teams
                $teamQuery = "SELECT * FROM teams";
                $teamResult = $conn->query($teamQuery);

                while ($row = $teamResult->fetch_assoc()) {
                    echo "<option value='" . $row["teamID"] . "'>" . $row["teamName"] . "</option>";
                }
                ?>
            </select><br>



            <button type="submit" name="assign_team" class='submit-button'>save</button>
        </form>

        <main>


</body>

</html>