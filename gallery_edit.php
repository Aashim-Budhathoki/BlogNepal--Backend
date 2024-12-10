<?php
include("useful_function.php");

$my_obj = new useful_function(); 

if(isset($_GET['id'])) {
    $gallery_id = $_GET['id'];

    $table_name = "tbl_gallery";
    $edit_id = $gallery_id; 
    $id_name = "gallery_image_id";  
    $single_gallery_data = $my_obj->fetch_single_row_data($table_name, $edit_id, $id_name);

    // Ensure single_gallery_data is not empty
    if (!empty($single_gallery_data)) {
?>
<html>
<head>
    <title>Edit Gallery</title>
</head>
<body>
    <h3>Edit content</h3>
    <form action="gallery_update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="edit_id" value="<?php echo $single_gallery_data[0]['gallery_image_id']; ?>">
        <input type="hidden" name="old_gallery_image_name" value="<?php echo $single_gallery_data[0]['gallery_image']; ?>">
        <label for="gallery_image">Insert image:</label>
        <input type="file" name="gallery_image" id="gallery_image"/>
        <img width="100px" height="50px" src="../assets/images/uploaded_images/<?php echo $single_gallery_data[0]['gallery_image']; ?>">
        <br>
        <label for="image_title">Image title:</label>
        <input type="text" name="image_title" value="<?php echo $single_gallery_data[0]['gallery_name']; ?>" id="image_title"/>
        <br>
        <input type="submit" name="save" value="Save"/>
    </form>
<?php
    } else {
        echo "No records found";
    }
} else {
    echo "No data found";
}
?>
</body>
</html>

