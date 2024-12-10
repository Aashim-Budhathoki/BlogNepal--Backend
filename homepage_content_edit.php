<?php
  include("useful_function.php");
//include("db_connect.php");

  $myobj = new useful_function();

//checking if the database contents homepage or not
  $homepage_content = $myobj->fetch_multiple_data('tbl_homepage');
//checking if the submit button is clicked or not
  if(isset($_POST['submit'])){
    //getting post data from edit form
    $edit_id = $_POST['edit_id'];
    $middle_text = $_POST['middle_text'];
    $body_content_title = $_POST['body_content_title'];
    $body_content_desc = $_POST['body_content_desc'];
    $upload_img_name="";
    $old_background_image = $_POST['old_background_image'];

    if(!empty($_FILES['background_image']['name'])){
        //checking if the image is done without any error

        if($_FILES["background_image"]["error"]==UPLOAD_ERR_OK){
        $target_dir = "../assets/images/uploaded_images/";
        $form_img_name = $_FILES['background_image']['name'];
        $form_img_tmp_name = $_FILES['background_image']['tmp_name'];

        //calling function to upload image
        $upload_img_name = $myobj-> image_upload($target_dir,$form_img_name,$form_img_tmp_name);

        //deleting old banner image
        unlink($target_dir.$old_background_image);
    }
    else{
        //image upload error
        echo "Error:".$_FILES['background_image']['error'];
    } 
    }else{
        $upload_img_name = $old_background_image;
    }
    //updating value in db
    //creating an array
    $tbl_name = "tbl_homepage";
    $id_name = "homepage_id";
    $mydataarr = array(
        "background_image"=>$upload_img_name,
        "middle_text"=> $middle_text,
        "body_content_title"=> $body_content_title,
        "body_content_desc"=> $body_content_desc
    );

    if($myobj->update_record($tbl_name, $mydataarr, $con, $edit_id, $id_name)){
        //query
        echo "Updated successfully";
        header("Location:homepage_content_edit.php");
    }else{
        echo "Error while updating record";
    }
  }  
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page content edit</title>
</head>
<body>
    <form action="homepage_content_edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name = "edit_id" value="<?php echo $homepage_content[0]['homepage_id']; ?>">
        <input type = "hidden" name = "old_background_image" value="<?php echo $homepage_content[0]['background_image']; ?>">
        <h1>Background Image:</h1>
        <input type="file" name="background_image" id="background_image"/>
        <?php if (!empty($homepage_content) && isset($homepage_content[0]['background_image'])): ?>
            <img src="../assets/images/uploaded_images/<?php echo $homepage_content[0]['background_image']; ?>" width="200px" height="200px" alt="">
        <?php endif; ?>
        <label for="middle_text">Middle text:</label>
        <input type="text" name="middle_text" id="middle_text" value="<?php echo $homepage_content[0]['middle_text'];  ?>">
        
        <h3>Body Content:</h3>
        <input type="text" name="body_content_title" id="body_content_title" value="<?php echo $homepage_content[0]['body_content_title']; ?>">
        <textarea name="body_content_desc" id="body_content_desc" cols="60" rows="20"><?php echo $homepage_content[0]['body_content_desc']; ?></textarea>

        <input type="submit" name="submit" value="Save" />
    </form>
</body>
</html>
