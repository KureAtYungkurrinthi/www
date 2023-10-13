<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST["taskID"]) &&
        isset($_POST["taskName"]) &&
        isset($_POST["taskDescription"]) &&
        isset($_POST["assigneeTeamID"]) &&
        isset($_POST["deadline"]) &&
        isset($_POST["priority"])
    ) {
        $taskID = $_POST["taskID"];
        $taskName = $_POST["taskName"];
        $taskDescription = $_POST["taskDescription"];
        $assigneeTeamID = $_POST["assigneeTeamID"];
        $deadline = $_POST["deadline"];
        $priority = $_POST["priority"];

        require_once "../includes/dbConnect.php";

        $sql = "UPDATE Tasks SET 
                    taskName = ?, 
                    taskDescription = ?, 
                    assigneeTeamID = ?, 
                    deadline = ?, 
                    priority = ? 
                WHERE taskID = ?;";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed!";
        } else {
            mysqli_stmt_bind_param(
                $stmt,
                'ssisss',
                $taskName,
                $taskDescription,
                $assigneeTeamID,
                $deadline,
                $priority,
                $taskID
            );

            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "All fields are required!";
    }
}
?>
