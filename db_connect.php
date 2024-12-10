<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "db_project";
   
  $con = mysqli_connect($servername,$username,$password,$database);

  //checking conncetion
  if($con){
    //echo "Connection established";
  }else{
  	die("Connection failes".mysqli_connect_error());
  }
?>