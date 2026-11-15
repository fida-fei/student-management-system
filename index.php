<?php
include 'db.php';

$search = trim($_GET['search'] ?? '');

if ($search !== '') {

    $sql = "SELECT * FROM students
            WHERE name LIKE ?
            OR email LIKE ?
            OR course LIKE ?
            ORDER BY id DESC";

    $stmt = $conn->prepare($sql);

    $searchTerm = "%" . $search . "%";

    $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $sql = "SELECT * FROM students ORDER BY id DESC";
    $result = $conn->query($sql);

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Student Management System</h1>

    <?php
    $countResult = $conn->query("SELECT COUNT(*) AS total FROM students");
    $studentCount = $countResult->fetch_assoc()['total'];
    ?>

    <p class="student-count">
        Total Students: <?php echo $studentCount; ?>
    </p>

    <?php
    if (isset($_GET['status'])) {

        if ($_GET['status'] === 'added') {
            echo "<p class='success-message'>Student added successfully!</p>";
        }

        elseif ($_GET['status'] === 'updated') {
            echo "<p class='success-message'>Student updated successfully!</p>";
        }

        elseif ($_GET['status'] === 'deleted') {
            echo "<p class='success-message'>Student deleted successfully!</p>";
        }

        elseif ($_GET['status'] === 'duplicate') {
            echo "<p class='error-message'>This email address is already registered!</p>";
        }

    }
    ?>

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

    <form action="index.php" method="GET">

        <input
            type="text"
            name="search"
            placeholder="Search by name, email or course..."
            value="<?php echo htmlspecialchars($search); ?>"
        >

        <button type="submit">Search</button>

        <a href="index.php">Clear</a>

    </form>

    <table border="1" cellpadding="10">

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Course</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
        ?>

        <tr>
            <td><?php echo $row['id']; ?></td>

            <td><?php echo htmlspecialchars($row['name']); ?></td>

            <td><?php echo htmlspecialchars($row['email']); ?></td>

            <td><?php echo htmlspecialchars($row['phone']); ?></td>

            <td><?php echo htmlspecialchars($row['course']); ?></td>

            <td>

                <a
                    class="edit-button"
                    href="edit_student.php?id=<?php echo $row['id']; ?>"
                >
                    Edit
                </a>

                |

                <form
                    action="delete_student.php"
                    method="POST"
                    class="delete-form"
                    onsubmit="return confirm('Are you sure you want to delete this student?');"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $row['id']; ?>"
                    >

                    <button type="submit" class="delete-button">
                        Delete
                    </button>

                </form>

            </td>
        </tr>

        <?php
            }

        } else {
        ?>

        <tr>
            <td colspan="6">No students found.</td>
        </tr>

        <?php
        }
        ?>

    </table>

</body>
</html>

<?php
$conn->close();
?>