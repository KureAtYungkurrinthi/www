<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["patientID"]) && isset($_POST["patientDetails"]) && isset($_POST["notes"])) {

        // Sanitize input
        $patientID = intval($_POST["patientID"]); // Ensure the ID is an integer
        $patientDetails = htmlentities($_POST["patientDetails"]);
        $notes = htmlentities($_POST["notes"]);

        require_once "../includes/dbConnect.php"; // Your database connection file

        $sql = "UPDATE Patients SET patientDetails=?, notes=? WHERE patientID=?;";
        $stmt = mysqli_stmt_init($conn);

        // Prepare statement
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed!";
            // Close statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'ssi', $patientDetails, $notes, $patientID);
            // Execute prepared statement
            if (mysqli_stmt_execute($stmt)) {
                header("Location: ../index.php"); // Redirect back to your form page or a success page
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            // Close statement and connection
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    } else {
        echo "Patient ID, details, or notes not set in POST request!";
    }
} else {
    echo "Invalid Request Method";
}