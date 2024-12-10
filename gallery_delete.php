<?php
include("useful_function.php");

$my_obj = new useful_function(); 

if(isset($_GET['id'])) {
    $gallery_id = $_GET['id'];

    $table_name = "tbl_gallery";
    $edit_id = $gallery_id; 
    $id_name = "gallery_image_id";  
    if($my_obj->delete_single_record($table_name, $edit_id, $id_name)) {
        echo "Record deleted successfully";
        header("Location: gallery_ops.php");
    } else {
        echo "Error while deleting data";
    }
} else {
    echo "No records found";
}
?>
