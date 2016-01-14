<?php
include('db.php');
session_start();

  $check = $_SESSION['login_username'];
  $session = mysql_query("select FirstName from userDetails where UserID='$check' ");
  $row = mysql_fetch_array($session);
  $login_session = $row['FirstName'];

if(!isset($login_session))
 { 
   header("Location:index.php");
  }

?>