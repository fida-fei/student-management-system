<?php

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Invalid request.");
}

if (!isset($_POST['id']) || !filter_var($_POST['id'], FILTER_VALIDATE_INT)) {
    exit("Invalid student ID.");
}

$id = (int) $_POST['id'];

$sql = "DELETE FROM students WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?status=deleted");
    exit();
} else {
    echo "Error deleting student: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>