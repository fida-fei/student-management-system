<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Please submit the student form first.");
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$course = trim($_POST['course']);

if (empty($name) || empty($email)) {
    exit("Name and email are required.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

$sql = "INSERT INTO students (name, email, phone, course)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssss", $name, $email, $phone, $course);

if ($stmt->execute()) {
    header("Location: index.php?status=added");
    exit();
} else {
    if ($stmt->errno === 1062) {
        header("Location: index.php?status=duplicate");
        exit();
    } else {
        echo "Error adding student: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();

?>