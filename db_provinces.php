<?php
    $con = mysqli_connect("localhost", "root", "", "db_project");

    // Create table if not exists
    $create_tbl = "CREATE TABLE IF NOT EXISTS tbl_provinces (
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        paragraph TEXT NOT NULL
    )";

    mysqli_query($con, $create_tbl) or die("Table creation error: " . mysqli_error($con));

    // Insert initial data if needed
    $insert = "INSERT INTO tbl_provinces (title, paragraph) VALUES 
        ('Province:7 (Sudurpaschim)', 'The Province No. 7, also known as the Sudurpaschim Province covers 19,539 sq km area (about 13.22% of the country’s total area). The capital city is Godawari and the three major cities are Dhangadi, Bhimdutta (Mahendranagar), and Tikapur; Dhangadi being the largest city. The province has Tibet on its North, Province No 5 and 6 (Karnali Province and Lumbini Province respectively) on its East, states of India – Uttarakhand to its West, and Uttar Pradesh to its South. The province has a 40.6% Himalayan region, 34.54% Hilly region, and 24.86% Terai region in total. It lies to the far West of the country.There are a total of 9 districts in this province: Achham, Baitadi, Bajhang, Bajura, Dadeldhura, Darchula, Doti, Kailali, and Kanchanpur. There is 1 sub-metropolitan city, 33 municipalities, and 55 rural municipalities in the province. According to the 2011 census, the population is 2,552,517 which is 9.63% of the total population of Nepal. The majority of the people follow Hinduism (i.e. 97.23% people).')";

    mysqli_query($con, $insert) or die ("Insertion error: " . mysqli_error($con));
    
    echo "Insertion successful";
?>
