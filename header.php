<?php
$location="http://localhost/toshi/School";
echo
"<ul style='list-style-type: none; text-indent: 90px'>
    <li style='float:left;'><a href=$location/classlist.php style='text-decoration:none;'>Class</a></li>
    <li style='float:left';><a href=$location/studentlist.php style='text-decoration:none;'>Student</a></li>
    <li style='float:left';><a href=$location/subjectlist.php style='text-decoration:none;'>Subjects</a></li>
    <li style='float:left';><a href=$location/examlist.php style='text-decoration:none;'>Exams</a></li>
    <li style='float:left';><a href=$location/studentexam.php style='text-decoration:none;'>Student Exam</a></li>
    <li style='float:left';><a href=$location/logout.php style='text-decoration:none;'>Logout</a></li>
</ul><br><br>"
?>