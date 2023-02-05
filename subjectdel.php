<?php
include 'common.php';
include 'checklogin.php';

  if(!empty($_GET['Delete'])){
    $key=$_GET['Delete'];
    mysqli_query($con,"DELETE FROM subject WHERE Id='$key'");
    header("location: subjectlist.php");
  }
?>