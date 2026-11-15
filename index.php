<?php
include 'db.php';

$sql = "SELECT * FROM students ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
</head>
<body>

    <h1>Student Management System</h1>

    <h2>Add New Student</h2>

    <form action="add_student.php" method="POST">

        <label>Student Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Phone:</label><br>
        <input type="text" name="phone"><br><br>

        <label>Course:</label><br>
        <input type="text" name="course"><br><br>

        <button type="submit">Add Student</button>

    </form>

    <hr>

    <h2>Student List</h2>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['phone']); ?></td>
            <td><?php echo htmlspecialchars($row['course']); ?></td>
           <td>
    <a href="edit_student.php?id=<?php echo $row['id']; ?>">Edit</a>

    |

<a href="delete_student.php?id=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure you want to delete this student?');">
   Delete
</a></td>
        </tr>

        <?php } ?>

    </table>

</body>
</html>

<?php
$conn->close();
?>