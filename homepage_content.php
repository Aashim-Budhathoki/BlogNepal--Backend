<?php
include("useful_function.php");
//include("db_connect.php");

$myobj = new useful_function();
//check if the data is posted from the form or not
//checking if the database contents homepage or not
$homepage_content = $myobj->fetch_multiple_data('tbl_homepage');
   if(!empty($homepage_content)){
      header("Location: homepage_content_edit.php");
      exit;
   }
if(isset($_POST['submit']))
{
    $middle_text = $_POST['middle_text'];
    $body_content_title = $_POST['body_content_title'];
    $body_content_desc = $_POST['body_content_desc'];

    //code to upload image
    if($_FILES["background_image"]["error"]==UPLOAD_ERR_OK){
        $target_dir = "../assets/images/uploaded_images/";
        $form_img_name = $_FILES['background_image']['name'];
        $form_img_tmp_name = $_FILES['background_image']['tmp_name'];

        //calling function to upload image
        $upload_img_name = $myobj-> image_upload($target_dir,$form_img_name,$form_img_tmp_name);
    }
    else{
        //image upload error
        echo "Error:".$_FILES['background_image']['error'];
    }
    //creating an array
    $tbl_name = "tbl_homepage";
    $mydataarr = array(
        "background_image"=>$upload_img_name,
        "middle_text"=> $middle_text,
        "body_content_title"=> $body_content_title,
        "body_content_desc"=> $body_content_desc
    );

    if($myobj->insert_record($tbl_name, $mydataarr, $con)){
        echo "Record Inserted successfully";
    }else{
        echo "Error while inserting record";
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Homepage content </title>
</head>
<body>
    <form action="homepage_content.php" method="post" enctype="multipart/form-data">
        <h1>Background Image:</h1>
        <input type="file" name="background_image" id="background_image"/>
        <label for="middle_text">Middle text:</label>
        <input type="text" name="middle_text" id="middle_text">
        
        <h3>Body Content:</h3>
        <input type="text" name="body_content_title" id="body_content_title">
        <textarea name="body_content_desc" id="body_content_desc" cols="60" rows="20"></textarea>
        <input type= "submit" name="submit" value="Save"/ >
    </form>
</body>
</html>
