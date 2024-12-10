<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Explore Nepal Adventures</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
    <div class="img">
        <img src="./assets/logo.png" alt="life" height="70px" width="70px"> 
    </div>
    <div>
        <ul class="pages">
            <li><a href="./index.php">Home</a></li>
            <li class="dropdown">
                <button class="dropbtn">PROVINCES</button>
                <div class="dropdown-content">
                    <?php
                    // Example of dynamically generating province links
                    $provinces = array("province1", "province2", "province3", "province4", "province5", "province6", "province7");
                    foreach ($provinces as $province) {
                        echo "<a href='./$province.php'>$province</a>";
                    }
                    ?>
                </div>
            </li>
            <li><a href="./gallery.php">Gallery</a></li>
            <li><a href="./contact.php">Contact</a></li>
            <li><a href="./aboutus.php">About US</a></li>
        </ul>
    </div>
</header>
