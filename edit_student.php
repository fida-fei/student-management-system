<?php

include 'db.php';

if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    exit("Invalid student ID.");
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    exit("Student not found.");
}

$student = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Edit Student Details</h1>

    <form action="update_student.php" method="POST">

        <input type="hidden" name="id"
               value="<?php echo $student['id']; ?>">

        <label>Name:</label><br>
        <input type="text" name="name"
               value="<?php echo htmlspecialchars($student['name']); ?>"
               required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email"
               value="<?php echo htmlspecialchars($student['email']); ?>"
               required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone"
               value="<?php echo htmlspecialchars($student['phone'] ?? ''); ?>"><br><br>

        <label>Course:</label><br>
        <input type="text" name="course"
               value="<?php echo htmlspecialchars($student['course'] ?? ''); ?>"><br><br>

        <button type="submit">Update Student</button>

    </form>

    <br>

    <a href="index.php">Back to Student List</a>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>