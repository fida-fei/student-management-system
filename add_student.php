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

$sql = "INSERT INTO students (name, email, phone, course)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssss", $name, $email, $phone, $course);

if ($stmt->execute()) {
    echo "Student added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>