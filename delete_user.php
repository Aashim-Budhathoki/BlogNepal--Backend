<?php
session_start();
require_once "db_connect.php"; // Ensure this file includes your database connection

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: delete_user.php");
    exit();
}

$username = $_SESSION['username'];

// Delete user from database
$deleteSql = "DELETE FROM users WHERE user_name = '$username'";
if (mysqli_query($con, $deleteSql)) {
    session_unset();
    session_destroy(); // Clear session data after deleting user
    echo '<script>alert("User deleted successfully.");</script>';
    header("Location: login_form.php");
    exit();
} else {
    echo '<script>alert("Error deleting user: ' . mysqli_error($con) . '");</script>';
}
?>
