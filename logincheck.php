<?php
	session_start();
	include("config.ini.php"); //Establishing connection with our database
	
	$error = ""; //Variable for storing our errors.
	if(isset($_POST["submit"]))
	{
			// Define $username and $password
			$username=$_POST['username'];
			$password = md5(mysql_real_escape_string($_POST['password']));
			$password = substr($password, 0, 15);

			//Check username and password from database
			$query = "SELECT * FROM account WHERE password LIKE '$password%' AND username='$username'";
        	$result = mysql_query($query) or die(mysql_error());

			//If username and password exist in our database then create a session.
			//Otherwise echo error.
			if(mysql_num_rows($result) == 1)
			{	
				$_SESSION['username'] = $username; // Initializing Session
				header("location: index.php"); // Redirecting To Other Page
			}else
			{
				echo "Wrong username and/or password. You will be redirected in five seconds.";
				header( "refresh:5; url=login.php" ); 
				//$error = "Incorrect username or password.";
			}

	}

?>


