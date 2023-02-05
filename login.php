<?php
include 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LoginForm</title>
</head>
<body>
<?php
session_start();
$_SESSION=[];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);

    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if(empty($_POST["passwd"])) {
    $passErr = "Password is required";
  } else {
    $pass= test_input($_POST["passwd"]);
 
    if (strlen($_POST["passwd"]) <= 8) {
        $passErr = "Your Password Must Contain At Least 8 Characters!";
    }
    elseif(!preg_match("#[0-9]+#",$pass)) {
        $passErr = "Your Password Must Contain At Least 1 Number!";
    }
    elseif(!preg_match("#[A-Z]+#",$pass)) {
        $passErr = "Your Password Must Contain At Least 1 Capital Letter!";
    }
    elseif(!preg_match("#[a-z]+#",$pass)) {
        $passErr = "Your Password Must Contain At Least 1 Lowercase Letter!";
    }
  }
}
  

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  <fieldset> 
   <legend>LogIn</legend>
     <table>
      <tr>
        <td>Name:</td>
        <td> <input type="text" name="name" value="<?php echo $name;?>">
     <span class="error">* <?php echo $nameErr;?></span>
     </td>
     </tr>
     <tr></tr>
     <tr>
      <td>Password:</td> 
      <td><input type="password" name="passwd" value="<?php echo $pass;?>">
    <span class="error">* <?php echo $passErr;?></span><td>
    </tr>
    </table>
  <input type="submit" name="LogIn" value="LogIn">  
  </fieldset>
</form>
</body>


<?php 

if(isset($_POST['LogIn']) && $nameErr =='' && $passErr==''){
  $name_check = mysqli_query($con, "SELECT * FROM users WHERE username = '$name'  and password='$pass' ");
  $rowCount = mysqli_num_rows($name_check);
    if ($rowCount > 0){
      {
        $_SESSION['login_user'] = $name;

        header("location: classlist.php");
      }
    }
      else{

        $_SESSION['login_user'] = $name;
         mysqli_query($con, "INSERT INTO users(username, password) VALUES('$name', '$pass')");
         header("location: classlist.php");
        
      }

  
}


?>

</html>