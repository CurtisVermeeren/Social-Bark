<?php
 $con = mysqli_connect("localhost", "root", "", "social");

 // Check for errors connecting to DB
 if (mysqli_connect_errno()) {
     echo "Failed to connect: " . mysqli_connect_errno();
 }

 // Insert an entry into the table
 $query = mysqli_query($con, "INSERT INTO test VALUES ('1', 'Curtis')")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to SocialBark</title>
</head>
<body>
    Hello World!
</body>
</html>