<?php

  session_start();

  include 'connect.php';
  $_SESSION['message']='';

  if($_SERVER['REQUEST_METHOD']=='POST'){
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $ProfilePic='image/'.$_FILES['profilepic']['name'];

    $username=mysqli_real_escape_string($conn,$username);
    $email=mysqli_real_escape_string($conn,$email);
    $ProfilePic=mysqli_real_escape_string($conn,$ProfilePic);

    if(preg_match("!image!", $_FILES['profilepic']['type'])){
      if(copy($_FILES['profilepic']['tmp_name'],$ProfilePic)){
        $_SESSION['username']=$username;
        $_SESSION['profilepic']=$ProfilePic;

        $sql="INSERT INTO user_table(Username,Email,UserPass,Picture)VALUES('$username','$email','$password','$ProfilePic')";

        if(mysqli_query($conn, $sql)){
          $_SESSION['message']="Registration Successful!";
          header("location:login.php");
        }
        else{
          $_SESSION['message']="Failed to Register the Account";
        }

      }
      else{
        $_SESSION['message']="Failed to Upload Image";
      }
    }
    else{
      $_SESSION['message']="please only upload JPG, PNG, OR GIF images!";
    }

  }

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Create Account - Hotel Booking</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f0f0f0;
      background-image: url('image/img_2.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
      display: flex;
      height: 100vh; /* Ensures the form container takes the full height of the viewport */
      margin: 0;
    }

    .form-container {
      width: 400px;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      border-radius: 20px;
    }

    .form-title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 20px;
    }

    .form-mainlogo {
      text-align: center;
      font-size: 32px;
    }

    .form-logo {
      text-align: center;
      font-size: 16px;
      margin-bottom: 20px;
    }

    .form-mainlogo a {
      text-decoration: none; /* Remove underline */
      color: black; /* Change the color to black */
    }

    .form-logo a {
      text-decoration: none; /* Remove underline */
      color: black; /* Change the color to black */
    }

    .form-picture {
      margin-bottom: 20px;
    }

    .form-picture label {
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: bold;
    }


    .form-group input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-group button:hover {
      background-color: #0056b8;
    }

    .form-footer {
      text-align: center;
      margin-top: 20px;
    }

    .form-footer a {
      color: #007bff;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <div class="form-mainlogo" href="index.php">
      <a href="index.php">HOTELINGO</a>
    </div>
    <div class="form-logo" href="index.php">
      <a href="index.php">Official Booking Website</a>
    </div>
    <div class="form-title">Create Account</div>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-picture">
        <label for="formFile" class="form-label">Input Profile Picture</label>
        <input class="form-control" type="file" id="formFile" name="profilepic">
      </div>
      <div class="form-group">
        <button type="submit">Register</button>
      </div>
    </form>
    <div class="form-footer">
      Already have an account? <a href="login.php">Login here</a>
    </div>
  </div>
</body>
</html>
