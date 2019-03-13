<?php
require 'config/config.php';
require 'includes/formHandlers/registrationFormHandler.php';
require 'includes/formHandlers/loginFormHandler.php';
?>

<html>
<head>
    <title>SocialBark - Register</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register_style.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="assets/js/register.js"></script>
</head>
<body>

	<?php
		if(isset($_POST['reg_button'])) {
			echo '
				<script>
					$(document).ready(function() {
						$("#first").hide();
						$("#second").show();
					});
				</script>
			';
		}
	?>

	<div class="wrapper">
		<div class="login_box">
		<div class="login_header">
			<h1> SocialBark</h1>
			Login or signup below!
		</div>
			<div id="first">
				<form action="register.php" method="POST">
					<?php 
						echo $login_error_message;
					?>
					<input type="email" name ="log_email" placeholder="Email Address" value="<?php 
						if(isset($_SESSION['log_email'])){
							echo $_SESSION['log_email'];
						}?>" 
					required/><br>
					<input type="password" name ="log_password" placeholder="Password" required/><br>
					<input type="submit" name="log_button" value="Login"/><br>
					<a href="#" id="signup" class="signup">Need an account? Register here</a>
				</form>
			</div>
			<div id="second">
				<form action="register.php" method="POST">
					<?php 
						// Print any error messages
						foreach ($message_array as $message) {
							echo $message;
						}
					?>
					<input type="text" name="reg_fname" placeholder="First Name" value="<?php if(isset($_SESSION['reg_fname'])){
						echo $_SESSION['reg_fname'];
					}?>" required/>
					<br>		
					<input type="text" name="reg_lname" placeholder="Last Name" value="<?php if(isset($_SESSION['reg_lname'])){
						echo $_SESSION['reg_lname'];
					}?>" required/>
					<br>
					<input type="email" name="reg_email" placeholder="Email" value="<?php if(isset($_SESSION['reg_email'])){
						echo $_SESSION['reg_email'];
					}?>" required/>
					<br>
					<input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php if(isset($_SESSION['reg_email2'])){
						echo $_SESSION['reg_email2'];
					}?>" required/>
					<br>
					<input type="password" name="reg_password" placeholder="Password" required/><br>
					<input type="password" name="reg_password2" placeholder="Confirm Password" required/><br>
					<input type="submit" name="reg_button" value="Register"/><br>
					<a href="#" id="signin" class="signin">Have an account? Login here</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>