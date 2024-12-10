<?php
// Database connection setup
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch current content from database
$sql = "SELECT * FROM tbl_provinces WHERE id = 1"; // Assuming id 1 is used for Province:7 content
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentTitle = $row['title'];
    $currentParagraph = $row['paragraph'];
} else {
    echo "Content not found";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTitle = $_POST['title'];
    $newParagraph = $_POST['paragraph'];

    // Update content in the database
    $updateSql = "UPDATE tbl_provinces SET title='$newTitle', paragraph='$newParagraph' WHERE id=1"; // Assuming id 1 is used for Province:7 content

    if ($conn->query($updateSql) === TRUE) {
        echo "Content updated successfully";
        // Redirect to main page after saving
        header('Location: edit_province.php');
        exit;
    } else {
        echo "Error updating content: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Province 7 Content</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Province 7 Content</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="title">Province Title:</label><br>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($currentTitle); ?>"><br><br>
        
        <label for="paragraph">Paragraph:</label><br>
        <textarea id="paragraph" name="paragraph" rows="10" cols="50"><?php echo htmlspecialchars($currentParagraph); ?></textarea><br><br>
        
        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
