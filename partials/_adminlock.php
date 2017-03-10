<?php
session_start();

if(isset($_SESSION['admin_user'])){
  $admin_check=$_SESSION['admin_user'];

  $ses_sql=mysql_query("select username from user_t where username='$admin_check' ");

  $row=mysql_fetch_array($ses_sql);

  $login_session=$row['username'];

  if(!isset($login_session))
    header("Location: index.php");

}
else
    header("Location: index.php");

?>