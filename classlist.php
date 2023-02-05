<?php
include 'common.php';
include 'checklogin.php';
include 'header.php';

$result = mysqli_query($con,"SELECT * FROM class");

echo "<main>Class Table: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <button onclick=\"window.location.href='$location/classadd.php'\"> ADD </button></main><br><br>
<table border='1'>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>File</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            {

              echo "<tr><td>".$row['id']."</td><td>".$row['class_name']."</td><td>".$row['file']."</td><td><a href='$location/classadd.php?Edit=$row[id];'>Edit</a></td><td><a href='$location/classdel.php?Delete=$row[id];'>Delete</a></td></tr>";
            }
            
          echo "</tbody></table>";

        

?>
