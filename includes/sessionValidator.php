<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["user_email"])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}