<?php
include 'common.php';
include 'header.php';
include 'checklogin.php';

if(isset($_POST['Add']) && empty($_GET['Edit'])){

    $filename = $_FILES["photo"]["name"]; 
    $tempname = $_FILES["photo"]["tmp_name"];   
    $folder = "uploads/".basename($filename); 
    $class=$_POST['Class'];

    mysqli_query($con, "INSERT INTO class (class_name, file) VALUES ('$class', '$filename')");
    header("location: classlist.php");
    
}

if(empty($_POST['Class']) && !empty($_GET['Edit'])){

    $id=$_GET['Edit'];
    $res = mysqli_query($con,"SELECT class_name, file FROM class WHERE id='$id'");
    $r= mysqli_fetch_array($res);
    $class=$r['class_name'];
    $filename=$r["file"];

}   



if(isset($_POST['Update']) && !empty($_POST['id'])){
    
    $filename = $_FILES["photo"]["name"]; 
    $tempname = $_FILES["photo"]["tmp_name"];   
    echo $filename;
    $id = $_POST['id'];
    $class = $_POST['Class'];
    
    if (  $tempname != '')
     {

        move_uploaded_file( $tempname, $filename);
        mysqli_query($con, "UPDATE class set  class_name='$class',  file='$filename' where id=$id");
        header("location: classlist.php");

    }
  
     echo "<img src=".$filename.">"; 

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type='text/javascript'>
        function previewImage(event) 
        {
            let read = new FileReader();
            read.onload = function(){
            let output = document.getElementById('prev');
            output.src = read.result;
           }
         read.readAsDataURL(event.target.files[0]);
        }
</script>
</head>
<body>
<form method='post' action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>' enctype="multipart/form-data"><input type='hidden' placeholder='type here' class='name' name='id' value='<?php echo $id ?>' ><br>
  <fieldset>
    <legend>Class Details</legend>
   <table>
   <tr>
   <td><label for='Class'>Enter Class: </label></td>
   <td><input type='text' placeholder='type here' class='name'  name='Class' value='<?php echo $class ?>'></td>
   </tr>
   <tr>
   <td><label for='photo'>Select Photo: </label></td>
   <td><input type='file' class='name'  name='photo' onchange="previewImage(event)" value='<?php echo$filename ?>' ><?php echo$filename ?></input>
   </td>
   </tr>
   <?php if($filename){
       echo "<tr><td><img src=".$filename."></td></tr>";
    }
   ?>
   <tr><td><img id="prev"/></td>
  </tr>
</table>
   <input type="submit" name="<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Add';} ?>" value='<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Add';} ?>'>
   <input type='button' name='cancel' value='Cancel' onclick='window.location.href="<?php echo $location?>/classlist.php"'>
   <br>
   </fieldset>
</form>
</body>
</html>