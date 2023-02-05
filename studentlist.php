<?php
include 'common.php';
include 'header.php';
include 'checklogin.php';


if(!empty($_GET['search'] )){
  $txt = $_GET['search'] ;
  $r = array_search($txt, $hobby);
  echo $r;
  $result = mysqli_query($con,"SELECT * FROM Student WHERE id = '$txt' OR class_id = '$txt' OR name = '$txt' OR address = '$txt'  OR gender = '$txt' OR siblings = '$txt' OR hobbies = '$r'"); 
}else{
$result = mysqli_query($con,"SELECT student.id, class.class_name, student.name, student.address, student.hobbies, student.gender, student.siblings FROM student
inner join class on class.id=student.class_id
");
}

echo "<main><br><br><table>
 <tr><td><label>Student Table: </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
 <td><button onclick=\"window.location.href='$location/StudentAdd.php'\"> ADD </button></td></tr>
 <tr></tr><tr>
 <form method='get' action = '". htmlspecialchars($_SERVER['PHP_SELF']) ."'>
 <td><input type = 'search' name = 'search' placeholder='Search' title='Type here'> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
 <td><button onclick=\"window.location.href='$location/studentlist.php?search=". $input."'\"> Search </button></td></tr></table></main>
 <br><br></form>

<table border='1'>
            <tr>
              <th>ID</th>
              <th>Class</th>
              <th>Name</th>
              <th>Address</th>
              <th>Hobbies</th>
              <th>Gender</th>
              <th>Siblings</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr>";
            while($row = mysqli_fetch_array($result))
            
            {

              echo "<tr><td>".$row['id']."</td><td>".$row['class_name']." </td><td>".$row['name']."</td><td>".$row['address']." </td><td>".$row['hobbies']."</td><td>".$row['gender']."</td><td>".$row['siblings']."</td><td><a href='$location/StudentAdd.php?Edit=$row[id];'>Edit</a></td><td><a href='$location/studentdel.php?Delete=$row[id];'>Delete</a></td></tr>";

            }
            
          echo "</tbody></table>";

?>