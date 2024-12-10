<?php
include("useful_function.php");

$my_obj = new useful_function(); 

if(isset($_POST['save'])) {
    // Check if required fields are set
    if(isset($_POST['edit_id'], $_POST['image_title'], $_POST['old_gallery_image_name'])) {
        $edit_id = $_POST['edit_id'];
        $image_title = $_POST['image_title'];
        $old_gallery_image_name = $_POST['old_gallery_image_name'];
        
        // Check if a new image is uploaded
        if(!empty($_FILES['gallery_image']['name'])) {
            $target_dir = "../assets/images/uploaded_images/";
            $form_img_name = $_FILES['gallery_image']['name'];
            $form_img_tmp_name = $_FILES['gallery_image']['tmp_name'];
            
            // Call function to upload image
            $upload_img_name = $my_obj->image_upload($target_dir, $form_img_name, $form_img_tmp_name);
            
            // Check if image upload was successful
            if(!$upload_img_name) {
                echo "Error uploading image.";
                exit();
            }
        } else {
            // Keep the old image if no new image is uploaded
            $upload_img_name = $old_gallery_image_name;
        }

        // Update record in the database
        $tbl_name = "tbl_gallery";
        $id_name = "gallery_image_id";
        $mydataarr = array(
            'gallery_name' => $image_title,
            'gallery_image' => $upload_img_name
        );

        if($my_obj->update_record($tbl_name, $mydataarr, $con, $edit_id, $id_name)){
            echo "Updated successfully";
            header("Location: gallery_ops.php");
            exit();
        } else {
            echo "Error while updating record";
        }
    } else {
        echo "Required fields are not set";
    }
} else {
    echo "Form not submitted";
}
?>
