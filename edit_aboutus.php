<?php

$con = mysqli_connect("localhost", "root", "", "db_project") or die("Connection Error");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Loop through each section to update content
    foreach ($_POST['content'] as $section_name => $content) {
        $content = mysqli_real_escape_string($con, $content);
        $query = "UPDATE tbl_aboutus SET content='$content' WHERE section_name='$section_name'";
        $result = mysqli_query($con, $query);
        if (!$result) {
            die("Update failed: " . mysqli_error($con));
        }
    }
    // Redirect to aboutus.php after update
    header("Location: edit_aboutus.php");
    exit();
}

// Fetch content from the database
$result = mysqli_query($con, "SELECT * FROM tbl_aboutus");
$content = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $content[$row['section_name']] = $row['content'];
    }
} else {
    die("Error fetching content: " . mysqli_error($con));
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit About Us</title>
</head>
<body>
    <h2>Edit About Us Page</h2>
    <form method="post" action="edit_aboutus.php">
        <?php foreach ($content as $section_name => $section_content) { ?>
            <h3><?php echo ucfirst(str_replace('_', ' ', $section_name)); ?></h3>
            <textarea name="content[<?php echo $section_name; ?>]" rows="5" cols="50"><?php echo htmlspecialchars($section_content); ?></textarea><br>
        <?php } ?>
        <button type="submit">Save All Changes</button>
    </form>
</body>
</html>
