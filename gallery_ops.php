<?php
// Include database connection
include("db_connect.php");

// Include useful function class
include("useful_function.php");

// Create object of a class called useful function
$myobj = new useful_function();

if(isset($_POST['save'])) {
    // Getting all the data from the form
    $image_title = $_POST['image_title'];

    // Code to upload image
    if($_FILES["gallery_image"]["error"] == UPLOAD_ERR_OK) {
        $target_dir = "../assets/images/uploaded_images/";
        $form_img_name = $_FILES['gallery_image']['name'];
        $form_img_tmp_name = $_FILES['gallery_image']['tmp_name'];

        // Calling function to upload image
        $upload_img_name = $myobj->image_upload($target_dir, $form_img_name, $form_img_tmp_name);
    } else {
        // Image upload error
        echo "Error: " . $_FILES['gallery_image']['error'];
    }

    // Create gallery data array
    $gallery_data_array = array(
        'gallery_name' => $image_title,
        'gallery_image' => $upload_img_name
    );

    // Define table name
    $table_name = "tbl_gallery";

    // Insert record into the database
    if($myobj->insert_record($table_name, $gallery_data_array, $con)) {
        //echo "Record Inserted successfully";
    } else {
        echo "Error while inserting record";
    }
}

    //fetching all product data from database
    $all_image=$myobj->fetch_multiple_data('tbl_gallery');
    //echo "<pre>";
    //print_r($all_image); 
?>

<html>
<head>
    <title>Gallery Operations</title>
</head>
<body>
   <h3>Image List</h3>
    <table border="1">
        <tr>
            <th>S.N</th>
            <th>Gallery Title</th>
            <th>Gallery Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach($all_image as $key => $value): ?>
            <tr>
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $value['gallery_name']; ?></td>
                <td><img src="../assets/images/uploaded_images/<?php echo $value['gallery_image']; ?>" style="max-width: 100px; max-height: 100px;"></td>
                <td><a href="gallery_edit.php?id=<?php echo $value['gallery_image_id']?>">Edit</a> || <a href="gallery_delete.php?id=<?php echo $value['gallery_image_id']?>" onclick="return confirm('Are you sure you want to delete this record? Please take a moment to review your decision before proceeding.')">Delete</a></td>

            </tr>
        <?php endforeach; ?>
    </table>




    <form action="gallery_ops.php" method="post" enctype="multipart/form-data">
        <h3>For gallery content</h3>
        <label for="gallery_image">Insert image:</label>
        <input type="file" name="gallery_image" id="gallery_image"/>
        <label for="image_title">Image title:</label>
        <input type="text" name="image_title" id="image_title"/>
        <input type="submit" name="save" value="Save"/>
    </form>
</body>
</html>
