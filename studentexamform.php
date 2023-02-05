<?php
include 'common.php';
include 'header.php';
include 'checklogin.php';

if(isset($_POST['Save']) && empty($_GET['Edit'])){
    $student = $_POST['s_name'];
    $name = $_POST['e_name'];
    $marks = implode(',', $_POST['marks']);

    mysqli_query($con, "INSERT INTO exam_student_subject (exam_id, student_id, subject_id, marks) VALUES ('$name', '$student', '$marks')");
    header("location: examlist.php");
}


if(empty($_POST['s_name']) && !empty($_GET['Edit'])){

    $id = $_GET['Edit'];
    $res = mysqli_query($con,"SELECT * FROM exam_student_subject WHERE id='$id'");
    $r= mysqli_fetch_array($res);
    $student = $r['student_id'];
    $name = $r['exam_id'];
    $marks = explode(',', $r['marks']);

}   


if(isset($_POST['Update']) && !empty($_POST['id'])){

    $student = $_POST['s_name'];
    $name = $_POST['e_name'];
    $marks = implode(',', $_POST['marks']);
    $id = $_POST['id'];

    mysqli_query($con, "UPDATE exam_student_subject set  exam_id='$student',  student_id='$name', marks='$marks' where id=$id");
    
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
    <form method='post' action= '<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>'><input type='hidden' placeholder='type here' class='name' name='id' value='<?php echo $id ?>' ><br>
        <fieldset>
                <legend>Marks</legend>
                <table>
                    <tr>
                    <td><label for='s_name'>Select Student Name:</label></td>
                    <td><select name = 's_name' value='<?php echo $student?>'>
                <?php 
                
                $result = mysqli_query($con,"SELECT Distinct id, name FROM student");
                while($row = mysqli_fetch_array($result))
                {
                    echo "<option value=".$row['id']." ".(($row['name'] == $student ) ? 'selected' : '') .">".$row['name']."</option>";
                }
                ?>
                            
                </select>
                </td></tr>
                <tr>
                    <td><label for='e_name'>Exam name: </label></td>
                    <td><select name = 'e_name' value='<?php echo $name?>'>
                <?php 
                
                $result = mysqli_query($con,"SELECT Distinct id, name FROM exam");
                while($row = mysqli_fetch_array($result))
                {
                    echo "<option value=".$row['id']." ".(($row['name'] == $name ) ? 'selected' : '') .">".$row['name']."</option>";
                }
                ?>
                </select>
                </td></tr>

                <tr>
                    <td><label for='marks[]'>Enter Subject Marks: </label></td></tr><br>
                    <?php 
                
                            $result = mysqli_query($con,"SELECT Distinct id, name FROM subject");
                            while($row = mysqli_fetch_array($result))
                            {
                                echo "<tr><td><label value=".$row['id'].">".$row['name']." </label ></td><td><input type='text' placeholder='type here'  name='marks[] ' value='$marks'><br>";

                            }

                        ?>
                </td></tr>
                
                </table>
</fieldset><br>
   <input type="submit" name="<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Save';} ?>" value='<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Save';} ?>'>
 
   <input type='button' name='cancel' value='Cancel' onclick='window.location.href="<?php echo $location?>/studentexamform.php"'>
   <br>
   </form>
</body>
</html>