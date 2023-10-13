<?php
require_once "includes/sessionValidator.php";
require_once "includes/dbConnect.php";

if (isset($_GET['roomID'])) {
    $roomID = $_GET['roomID'];
    $roomID = mysqli_real_escape_string($conn, $roomID);
} else {
    echo "Room ID is not specified.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- Styles should be module and reference only when used in current page. -->
    <link rel="stylesheet" href="styles/menu.css"/>
    <link rel="stylesheet" href="styles/details.css"/>
    <!-- Same as above, script should also be module. -->
    <script src="scripts/menu.js" defer></script>
    <script src="scripts/details.js" defer></script>

    <meta name="author" content="Group 5"/>
    <meta name="description" content="Details"/>
    <title>Details</title>
</head>

<body>
<?php require_once "includes/menu.php"; ?>

<main>
    <div class="left-section">
        <section id="room-information">
            <h1>Room Information</h1>
            <?php
            $sql = "SELECT roomNumber, roomType FROM Rooms WHERE roomID=$roomID;";

            if ($result = mysqli_query($conn, $sql)) {
                $numRows = mysqli_num_rows($result);
                if ($numRows < 1) {
                    echo "<p>No information available for Room ID: $roomID</p>";
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<p>Room Number: " . $row["roomNumber"] . "</p>";
                        echo "<p>Room Type: " . $row["roomType"] . "</p>";
                    }
                }
                mysqli_free_result($result);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            ?>
        </section>

        <section id="patient-information">
            <h1>Patient Information</h1>
            <?php
            $sql = "SELECT * FROM Patients WHERE roomID=$roomID AND dischargeDate IS NULL;";
            if ($result = mysqli_query($conn, $sql)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    echo '<form id="patient-form" action="actions/updatePatient.php" method="post">';
                    echo '<label>Name: </label><input type="text" name="name" value="' . htmlentities($row['firstName'] . ' ' . $row['lastName']) . '" readonly><br>';
                    echo '<label>Gender: </label><input type="text" name="gender" value="' . htmlentities($row['gender']) . '" readonly><br>';
                    echo '<label>Age: </label><input type="text" name="age" value="' . htmlentities(date_diff(date_create($row['DOB']), date_create('today'))->y) . '" readonly><br>';
                    echo '<label>Admit Date: </label><input type="date" name="admitDate" value="' . htmlentities($row['admitDate']) . '" readonly><br>';
                    echo '<input type="hidden" name="patientID" value="' . $row['patientID'] . '">';
                    echo '<button type="button" id="edit-btn">Edit</button>';
                    echo '<button type="submit" id="submit-btn" style="display:none;">Submit</button>';
                    echo '<button type="button" id="cancel-btn" style="display:none;">Cancel</button>';
                    echo '</form>';
                } else {
                    echo "<p>No patient data available for Room ID: $roomID</p>";
                }
                mysqli_free_result($result);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            ?>
        </section>

        <section id="patient-management">
            <h1>Patient Management</h1>
            <?php
            $roomID = $_GET['roomID'] ?? '1';
            $sql = "SELECT * FROM Patients WHERE roomID = ? AND dischargeDate IS NULL;";
            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $roomID);

                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);

                    if (mysqli_num_rows($result) == 0) {
                        // No patient is currently assigned to the room, show admission form
                        echo '<form action="actions/admit.php" method="post">';
                        echo '<label for="firstName">First Name:</label>';
                        echo '<input type="text" id="firstName" name="firstName" required><br>';
                        echo '<label for="lastName">Last Name:</label>';
                        echo '<input type="text" name="lastName" required><br>';
                        echo '<label for="gender">Gender: </label>';
                        echo '<select name="gender" required>';
                        echo '<option value="Male">Male</option>';
                        echo '<option value="Female">Female</option>';
                        echo '<option value="Other">Other</option>';
                        echo '</select><br>';
                        echo '<label for="DOB">Date of Birth: </label>';
                        echo '<input type="date" name="DOB" required><br>';
                        echo '<label for="admitDate">Admit Date: </label>';
                        echo '<input type="date" name="admitDate" required><br>';
                        echo '<input type="hidden" name="roomID" value="'. htmlspecialchars($roomID) .'">';
                        echo '<input type="submit" value="Admit New Patient">';
                        echo '</form>';
                    } else {
                        // A patient is currently assigned to the room, don’t show the admission form
                        echo '<h2>Patient is currently assigned to this room.</h2>';
                        // Discharge form
                        echo '<form action="actions/discharge.php" method="post">';
                        echo '<input type="hidden" name="roomID" value="'. htmlspecialchars($roomID) .'">';
                        echo '<input type="submit" value="Discharge Current Patient">';
                        echo '</form>';
                    }

                    mysqli_free_result($result);
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            ?>
        </section>
    </div>
    <div class="right-section">
        <section id="detailed-information">
            <h1>Detailed Information</h1>

            <?php
            $sql = "SELECT * FROM Patients WHERE roomID=$roomID AND dischargeDate IS NULL;";
            if ($result = mysqli_query($conn, $sql)) {
                if ($row = mysqli_fetch_assoc($result)) {
                    echo '<form id="details-form" action="actions/updateDetails.php" method="post">';
                    echo '<label>Details: </label><textarea name="patientDetails" readonly>' . $row['patientDetails'] . '</textarea><br>';
                    echo '<label>Notes: </label><textarea name="notes" readonly>' . $row['notes'] . '</textarea><br>';
                    echo '<input type="hidden" name="patientID" value="' . $row['patientID'] . '">';
                    echo '<button type="button" id="edit-details-btn">Edit</button>';
                    echo '<button type="submit" id="submit-details-btn" style="display:none;">Submit</button>';
                    echo '<button type="button" id="cancel-details-btn" style="display:none;">Cancel</button>';
                    echo '</form>';
                } else {
                    echo "<p>No patient details available for this room.</p>";
                }
                mysqli_free_result($result);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            ?>

            <label>Documents:</label>
            <div id="documents-list">
                <?php
                $sqlDocs = "SELECT * FROM PatientDocuments WHERE patientID IN (SELECT patientID FROM Patients WHERE roomID=$roomID AND dischargeDate IS NULL);";

                if ($resultDocs = mysqli_query($conn, $sqlDocs)) {
                    while ($rowDoc = mysqli_fetch_assoc($resultDocs)) {
                        echo '<div class="document" data-docid="' . $rowDoc['documentID'] . '">';
                        echo '<a href="' . $rowDoc['documentPath'] . '" target="_blank">' . $rowDoc['documentType'] . '</a>';
                        echo '<button class="delete-doc-btn" style="display:none;">Delete</button>';
                        echo '</div>';
                    }
                    mysqli_free_result($resultDocs);
                } else {
                    echo "Error: " . $sqlDocs . "<br>" . mysqli_error($conn);
                }
                ?>
            </div>

            <input type="file" name="newDocument" id="newDocument" style="display:none;">
            <button type="button" id="upload-btn" style="display:none;">Upload New Document</button>
        </section>

        <section id="task-manager">
            <h1>Task Manager</h1>

            <h2>Current Tasks</h2>
            <?php
            $sql = "SELECT Tasks.*, Teams.teamName 
                    FROM Tasks 
                    LEFT JOIN Teams ON Tasks.assigneeTeamID = Teams.teamID 
                    WHERE patientID IN (
                    SELECT patientID 
                    FROM Patients 
                    WHERE roomID=? AND dischargeDate IS NULL)
                    AND Tasks.status <> 'Completed';";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                mysqli_stmt_bind_param($stmt, "i", $roomID); // binding roomID instead of patientID

                if (mysqli_stmt_execute($stmt)) {
                    $result = mysqli_stmt_get_result($stmt);

                    echo "<ul id='task-list'>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<li>";
                        echo "<strong>" . htmlentities($row['taskName']) . "</strong><br>";
                        echo "Description: " . htmlentities($row["taskDescription"]) . "<br>";
                        echo "Assigned Team: " . htmlentities($row["teamName"] ?? "None") . "<br>";
                        echo "Created At: " . htmlentities($row["createdAt"]) . "<br>";
                        echo "Deadline: " . htmlentities($row["deadline"]) . "<br>";
                        echo "Status: " . htmlentities($row["status"]) . "<br>";
                        echo "Priority: " . htmlentities($row["priority"]) . "<br>";
                        echo '<a href="actions/completeTask.php?taskID=' . $row['taskID'] . '">Mark as Completed</a>' . " | ";
                        echo '<a href="actions/deleteTask.php?taskID=' . $row['taskID'] . '">Delete Task</a>';
                        echo "</li>";
                    }
                    echo "</ul>";
                    mysqli_free_result($result);
                } else {
                    echo "Error: " . mysqli_stmt_error($stmt);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            ?>

            <h2>Add New Task</h2>
            <form action="actions/addTask.php" method="post">
                <label for="taskName">Task Name:</label>
                <input type="text" name="taskName" required><br>
                <label for="taskDescription">Task Description:</label>
                <textarea name="taskDescription" required></textarea><br>
                <label for="assigneeTeamID">Assign To Team:</label>
                <select name="assigneeTeamID" required>
                    <?php
                    $sql_teams = "SELECT * FROM Teams;";
                    if ($result_teams = mysqli_query($conn, $sql_teams)) {
                        while ($row_teams = mysqli_fetch_assoc($result_teams)) {
                            echo '<option value="' . $row_teams['teamID'] . '">' . htmlentities($row_teams['teamName']) . '</option>';
                        }
                        mysqli_free_result($result_teams);
                    }
                    ?>
                </select><br>
                <label for="deadline">Deadline:</label>
                <input type="date" name="deadline" required><br>
                <label for="priority">Priority:</label>
                <select name="priority" required>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select><br>
                <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
                <input type="submit" value="Add Task">
            </form>
        </section>
    </div>
</main>
</body>

</html>