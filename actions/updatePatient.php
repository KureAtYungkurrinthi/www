<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["patientID"], $_POST["name"], $_POST["admitDate"])) {
        // Extract name into first and last
        $name = explode(" ", $_POST["name"]);
        $firstName = $name[0];
        $lastName = $name[1] ?? '';  // Handling cases where only a first name is given
        $admitDate = $_POST["admitDate"];
        $patientID = $_POST["patientID"];

        require_once "../includes/dbConnect.php";  // Adjust the path as needed

        $sql = "UPDATE Patients SET firstName=?, lastName=?, admitDate=? WHERE patientID=?;";
        $statement = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($statement, $sql)) {
            echo "SQL error";
            exit();
        } else {
            mysqli_stmt_bind_param($statement, 'sssi', $firstName, $lastName, $admitDate, $patientID);

            if (mysqli_stmt_execute($statement)) {
                header("Location: ../index.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }

        mysqli_stmt_close($statement);
        mysqli_close($conn);
    }
}