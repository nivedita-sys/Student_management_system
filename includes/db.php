<?php
$conn = new mysqli("localhost", "root", "12345678", "student_management");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
