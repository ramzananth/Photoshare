	    <?php
	    
	    	include("db.php");
	    
			$email= trim(mysql_escape_string($_GET['email']));
			$hash= trim(mysql_escape_string($_GET['hash']));
			
			if(isset($email) && !empty($email) && isset($hash) && !empty($hash))
			{
				// Verify data
				
				$search = mysql_query("SELECT EmailID, hash, active FROM userDetails 
				WHERE EmailID='".$email."' AND hash='".$hash."' AND active='0'")
				 or die(mysql_error()); 
				
				$match  = mysql_num_rows($search);
			
				if($match > 0){
					// We have a match, activate the account
					mysql_query("UPDATE userDetails SET active = 1 WHERE EmailID = '".$email."' AND hash='".$hash."' AND active = 0 ") or die(mysql_error());
					echo '<div class="statusmsg">Your account has been activated, you can  
					<a href="index.php">Login Here </a></div>';
				}
				else
				{
					// No match -> invalid url or account has already been activated.
					echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
				}

				
			}else{
				// Invalid approach
				echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
			}
			
	    	
	    ?>

