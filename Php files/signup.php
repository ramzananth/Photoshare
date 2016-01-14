<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Sign up</title>

</head>
<body>

	
	<!-- start wrap div -->	
	<div id="wrap">
	    <!-- start PHP code -->
	    <?php
	    
	    	include('db.php');
	    	
	    	if(isset($_POST['fname']) && !empty($_POST['fname']) AND 
	    		isset($_POST['lname']) && !empty($_POST['lname']) AND
	    		isset($_POST['userid']) && !empty($_POST['userid']) AND
	    		isset($_POST['email']) && !empty($_POST['email']))
	    	{
	    		$userid = ($_POST['userid']);
	    		$fname = ($_POST['fname']);
	    		$lname = ($_POST['lname']);
	    		$email = ($_POST['email']);
	    		
	    		$query = mysql_query("SELECT * FROM userDetails 
	    		WHERE UserID = '".$userid."' AND emailID ='".$email."'") 
	    		or die(mysql_error()); 
				
				$count = mysql_num_rows($query);
				
	    		if($count != "0") 
	    		{ 

	    		 echo "Sorry. You are an already registered user."; 
	    		 }
	    		 	
	    		else
	    		{
					if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
					{
						// Return Error - Invalid Email
						$msg = 'The email you have entered is invalid, please try again.';
					}
					
					else
					{
						// Return Success - Valid Email
						
						$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
					
						$hash = md5(rand(0,1000) ); // Generate random 32 character hash and assign it to a local variable.
						$password = rand(1000,5000); // Generate random number between 1000 and 5000 and assign it to a local variable.
						$active = 0;
 
					
						mysql_query("INSERT INTO userDetails (UserID, Password, FirstName, LastName, EmailID, hash, active) 
						VALUES('".$userid."', md5('".$password."'), '".$fname."', '".$lname."', '".$email."', '".$hash."', '".$active."')")
						or die(mysql_error());  
					
						$to      = $email; //Send email to our user
						$subject = 'Signup | Verification'; //// Give the email a subject 
						$message = '

						Thanks for signing up!
						Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
	
						------------------------
						Username: '.$userid.'
						Password: '.$password.'
						------------------------

						Please click this link to activate your account:
						http://www.ramyaananth.com/verify.php?email='.$email.'&hash='.$hash.'

						'; // Our message above including the link
					
						$headers = 'From:noreply@ramyaananth.com' . "\r\n"; // Set from headers
						$sentmail = mail($to, $subject, $message, $headers); // Send the email
						
						// if($sentmail == 1)
// 					    {
// 					        echo "<span style='color: #ff0000;'> Your Password Has Been Sent To Your Email Address.</span>";
//     					}
//         				else
//         				{
// 				   	     echo "<span style='color: #ff0000;'> Cannot send password to your e-mail address.Problem with sending mail...</span>";
//     					}

					}
				
	    		} 
	    		
	    	}	
	    	
	    ?>
	    <!-- stop PHP Code -->
	
		<!-- title and description -->	
		<h2>Signup Form</h2>
		<p>Please enter your name and email address to create your account</p>
		
		<?php 
			if(isset($msg)){ // Check if $msg is not empty
				echo '<div class="statusmsg">'.$msg.'</div>'; // Display our message and add a div around it with the class statusmsg
			} ?>
		
		<!-- start sign up form -->	
		<form action="" method="post">
		
			<label for="fname">First Name:</label>
			<input type="text" name="fname" value="" />
			<br><br>
			<label for="lname">Last Name:</label>
			<input type="text" name="lname" value="" />
			<br><br>
			<label for="userid">User ID:</label>
			<input type="text" name="userid" value="" />
			<br><br>
			<label for="email">Email:</label>
			<input type="text" name="email" value="" />
			<br><br>
			<input type="submit" class="submit_button" value="Sign up" />
		</form>
		<!-- end sign up form -->	
		
	</div>
	<!-- end wrap div -->	
</body>
</html>
