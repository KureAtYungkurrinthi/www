<?php
require_once "includes/sessionValidator.php";
require_once "includes/dbConnect.php";

function fetchTasksByStatus($status) {
    global $conn;
    $tasks = [];

    $sql = "SELECT Tasks.*, Teams.teamName, Patients.firstName as patientFirstName, Patients.lastName as patientLastName, Rooms.roomNumber, Rooms.roomType 
            FROM Tasks 
            LEFT JOIN Teams ON Tasks.assigneeTeamID = Teams.teamID 
            LEFT JOIN Patients ON Tasks.patientID = Patients.patientID 
            LEFT JOIN Rooms ON Patients.roomID = Rooms.roomID 
            WHERE Tasks.status=? 
            ORDER BY Tasks.deadline;";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $status);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        mysqli_free_result($result);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);

    return $tasks;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="styles/kanban.css"/>
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>
    <script src="scripts/kanban.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="Kanban"/>
    <title>Kanban</title>
</head>

<body>
<?php require_once "includes/menu.php"; ?>

<main>
    <div class="flex-content">
        <div class="task-board">
            <?php
            $statuses = ["Pending" => "toDo", "In Progress" => "doing", "Completed" => "completed"];
            foreach ($statuses as $status => $columnId) {
                $tasks = fetchTasksByStatus($status);
                ?>
                <div id="<?php echo $columnId; ?>" class="task-column">
                    <div class="filter <?php echo ($status == "Pending" ? "info" : ($status == "In Progress" ? "warning" : "success")); ?>">
                        <h3><?php echo $status; ?></h3>
                        <div>
                            <button onclick="sortListByDate('<?php echo $columnId; ?>')">Sort by Due Date</button>
                            <button onclick="sortListByPriority('<?php echo $columnId; ?>')">Sort by Priority</button>
                        </div>
                    </div>
                    <?php
                    foreach ($tasks as $task) {
                        echo "<div class='task' data-due-date='" . htmlspecialchars($task["deadline"]) . "' data-priority='" . htmlspecialchars($task["priority"]) . "'>";
                        echo "<strong>" . htmlspecialchars($task["taskName"]) . "</strong><br>";
                        echo "Due Date: " . htmlspecialchars($task["deadline"]) . "<br>";
                        echo "Priority: " . htmlspecialchars($task["priority"]) . "<br>";
                        echo "Assigned Team: " . htmlspecialchars($task["teamName"]) . "<br>";

                        // If patient information is available, display it
                        if (!empty($task["patientFirstName"]) && !empty($task["patientLastName"])) {
                            echo "Patient: " . htmlspecialchars($task["patientFirstName"]) . " " . htmlspecialchars($task["patientLastName"]) . "<br>";

                            // If room information is available, display it
                            if (!empty($task["roomNumber"]) && !empty($task["roomType"])) {
                                echo "Room: " . htmlspecialchars($task["roomNumber"]) . " (" . htmlspecialchars($task["roomType"]) . ")<br>";
                            }
                        }
                        echo '<a href="actions/pendingTask.php?taskID=' . $task['taskID'] . '">Pending</a>' . " | ";
                        echo '<a href="actions/progressTask.php?taskID=' . $task['taskID'] . '">Progress</a>' . " | ";
                        echo '<a href="actions/completeTask.php?taskID=' . $task['taskID'] . '">Completed</a>';
                        echo "</div>";
                    }
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
</body>
</html>