<?php
include 'common.php';
include 'checklogin.php';
include 'header.php';

$result = mysqli_query($con,"SELECT exam.id as id, exam.name as name, exam.passing_marks as passing_marks, exam.max_marks as max_marks, count(exam_subject.subject_id) as subject_count FROM exam inner join exam_subject on exam_subject.exam_id=exam.id group by exam.id");

echo "<main>Exams: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <button onclick=\"window.location.href='$location/examadd.php'\"> ADD </button></main><br><br>
<table border='1'>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Passing Marks</th>
              <th>Maximum Marks</th>
              <th>Subject Count</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {

              echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td>".$row['passing_marks']."</td><td>".$row['max_marks']."</td><td>".$row['subject_count']."</td><td><a href='$location/examadd.php?Edit=$row[id];'>Edit</a></td><td><a href='$location/examdel.php?Delete=$row[id];'>Delete</a></td></tr>";
            }
            
          echo "</tbody></table>";

?>