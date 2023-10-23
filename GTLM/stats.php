<?php require_once "includes/sessionValidator.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="styles/stats.css"/>
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="Task Statistics"/>
    <title>Task Statistics</title>
</head>

<body>
<?php require_once "includes/menu.php"; ?>

<main>
    <h1>Task Statistics</h1>
    <?php
    require_once "includes/dbConnect.php";

    // A helper function to execute and return the result of a SQL query.
    function get_stat($conn, $query)
    {
        if ($result = mysqli_query($conn, $query)) {
            $row = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            return array_values($row)[0];
        } else {
            echo "Error: " . mysqli_error($conn);
            return null;
        }
    }

    ?>

    <table>
        <tr>
            <th>Statistic</th>
            <th>Count</th>
        </tr>
        <tr>
            <td>No of tasks Pending</td>
            <td><?php echo get_stat($conn, "SELECT COUNT(*) FROM Tasks WHERE status='Pending'"); ?></td>
        </tr>
        <tr>
            <td>No of tasks In Progress</td>
            <td><?php echo get_stat($conn, "SELECT COUNT(*) FROM Tasks WHERE status='In Progress'"); ?></td>
        </tr>
        <tr>
            <td>No of tasks Completed</td>
            <td><?php echo get_stat($conn, "SELECT COUNT(*) FROM Tasks WHERE status='Completed'"); ?></td>
        </tr>
        <tr>
            <td>No of tasks not Completed in High priority</td>
            <td><?php echo get_stat($conn, "SELECT COUNT(*) FROM Tasks WHERE status<>'Completed' AND priority='High'"); ?></td>
        </tr>
        <tr>
            <td>No of tasks not Completed in Medium priority</td>
            <td><?php echo get_stat($conn, "SELECT COUNT(*) FROM Tasks WHERE status<>'Completed' AND priority='Medium'"); ?></td>
        </tr>
        <tr>
            <td>No of tasks not Completed in Low priority</td>
            <td><?php echo get_stat($conn, "SELECT COUNT(*) FROM Tasks WHERE status<>'Completed' AND priority='Low'"); ?></td>
        </tr>
    </table>

    <h2>Tasks per Team</h2>
    <table>
        <tr>
            <th>Team</th>
            <th>Total Tasks</th>
            <th>Completed</th>
            <th>Not Completed</th>
        </tr>
        <?php
        if ($result = mysqli_query($conn, "SELECT teamName, COUNT(*) as total, SUM(status='Completed') as completed, SUM(status<>'Completed') as not_completed FROM Tasks JOIN Teams ON assigneeTeamID = teamID GROUP BY teamName;")) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["teamName"] . "</td><td>" . $row["total"] . "</td><td>" . $row["completed"] . "</td><td>" . $row["not_completed"] . "</td></tr>";
            }
            mysqli_free_result($result);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </table>

</main>
</body>

</html>