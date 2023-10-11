<?php require_once "includes/sessionValidator.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="styles/users.css"/>
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="User and Team Management"/>
    <title>User and Team Management</title>
</head>

<body>
<?php require_once "includes/menu.php"; ?>

<main>
    <?php
    require_once "includes/dbConnect.php";

    // Users and Teams
    $sql = "SELECT users.userID, users.firstName, users.lastName, users.email, teams.teamName
        FROM users
        LEFT JOIN teams ON users.teamID = teams.teamID";

    if ($result = mysqli_query($conn, $sql)) {
        $numRows = mysqli_num_rows($result);
        echo "<h2>Users and Teams</h2>";
        if ($numRows < 1) {
            echo "No users found.";
        } else {
            echo "<table id='users-teams-table'>";
            echo "<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Team</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                $teamName = $row["teamName"] ? $row["teamName"] : "Not Assigned";
                echo "<tr><td>{$row["firstName"]}</td><td>{$row["lastName"]}</td><td>{$row["email"]}</td><td>{$teamName}</td>";
                echo "<td><a class='del-button' href='actions/deleteUser.php?userID={$row["userID"]}'>Del User</a></td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Teams
    $sql = "SELECT * FROM teams";
    if ($result = mysqli_query($conn, $sql)) {
        $numRows = mysqli_num_rows($result);
        echo "<h2>Teams</h2>";
        if ($numRows < 1) {
            echo "Teams users found.";
        } else {
            echo "<table id='teams-table'>";
            echo "<tr><th>Team Name</th><th>Description</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>{$row["teamName"]}</td><td>{$row["description"]}</td>";
                echo "<td><a class='del-button' href='actions/deleteTeam.php?teamID={$row["teamID"]}'>Del Team</a></td></tr>";
            }
            echo "</table>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    ?>

    <form action="actions/addUser.php" method="post" id="add-user-form">
        <h2 class="form_title">Add User</h2>
        <input type="text" name="firstName" placeholder="First Name" required class='input-field'/><br>
        <input type="text" name="lastName" placeholder="Last Name" required class='input-field'/><br>
        <input type="email" name="email" placeholder="Email" required class='input-field'/><br>
        <input type="password" name="password" placeholder="Password" required class='input-field'/><br>
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
        <input type="text" name="role" placeholder="Role" required class='input-field'/><br>
        <button type="submit" name="add_user" class='submit-button'>Add User</button>
    </form>

    <form action="actions/addTeam.php" method="post" id="add-team-form">
        <h2 class="form_title">Add Team</h2>
        <input type="text" name="teamName" placeholder="Team Name" required class='input-field'/><br>
        <input type="text" name="description" placeholder="Description" required class='input-field'/><br>
        <button type="submit" name="add_team" class='submit-button'>Add Team</button>
    </form>

    <!-- assign team to user  -->

    <form action="actions/assignTeam.php" method="post" id="add-team-form">
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

            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </select><br>


        <button type="submit" name="assign_team" class='submit-button'>save</button>
    </form>

    <main>


</body>

</html>