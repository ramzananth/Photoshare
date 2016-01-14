<?php
	    
	    	        include('db.php');
	    	
	    		$fname = ($_POST['fname']);
	    		$lname = ($_POST['lname']);
	    		$userid = ($_POST['userid']);
	    		$email = ($_POST['email']);
	    		
	    		$query = mysql_query("SELECT * FROM userDetails 
	    		WHERE UserID = '$userid' AND emailID ='$email'") 
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
						echo 'The email you have entered is invalid, please try again.';
					}
				
				
					else
					{
					
					
					
						// Return Success - Valid Email
						
						echo 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
					
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
						

					}
					
				
	    		} 
	    		
	    		
	    	
	    ?>