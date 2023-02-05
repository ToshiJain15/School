<?php

    $uploadOk = 1;  
    $nameErr = $passErr = "";
    $name_check = $rowCount = $name = $pass = $pass_check = "";
    $id=$ex=0;
    $student = $input = $class = $address = $filename = $pass_marks = $max = $subject = $gender = "";
    $hobbies = $marks = "";
    $sibling = $exams =  [];
    $hobby=['Cricket', 'Bowling', 'Singing', 'Dancing', 'Gardening'];
    $con = mysqli_connect("localhost","root","","school");

    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      exit();
    }
?>