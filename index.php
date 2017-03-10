<?php ob_start(); ?>
<?php
include('partials/_dbinfo.inc.php');
session_start();

if(isset($_SESSION['admin_user'])){
  ini_set("session.cookie_lifetime","3600"); 
  $admin_check=$_SESSION['admin_user'];

  $ses_sql=mysql_query("select username from user_t where username='$admin_check' ");

  $row=mysql_fetch_array($ses_sql);

  $login_session=$row['username'];

  if(isset($login_session))
    header("Location: admin.php");

}

?>
<!DOCTYPE html>
<html>
<head>
    <title>SPARTAX GYM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <style type="text/css">
    body 
       .well
       {
         width:33%;
       }
    </style>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
     </head>
<body>
<div class="container">
<?php
include "partials/_header.php";
?>
<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username=mysql_real_escape_string($_POST['username']); 
  $password=mysql_real_escape_string($_POST['password']); 
  $sql="SELECT * FROM user_t WHERE username='$username' and password='$password'";
  $result=mysql_query($sql);
  if(mysql_num_rows($result)==1){
    while ($row = mysql_fetch_assoc($result)) {
      $admin = $row['admin'];
      $id = $row['employee_id'];
      if($admin == 1){
        $session = array();
        $_SESSION['admin_user']=$username;
        header("location: admin.php");
      }else if($admin == 0){
        $session = array();
        $_SESSION['teacher']=$username;
        echo $username;
        header("location: teacher.php?teacher=$id");
      }
    }
  }
     else 
    {
      echo "Your Username or Password is invalid";
    }
}
ob_end_flush();
?>
<center>
<form method="post" class="well">
<h2>Please Login</h2> 
<input type="text" name="username" placeholder="Username" ><br>
<input type="password" name="password" placeholder="Password" ><br>
<input type="submit" value="Submit" class="btn btn-large btn-primary">
</form></center>
</div>



</body>
</html>