<?php

$host = "127.0.0.1";
$username = "your_username";
$password = "your_password";
$database = "student_management";
$port = 3307;

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Database connection failed.");
}
?>