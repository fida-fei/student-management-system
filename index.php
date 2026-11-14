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

</body>
</html>