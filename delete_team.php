<?php

$host = "localhost";
$username = "root";
$password = "12345";
$dbname = "flinderscare";

// Establish database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the 'teamID' parameter is set in the query string
if (isset($_GET["teamID"])) {
    $teamID = $_GET["teamID"];

    // Delete the team with the given id
    $deleteSql = "DELETE FROM teams WHERE teamID = '$teamID'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Team deleted successfully.";
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting : " . $conn->error;
    }
} else {
    echo "Team ID not provided.";
}

// Close the database connection
$conn->close();
