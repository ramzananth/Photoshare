<?php 
include('db.php');
session_start();
{
    $user = ($_POST['myusername']);
    $pass = mysql_real_escape_string(md5($_POST['mypassword']));

    $fetch = mysql_query("SELECT * FROM userDetails WHERE 
                         UserID = '$user'");

    $count = mysql_num_rows($fetch);

    if($count!="")
    {

		$fetch1 = mysql_query("SELECT * FROM userDetails WHERE 
                         UserID = '$user' and Password='$pass' ");
		
		$count1 = mysql_num_rows($fetch1);
		
		if($count1!="")
		{
    
       		$fetch2 = mysql_query("SELECT * FROM userDetails WHERE 
                         UserID = '$user' and Password='$pass' and active = 1");
                         
       		$count2 = mysql_num_rows($fetch2);
       
				if($count2!="")
				{
       				echo 'Authentication successful';
				}
       			else
       			{
       				echo 'UserID not active. Please check your email to activate your account.';
       			}
       	}		
       	else
       	{
			echo 'Invalid Username/Password.';
		}	
	}  	
       	
    else
    {
       echo 'Username doesnot exist in our database.';
    }

}
?>