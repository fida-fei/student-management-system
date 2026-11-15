<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request.");
}

$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$course = trim($_POST['course']);

if (!$id || empty($name) || empty($email)) {
    exit("Please provide a valid ID, name and email.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Please enter a valid email address.");
}

$sql = "UPDATE students
        SET name = ?, email = ?, phone = ?, course = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("ssssi", $name, $email, $phone, $course, $id);

if ($stmt->execute()) {

    header("Location: index.php?status=updated");
    exit();

} else {

    if ($stmt->errno === 1062) {

        header("Location: index.php?status=duplicate");
        exit();

    } else {

        echo "Error updating student: " . $stmt->error;

    }
}

$stmt->close();
$conn->close();

?>