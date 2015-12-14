<?php 
	include('config.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysql_real_escape_string($_POST['username']);
    $password = md5(mysql_real_escape_string($_POST['password']));
    $email = mysql_real_escape_string($_POST['email']);
	$firstname = mysql_real_escape_string($_POST['firstname']);
	$lastname = mysql_real_escape_string($_POST['lastname']);
	$age = mysql_real_escape_string($_POST['age']);
     
    $checkusername = mysql_query("SELECT * FROM Account WHERE username = '".$username."'");
      
    if(mysql_num_rows($checkusername) == 1) {
        echo "<h1>Error</h1>";
        echo "<p>Sorry, that username is taken. Please go back and try again.</p>";
    }
    else {
        mysql_query("INSERT INTO Account (username, password, email, firstname, lastname, age) VALUES('".$username."', '".$password."', '".$email."', '".$firstname."', '".$lastname."', '".$age."')");   
    }
}
else { ?>
		<form method="post" action="register.php" name="registerform" id="registerform">
    	<fieldset>
        <label for="username">Username:</label><input type="text" name="username" id="username" /><br>
        <label for="password">Password:</label><input type="password" name="password" id="password" /><br>
        <label for="email">Email:</label><input type="text" name="email" id="email" /><br>
		<label for="firstname">First name:</label><input type="text" name="firstname" id="firstname" /><br>
		<label for="lastname">Last name:</label><input type="text" name="lastname" id="lastname" /><br>
		<label for="age">Age:</label><input type="text" name="age" id="age" /><br>

		
        <input type="submit" name="register" id="register" value="Register" />
    </fieldset>
    </form>
    <?php
}

?>