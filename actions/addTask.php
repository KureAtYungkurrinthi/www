<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["taskName"]) &&
        isset($_POST["taskDescription"]) &&
        isset($_POST["assigneeTeamID"]) &&
        isset($_POST["deadline"]) &&
        isset($_POST["priority"]) &&
        isset($_POST["roomID"])
    ) {
        $taskName = $_POST["taskName"];
        $taskDescription = $_POST["taskDescription"];
        $assigneeTeamID = $_POST["assigneeTeamID"];
        $deadline = $_POST["deadline"];
        $priority = $_POST["priority"];
        $roomID = $_POST["roomID"];

        require_once "../includes/dbConnect.php";
        $sql = "SELECT patientID FROM Patients WHERE roomID = ? AND dischargeDate IS NULL;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $roomID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $patientData = mysqli_fetch_assoc($result);

        if ($patientData) {
            $patientID = $patientData['patientID'];

            $sql = "INSERT INTO Tasks (taskName, taskDescription, assigneeTeamID, patientID, deadline, status, priority) VALUES (?, ?, ?, ?, ?, 'Pending', ?);";
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'ssisss', $taskName, $taskDescription, $assigneeTeamID, $patientID, $deadline, $priority);

            if (mysqli_stmt_execute($stmt)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
}