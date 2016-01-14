
<?php 

session_start();
include "db.php"; //connects to the database

if (isset($_POST['myusername']))
{	
    $username = $_POST['myusername'];

    $query = mysql_query("select * from userDetails where UserID = '$username' ");
    $count = mysql_num_rows($query);

    // If the count is equal to one, an email will be sent to the user, other wise display an error message.


    if($count == 1)
    {
		
        $rows = mysql_fetch_array($query);
       
        $password = rand(1000,5000);
        $md5pass = md5($password);
        		
		mysql_query("UPDATE userDetails SET Password = '".$md5pass."' where UserID = '".$username."'")
				or die(mysql_error()); 
        
        $to = $rows['EmailID'];
        
        $subject = 'Password Recovery';

        //Details for sending E-mail

        $message  =  'Twicture password recovery 

        ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-
        Password Details for : '.$username.';
        Here is your new password  : '.$password.'
        Sincerely,
        Twicture Team';
        
        $headers = "From:no-reply@ramyaananth.com";

        $sentmail = mail ( $to, $subject, $message, $headers );
        

    } 
    else
    {
    	 echo "The entered username is not found in our database ";
    	 
    }

    
    
    //If the message is sent successfully, display success message else display an error message.
    
    if($sentmail == 1)
    {
        echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
    }
    else
    {
        echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
    }


}

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Recovery</title>
</head>
<body>
<form action="" method="post">
        <label>Please enter your UserID. Your password will be sent to your email address. </label><br><br>
        <label>UserID</label>
        <input id = "username" type = "text" name = "myusername" />
        <input id = "button" type = "submit" name = "button" value = "Submit" />
    </form>
</body>
</html> 