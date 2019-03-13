<?php
function parseValue($value) {
	$v = $value;
	$v = strip_tags($v);			// Remove html
	$v = str_replace(' ', '', $v);	// Remove spaces
	$v = ucfirst(strtolower($v));	// Make only the first character uppercase
	return $v;
}

$fname = "";
$lname = "";
$email = "";
$email2 = "";
$password = "";
$password2 = "";
$date = "";         	// Date of signup
$message_array = array(); // Hold error messages

// Get registration form values
if (isset($_POST['reg_button'])) {
	// Get values from the form and store in the session
	$fname = parseValue($_POST['reg_fname']);
	$_SESSION['reg_fname'] = $fname;
	$lname = parseValue($_POST['reg_lname']);
	$_SESSION['reg_lname'] = $lname;
	$email = parseValue($_POST['reg_email']);
	$_SESSION['reg_email'] = $email;
	$email2 = parseValue($_POST['reg_email2']);
	$_SESSION['reg_email2'] = $email2;
	$password = strip_tags($_POST['reg_password']);
	$password2 = strip_tags($_POST['reg_password2']);
	$date = date("Y-m-d");

	// Check emails match
	if ($email == $email2) {
		// Check for a valid email
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$email = filter_var($email, FILTER_VALIDATE_EMAIL);

			// Check if email exists
			$email_check = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");
			$num_rows = mysqli_num_rows($email_check);
			if ($num_rows > 0) {
				array_push($message_array,"Email already in use <br>");
			}
		} else {
			array_push($message_array,"Invalid email format<br>");
		}
	} else {
		array_push($message_array,"Emails do not match<br>");
	}

	// Check name length
	if (strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($message_array,"First name must be between 2 and 25 characters<br>");
	}
	if (strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($message_array,"Last name must be between 2 and 25 characters<br>");
	}

	// Check password match, length, and correct character requirements
	if ($password != $password2) {
		array_push($message_array,"Passwords do not match<br>");
	} else {
		if (strlen($password > 30 || strlen($password) < 8)){
			array_push($message_array,"Password must be between 8 and 30 characters<br>");
		} 
		else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,30}$/', $password)) {
			array_push($message_array,"Password must contain one letter, one number<br>Symbols ! @ # $ % are allowed<br>");
		}
	}

	// If there was no errors with registration
	if (empty($message_array)) {
		$password = md5($password); // Hash password
		
		$username = strtolower($fname . "_" . $lname);
		$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		$i = 0;
		// If the same username is already found add the value of i till it's unique
		while(mysqli_num_rows($check_username_query) != 0) {
			$i++;
			$username .= "_" . $i;
			$check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}

		// Create a default random profile pic
		$images = glob('assets/images/profile_pics/defaults/*');
		$profile_pic = $images[rand(0, count($images) - 1)];
		
		// Add user to database
		$query = mysqli_query($con, "INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES 
		(NULL, '$fname', '$lname', '$username', '$email', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')
		");
		array_push($message_array, "<span style='color:#14C800;'>You're all set! Go ahead and login!</style><br>");
		
		// Clear the session after successful entry
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
	}
}
?>