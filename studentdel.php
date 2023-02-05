<?php
include 'common.php';
include 'checklogin.php';

  if(!empty($_GET['Delete'])){
    $key=$_GET['Delete'];
    mysqli_query($con,"DELETE FROM student WHERE Id='$key'");
    header("location: studentlist.php");
  }
?>