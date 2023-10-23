<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["roomID"])) {
        // Sanitize input
        $roomID = htmlspecialchars($_POST["roomID"]);
        $dischargeDate = date('Y-m-d');

        require_once "../includes/dbConnect.php";

        $sql = "UPDATE Patients SET dischargeDate = ? WHERE roomID = ? AND dischargeDate IS NULL;";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'si', $dischargeDate, $roomID);
            if (mysqli_stmt_execute($stmt)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}