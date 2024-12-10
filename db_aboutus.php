<?php
$con = mysqli_connect("localhost", "root", "", "db_project") or die("Connection Error");

$create_tbl = "CREATE TABLE if not exists tbl_aboutus (
   id INT AUTO_INCREMENT PRIMARY KEY,
   section_name VARCHAR(255) NOT NULL,
   content TEXT NOT NULL
)";

mysqli_query($con, $create_tbl) or die("Table creation error");

$insert = "INSERT INTO tbl_aboutus (section_name, content) VALUES
('mission', 'At Explore Nepal Adventures, our mission is to provide you with an unparalleled journey through Nepal\'s diverse landscapes, ancient traditions, and warm hospitality. We are dedicated to curating unforgettable travel experiences that blend adventure, culture, and natural wonders.'),
('why_choose_us', 'Local Expertise: Our team comprises experienced locals who intimately understand Nepal\'s hidden gems, ensuring you experience the country beyond the tourist trail.<br> Tailored Experiences: We believe in personalization. Your preferences and interests shape your itinerary, making each adventure uniquely yours.<br> Adventure and Culture: From trekking the Himalayas to exploring ancient temples, our itineraries encompass Nepal\'s thrilling activities and cultural heritage.<br> Sustainable Travel: We are committed to preserving Nepal\'s beauty for generations. Our eco-friendly practices promote responsible and sustainable tourism.'),
('connect_with_us', 'Stay updated with our latest offerings, travel tips, and captivating photos by following us on social media. Connect with us on:'),
('contact', 'Email: koiralasushil353@gmail.com, aasimbudathoki@gmail.com, khadkarikesh110@gmail.com<br>Phone: 9844377382, 9869612254, 9880613782, 9881323302, 9804589581<br>Address: Basuki Marg, Mid-Baneshwor, Ktm'),
('journey', 'Let us be your guides to Nepal\'s wonders. Whether you\'re an avid adventurer, a cultural explorer, or someone seeking tranquility in nature, Explore Nepal Adventures promises an experience that will stay with you forever. Embark on a journey of a lifetime. Explore Nepal with us.')";

mysqli_query($con, $insert) or die ("Insertion error");

?>
