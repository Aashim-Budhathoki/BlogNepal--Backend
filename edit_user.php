<?php
session_start();
require_once "db_connect.php"; // Ensure this file includes your database connection

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: edit_user.php");
    exit();
}

// Fetch user details based on username
$username = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE user_name = '$username'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("User not found."); // Handle error if user is not found
}

// Handle form submission to update user data
if (isset($_POST['update'])) {
    // Sanitize and update user data
    $newUsername = mysqli_real_escape_string($con, $_POST['new_username']);
    $newEmail = mysqli_real_escape_string($con, $_POST['new_email']);

    $updateSql = "UPDATE users SET user_name = '$newUsername', user_email = '$newEmail' WHERE user_name = '$username'";
    if (mysqli_query($con, $updateSql)) {
        $_SESSION['username'] = $newUsername; // Update session if username changed
        echo '<script>alert("User data updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating user data: ' . mysqli_error($con) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style> /* Include your CSS styles here */ </style>
</head>
<body>
    <h1>Edit User</h1>
    <div class="log_in">
        <form action="edit_user.php" method="post">
            <table>
                <tr>
                    <td>New Username:</td>
                    <td><input type="text" name="new_username" value="<?php echo $row['user_name']; ?>" required></td>
                </tr>
                <tr>
                    <td>New Email:</td>
                    <td><input type="email" name="new_email" value="<?php echo $row['user_email']; ?>" required></td>
                </tr>
            </table>
            <button type="submit" name="update">Update</button>
        </form>
    </div>
</body>
</html>
