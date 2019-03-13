<?php
require 'localSettings.php';
ob_start(); // Turns on output buffering
session_start();

$timezone = date_default_timezone_set("America/Toronto");

$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check for errors connecting to DB
if (mysqli_connect_errno()) {
    echo "Failed to connect: " . mysqli_connect_errno();
}
?>