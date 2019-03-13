<?php 
$login_error_message = "";   // Holds any login error message

if (isset($_POST['log_button'])) {
    // Get login values
    $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
    $_SESSION['log_email'] = $email;
    $password = md5($_POST['log_password']);

    // Check db for matching email and password
    $check_database_query = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $check_login_query = mysqli_num_rows($check_database_query);

    if ($check_login_query == 1) {
        // Get values from the db row
        $row = mysqli_fetch_array($check_database_query);
        $username = $row['username'];
        $_SESSION['username'] = $username;

        // If the account was closed reopen it
        if ( $row['user_closed'] == 'yes') {
            $reopen_account = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
        }

        // Redirect to index
        header("Location: index.php");
        exit();
    } else {
        // Login was unsuccessful
        $login_error_message = "Email or password was incorrect<br>";
    }
}
?>