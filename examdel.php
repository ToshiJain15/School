<?php
include 'common.php';
include 'checklogin.php';

  if(!empty($_GET['Delete'])){
    $key=$_GET['Delete'];
    mysqli_query($con,"DELETE FROM exam WHERE Id='$key'");
    header("location: examlist.php");
  }
?>