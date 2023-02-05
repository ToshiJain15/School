<?php
include 'common.php';
include 'header.php';
include 'checklogin.php';

if(isset($_POST['Save']) && empty($_GET['Edit'])){

    $class = $_POST['Classname'];
    $name = $_POST['s_name'];
    $address = $_POST['address'];
    $hobbies = implode(',', $_POST['hobbies']);
    $gender = $_POST['gender'];
    $sibling = implode(',', $_POST['sibling']);
    mysqli_query($con, "INSERT INTO student (class_id, name, address, hobbies, gender, siblings) VALUES ('$class', '$name', '$address', '$hobbies', '$gender', '$sibling')");

    header("location: studentlist.php");
    
}

if(empty($_POST['Classname']) && !empty($_GET['Edit'])){
    $id = $_GET['Edit'];
    $res = mysqli_query($con,"SELECT * FROM student WHERE id='$id'");
    $r= mysqli_fetch_array($res);
    $class = $r['class_id'];
    $name = $r['name'];
    $address = $r['address'];
    $hobbies = explode(',', $r['hobbies']);
    $gender = $r['gender'];
    $sibling = explode(',', $r['siblings']);
}   


if(isset($_POST['Update']) && !empty($_POST['id'])){
    $class = $_POST['Classname'];
    $name = $_POST['s_name'];
    $address = $_POST['address'];
    $hobbies = implode(',', $_POST['hobbies']);
    $gender = $_POST['gender'];
    $id = $_POST['id'];
    $sibling = implode(',', $_POST['sibling']);
    mysqli_query($con, "UPDATE student set  class_id='$class',  name='$name', address='$address', hobbies='$hobbies',  gender = '$gender', siblings = '$sibling' where id=$id");
    header("location: studentlist.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script language="JavaScript">
    let counter=0;
    function add(){
        let name = document.getElementById("main").value;
        let data = document.getElementById("tData").innerHTML;
        let td = data+"<tr id="+counter+"><td><input type='text' placeholder='type here' name='sibling[]' value="+name+" />&nbsp;&nbsp;&nbsp;&nbsp;<td><input type='button' value='-' onclick='del("+counter+")' /></td></td>";
        document.getElementById("tData").innerHTML=td;
        document.getElementById("main").value = "";
        counter++;
    }
    function del(counter){
        document.getElementById(counter).remove();
    }
   </script>
</head>
<body>
    <form method='post' action= '<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>'><input type='hidden' placeholder='type here' class='name' name='id' value='<?php echo $id ?>' ><br>
        <fieldset>
             <legend>Student Details</legend>
             <table>
                <tr>
                <td><label for='Classname'>Select Class:</label></td>
                <td><select name = 'Classname' value='<?php echo $class?>'>
  <?php 
  
  $result = mysqli_query($con,"SELECT Distinct id,class_name FROM class");
  while($row = mysqli_fetch_array($result))
  {
      echo "<option value=".$row['id']." ".(($row['class_name'] == $class ) ? 'selected' : '') .">".$row['class_name']."</option>";
  }
  ?>
            
   </select></td></tr>
   <tr>
     <td><label for='s_name'>Enter name: </label></td>
     <td><input type='text' placeholder='type here' class='name'  name='s_name' value='<?php echo $name?>'></td></tr>
   <tr>
       <td><label for='address'>Address:</label></td> 
       <td><textarea name='address' rows="5" cols="40" value='<?php echo $address?>'><?php echo $address?></textarea></td></tr>
   <tr>
       <td><label for='hobbies[]'>Hobbies: </label><br>
   <?php 
   foreach ($hobby as $val){
     if ($hobbies == '')
       { 
         echo "<input type='checkbox' value = ".$val." name = 'hobbies[]'>".$val."<br>";
       }
       else
       {

       echo "<input type='checkbox' value = ".$val." name = 'hobbies[]' ". (in_array($val,$hobbies) ? 'checked' : '') .">".$val."<br>";
      
       }
   }
   
   ?></td></tr>

   <tr>
       <td><label for='gender'>Gender: </gender></td>  
       <td>
           <input type="radio" name='gender' value='Male'<?php echo ($gender == 'Male') ? 'checked' : ''; ?>>Male
           <input type="radio" name='gender' value='Female'<?php echo ($gender == 'Female') ? 'checked' : ''; ?>>Female</td></tr>
   <tr>
       <td><label>Siblings: </label></td> 
       <td>
           <input type = 'text' id = 'main' />
           <button type="button" onclick='add()'>+</button>
        </td></tr>
      <tr>
     <?php
      if ($sibling == [])
       { 
         echo   "<table name='t_data' id='tData'></table> </tr>";
       }
       else
       {
        echo   "<table name='t_data'  id='tData''>";
           foreach($sibling as $key=>$string){
                echo   "
                <tr id='$key'>
                <td><input type='text' placeholder='type here' name='sibling[]' value=".$string." >
                <td><input type='button' value='-' onclick='del($key)' ></td></td>";
            }
            echo "</table>";
       }
       ?>
   
</table>
</fieldset><br>
   <input type="submit" name="<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Save';} ?>" value='<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Save';} ?>'>
 
   <input type='button' name='cancel' value='Cancel' onclick='window.location.href="<?php echo $location?>/studentlist.php"'>
   <br>
   </form>
<script>
    counter=<?php echo count($sibling)?>;
</script>
</body>
</html>