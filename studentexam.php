<?php
include 'common.php';
include 'checklogin.php';
include 'header.php';

$result = mysqli_query($con,"SELECT student.id as id, exam.name as exam_name, student.name as name FROM student right join exam on exam.id=student.id");

echo "
<table align='center' border='1'>
            <tr>
              <th>Id</th>
              <th>Exam Name</th>
              <th>Name</th>
              <th>Total</th>
              <th>Passed/Failed</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {

              echo "<tr><td>".$row['id']."</td><td>".$row['exam_name']."</td><td>".$row['name']."</td><td></td><td></td><td><a href='$location/studentexamform.php?Edit=$row[id];'>Edit</a></td><td><a href='$location/studentexamdel.php?Delete=$row[id];'>Delete</a></td></tr>";
            }
            
          echo "</table>";

        

?>
