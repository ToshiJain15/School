<?php
include 'common.php';
include 'header.php';
include 'checklogin.php';


if(isset($_POST['Save']) && empty($_GET['Edit'])){
    $name = $_POST['e_name'];
    $pass_marks = $_POST['pass'];
    $max = $_POST['max'];

    mysqli_query($con, "INSERT INTO exam (name, passing_marks, max_marks) VALUES ( '$name', '$pass_marks', '$max')");

       $exams = $_POST['subjects'];

    foreach ($exams as $val){
  
        mysqli_query($con, "INSERT INTO exam_subject (exam_id, subject_id) SELECT exam.id, '$val' FROM exam WHERE name='$name'");

      }


    header("location: examlist.php");
    
}

if(empty($_POST['Classname']) && !empty($_GET['Edit'])){

    $id = $_GET['Edit'];
    $res = mysqli_query($con,"SELECT * FROM exam WHERE id='$id'");
    $r= mysqli_fetch_array($res);
    $name = $r['name'];
    $pass_marks = $r['passing_marks'];
    $max = $r['max_marks'];
  
    $result = mysqli_query($con,"SELECT subject_id FROM exam_subject WHERE exam_id=$id ");
    $exams=[];
    while($e= mysqli_fetch_array($result)){
     array_push($exams , $e['subject_id']);

    }
     
}   


if(isset($_POST['Update']) && !empty($_POST['id'])){


    // echo "<pre>";
    // print_r($_POST);exit;
    $name = $_POST['e_name'];
    $pass_marks = $_POST['pass'];
    $max = $_POST['max'];
    $exam = count($_POST['subjects']);
    $id = $_POST['id'];

    mysqli_query($con, "UPDATE exam set name='$name', passing_marks='$pass_marks', max_marks='$max', subject_count='$exam' where id=$id");
   
    $id= $_POST['id'];
    $exams = $_POST['subjects'];
    mysqli_query($con,"DELETE FROM exam_subject where exam_id='$id'");
    foreach ($exams as $val){
        
        mysqli_query($con,"INSERT exam_subject set subject_id = '$val', exam_id='$id'");

      }
    
    header("location: examlist.php");

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
        <table>
            <tr>
                <td><label for='e_name'>Enter name: </label><input type='hidden' placeholder='type here' name='id' value='<?php echo $id ?>'></td>
                <td><input type='text' placeholder='type here' class='name'  name='e_name' value='<?php echo $name?>'></td>
            </tr>
            <tr>
                <td><label for='pass'>Enter passing marks: </label></td>
                <td><input type='text' placeholder='type here' class='name'  name='pass' value='<?php echo $pass_marks?>'></td>
            </tr>
            <tr>
                <td><label for='max'>Enter maximum marks: </label></td>
                <td><input type='text' placeholder='type here' class='name'  name='max' value='<?php echo $max?>'></td>
            </tr>
            <tr>
                <td><label for='subjects[]'>Subjects: </label><br>
                <?php 
  
                    $result = mysqli_query($con,"SELECT Distinct id, name FROM subject");
                    while($row = mysqli_fetch_array($result))
                    {

                        if ($exams == '')
                        { 
                            echo "<input type='checkbox' value = ".$row['id']." name = 'subjects[]' >".$row['name']."<br>";
                        }
                        else
                        {
                           // print_r($e);
                            echo "<input type='checkbox' value = ".$row['id']." name = 'subjects[]' ". (in_array($row['id'],$exams) ? 'checked' : '') .">".$row['name']."<br>";
                       
                        }

                    }

                ?>
            </tr>
            </table>
   </fieldset><br>
   <input type="submit" name="<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Save';} ?>" value='<?php if(!empty($_GET['Edit'])){ echo 'Update';} else{echo 'Save';} ?>'>
 
   <input type='button' name='cancel' value='Cancel' onclick='window.location.href="<?php echo $location?>/examlist.php"'>
   <br>
   </form>
</body>
</html>