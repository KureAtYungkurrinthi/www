<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["firstName"], $_POST["lastName"], $_POST["gender"], $_POST["DOB"], $_POST["admitDate"], $_POST["roomID"])) {
        // Sanitize input
        $firstName = htmlspecialchars($_POST["firstName"]);
        $lastName = htmlspecialchars($_POST["lastName"]);
        $gender = htmlspecialchars($_POST["gender"]);
        $DOB = htmlspecialchars($_POST["DOB"]);
        $admitDate = htmlspecialchars($_POST["admitDate"]);
        $roomID = htmlspecialchars($_POST["roomID"]);

        require_once "../includes/dbConnect.php";

        $sql = "INSERT INTO Patients(firstName, lastName, gender, DOB, admitDate, roomID) VALUES(?, ?, ?, ?, ?, ?);";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssssi', $firstName, $lastName, $gender, $DOB, $admitDate, $roomID);
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