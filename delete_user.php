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

// Check if the 'userID' parameter is set in the query string
if (isset($_GET["userID"])) {
    $userID = $_GET["userID"];

    // Delete the user with the given userID
    $deleteUserSql = "DELETE FROM users WHERE userID = '$userID'";
    if ($conn->query($deleteUserSql) === TRUE) {
        echo "User deleted successfully.";
        header("Location: users.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
}

// Close the database connection
$conn->close();
