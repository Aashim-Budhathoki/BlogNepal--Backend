<?php
include("db_connect.php");

class useful_function
{
    public function image_upload($target_dir, $form_img_name, $form_img_tmp_name)
    {
        //getting extension of the image
        $ext = pathinfo($form_img_name, PATHINFO_EXTENSION);
        //generating random image name to upload file
        $image_name = rand(0, 999) . strtotime(date('Y-m-d H:i:s')) . rand(0, 443434) . "." . $ext;
        $target_file = $target_dir . $image_name;
        //check if the file or image already exists or not
        if(file_exists($target_file))
        {
            echo "Sorry, the image or file already exists";
        } else {
            //moving image to target directory
            if(move_uploaded_file($form_img_tmp_name,$target_file))
            {
                //successfully uploaded to target directory
                return $image_name;
            }
            echo "Sorry, there is an error while uploading your image or file.";
        }
    }

    public function insert_record($tbl_name, $insData, $con)
    {
        // Escape and quote values to prevent SQL injection
        $values = array_map(function($value) use ($con) {
            return "'" . mysqli_real_escape_string($con, $value) . "'";
        }, array_values($insData));
        
        // Prepare statement
        $query = "INSERT INTO $tbl_name (" . implode(',', array_keys($insData)) . ") VALUES (" . implode(',', $values) . ")";
        
        // Execute statement
        if(mysqli_query($con, $query)){
            return true;
        } else {
            return false;
        }
    }

    public function fetch_multiple_data($table_name){
        global $con;
        $query = "SELECT * FROM $table_name";
        $result = mysqli_query($con,$query);
        $final_result = array();
        if (mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $final_result[]= $row;
            }
        }
        return $final_result;
    }

    public function update_record($tbl_name, $mydataarr, $con, $edit_id, $id_name){
        global $con;
        $query_add = "";
        $counter = 0;
 
        foreach ($mydataarr as $key => $value) {
            $counter = $counter + 1;
            if($counter < (sizeof($mydataarr))){
                $query_add .= $key . "='" . $value . "', ";
            } else {
                $query_add .= $key . "='" . $value . "'";
            }
        }

        // Construct the update query
        $query = "UPDATE $tbl_name SET $query_add WHERE $id_name = $edit_id";

        // Execute the update query
        if(mysqli_query($con, $query)){
            return true;
        } else {
            return false;
        }
    }

    //function that fetch single row data from database  
    public function fetch_single_row_data($table_name, $edit_id, $id_name)
    {
        global $con;
        $query = "SELECT * FROM $table_name WHERE $id_name = $edit_id";
        $result = mysqli_query($con, $query);
        $final_result = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $final_result[] = $row;
            }
        }
        return $final_result;
    }
    // function that deletes single table row by id
    public function delete_single_record($table_name, $edit_id, $id_name)
    {
        global $con;
        $query = "DELETE FROM $table_name WHERE $id_name = $edit_id";
        if(mysqli_query($con, $query)){
            return true;
        } else {
            return false;
        }
    }
}
?>