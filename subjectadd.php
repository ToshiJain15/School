<?php
include 'common.php';
include 'header.php';
include 'checklogin.php';

if(isset($_POST['Add']) && empty($_GET['Edit'])){

    $subject=$_POST['Sub'];

    mysqli_query($con, "INSERT INTO subject (name) VALUES ('$subject')");
    header("location: subjectlist.php");
    
}

if(empty($_POST['Class']) && !empty($_GET['Edit'])){

    $id=$_GET['Edit'];
    $res = mysqli_query($con,"SELECT name FROM subject WHERE id='$id'");
    $r= mysqli_fetch_array($res);
    $subject=$r['name'];

}   



if(isset($_POST['Update']) && !empty($_POST['id'])){
    
    $id = $_POST['id'];
    $subject = $_POST['Sub'];

    mysqli_query($con, "UPDATE subject set name='$subject' where id=$id");
    header("location: subjectlist.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>'><input type='hidden' placeholder='type here' name='id' value='<?php echo $id ?>' ><br>
  <fieldset>
    <legend>Details</legend>
   <table>
   <tr>
   <td><label for='Class'>Enter Name: </label></td>
   <td><input type='text' placeholder='type here'   name='Sub' value='<?php echo $subject ?>'></td>
   </tr>
</table>
   <input type="submit" name="<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Add';} ?>" value='<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Add';} ?>'>
   <input type='button' name='cancel' value='Cancel' onclick='window.location.href="<?php echo $location?>/subjectlist.php"'>
   <br>
   </fieldset>
</form>
</body>
</html>