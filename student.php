<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    if ($action == 'add') {
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $marks = $_POST['marks'];

        if (empty($name) || empty($subject) || empty($marks)) {
            echo 'Error: Missing required fields';
            exit;
        }

        try {
            $stmt = $pdo->prepare('SELECT * FROM students WHERE name = ? AND subject = ?');
            $stmt->execute([$name, $subject]);
            $student = $stmt->fetch();

            if ($student) {
                $stmt = $pdo->prepare('UPDATE students SET marks = marks + ? WHERE id = ?');
                if ($stmt->execute([$marks, $student['id']])) {
                    echo 'Success';
                } else {
                    echo 'Error: Could not update student marks';
                }
            } else {
                $stmt = $pdo->prepare('INSERT INTO students (name, subject, marks, teacher_id) VALUES (?, ?, ?, ?)');
                if ($stmt->execute([$name, $subject, $marks, $_SESSION['teacher_id']])) {
                    echo 'Success';
                } else {
                    echo 'Error: Could not add student';
                }
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } elseif ($action == 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $marks = $_POST['marks'];

        if (empty($id) || empty($name) || empty($subject) || empty($marks)) {
            echo 'Error: Missing required fields';
            exit;
        }

        try {
            $stmt = $pdo->prepare('UPDATE students SET name = ?, subject = ?, marks = ? WHERE id = ?');
            if ($stmt->execute([$name, $subject, $marks, $id])) {
                echo 'Success';
            } else {
                echo 'Error: Could not update student';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } elseif ($action == 'delete') {
        $id = $_POST['id'];

        try {
            $stmt = $pdo->prepare('DELETE FROM students WHERE id = ?');
            if ($stmt->execute([$id])) {
                echo 'Success';
            } else {
                echo 'Error: Could not delete student';
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
