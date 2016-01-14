<?php 
include('db.php');
session_start();
{
    $user=($_POST['myusername']);
    $pass=mysql_real_escape_string(md5($_POST['mypassword']));
    $fetch=mysql_query("SELECT * FROM userDetails WHERE 
                         UserID = '$user' and Password='$pass' and active =1 ");

    $count=mysql_num_rows($fetch);

    if($count!="")
    {

    $_SESSION['login_username']=$user;
    header("Location:profile.php"); 
    }
    else
    {
       header('Location:index.php');
    }

}
?>