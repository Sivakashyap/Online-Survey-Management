<?php

@include 'db_connect.php';

if(isset($_POST['submit'])){

   $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
   $middlename = mysqli_real_escape_string($conn, $_POST['middlename']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO users(firstname,lastname,middlename,contact,address,email,password,type) VALUES('$firstname','$middlename','$lastname','$contact','$address','$email','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login.php');
      }
   }

};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register form</title>
   <link rel="stylesheet" href="styles.css">

   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">  

</head>
<body>
   
<div class="form-container">
   <video autoplay muted loop id="myVideo">
	<source src="chart.mp4" type="video/mp4">
	</video>
   <form method="post">
      <h3>register form</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="firstname" required placeholder="Firstname">
      <input type="text" name="middlename" required placeholder="Middlename">
      <input type="text" name="lastname" required placeholder="Lastname">
      <input type="email" name="email" required placeholder="Email">
      <input type="number" name="contact" required placeholder="Contact No.">
      <input type="text" name="address" required placeholder="Address">
      <input type="password" name="password" required placeholder="Password">
      <input type="password" name="cpassword" required placeholder="Confirm Password">
      <select name="user_type">
         <option value="1">Admin</option>
         <option value="2">Subscriber</option>
      </select>
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>Already Registered ? <a href="login.php">Login now</a></p>
   </form>

</div>

</body>
</html>