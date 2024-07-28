<?php
session_start();
require 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['teacher_id'])) {
    header('Location: index.html');
    exit;
}

// Fetch students
$stmt = $pdo->prepare('SELECT * FROM students WHERE teacher_id = ?');
$stmt->execute([$_SESSION['teacher_id']]);
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, Teacher</h2>
        <a href="logout.php" class="logout-button">Logout</a>
        <button onclick="showAddStudentModal()">Add Student</button>

        <table border="1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Marks</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                <tr data-id="<?= $student['id'] ?>">
                    <td><?= htmlspecialchars($student['name']) ?></td>
                    <td><?= htmlspecialchars($student['subject']) ?></td>
                    <td><?= htmlspecialchars($student['marks']) ?></td>
                    <td>
                        <button onclick="showEditStudentModal(<?= $student['id'] ?>, '<?= htmlspecialchars($student['name']) ?>', '<?= htmlspecialchars($student['subject']) ?>', <?= $student['marks'] ?>)">Edit</button>
                        <button onclick="deleteStudent(<?= $student['id'] ?>)">Delete</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Student Modal -->
    <div id="addStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddStudentModal()">&times;</span>
            <h2>Add New Student</h2>
            <form id="addStudentForm">
                <div class="form-group">
                    <label for="newName">Name:</label>
                    <input type="text" id="newName" required>
                </div>
                <div class="form-group">
                    <label for="newSubject">Subject:</label>
                    <input type="text" id="newSubject" required>
                </div>
                <div class="form-group">
                    <label for="newMarks">Marks:</label>
                    <input type="number" id="newMarks" required>
                </div>
                <button type="button" onclick="addStudent()">Add</button>
            </form>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div id="editStudentModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditStudentModal()">&times;</span>
            <h2>Edit Student Details</h2>
            <form id="editStudentForm">
                <input type="hidden" id="editStudentId">
                <div class="form-group">
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" required>
                </div>
                <div class="form-group">
                    <label for="editSubject">Subject:</label>
                    <input type="text" id="editSubject" required>
                </div>
                <div class="form-group">
                    <label for="editMarks">Marks:</label>
                    <input type="number" id="editMarks" required>
                </div>
                <button type="button" onclick="updateStudent()">Save Changes</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
