<?php
include 'common.php';
include 'checklogin.php';
include 'header.php';

$result = mysqli_query($con,"SELECT * FROM subject");

echo "<main>Subjects: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <button onclick=\"window.location.href='$location/subjectadd.php'\"> ADD </button></main><br><br>
<table border='1'>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {

              echo "<tr><td>".$row['id']."</td><td>".$row['name']."</td><td><a href='$location/subjectadd.php?Edit=$row[id];'>Edit</a></td><td><a href='$location/subjectdel.php?Delete=$row[id];'>Delete</a></td></tr>";
            }
            
          echo "</tbody></table>";

?>