<?php
session_start();
require_once "db_connect.php"; // Ensure this file includes your database connection

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: change_password.php");
    exit();
}

// Handle form submission to change password
if (isset($_POST['change'])) {
    $currentPassword = mysqli_real_escape_string($con, $_POST['current_password']);
    $newPassword = mysqli_real_escape_string($con, $_POST['new_password']);

    $username = $_SESSION['username'];
    $sql = "SELECT * FROM users WHERE user_name = '$username'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("User not found."); // Handle error if user is not found
    }

    // Verify current password
    if (md5($currentPassword) == $row['user_password']) {
        // Update password
        $newHashedPassword = md5($newPassword);
        $updateSql = "UPDATE users SET user_password = '$newHashedPassword' WHERE user_name = '$username'";
        if (mysqli_query($con, $updateSql)) {
            echo '<script>alert("Password changed successfully.");</script>';
        } else {
            echo '<script>alert("Error changing password: ' . mysqli_error($con) . '");</script>';
        }
    } else {
        echo '<script>alert("Incorrect current password.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style> /* Include your CSS styles here */ </style>
</head>
<body>
    <h1>Change Password</h1>
    <div class="log_in">
        <form action="change_password.php" method="post">
            <table>
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="current_password" required></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" required></td>
                </tr>
            </table>
            <button type="submit" name="change">Change Password</button>
        </form>
    </div>
</body>
</html>
