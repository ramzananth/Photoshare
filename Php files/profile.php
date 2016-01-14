<?php
include("session.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hello world</title>

</head>
<body>


<h3 align="center"> Hello <?php echo $login_session; ?> </span> </h3> <h2 align="center" >Welcome to your profile page</h2> 

<h4 align="center">  click here to <a href="logout.php">LogOut</a> </h4>



</body>
</html>