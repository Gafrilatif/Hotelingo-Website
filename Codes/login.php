<?php
session_start();

include 'connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $pass = validate($_POST['password']);

    if (empty($username)) {
        header("Location: login.php?error=User name is required");
        exit();
    } elseif (empty($pass)) {
        header("Location: login.php?error=Password is required");
        exit();
    } else {
        $sql = "SELECT * FROM user_table WHERE Username = '$username' AND UserPass = '$pass'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['Username'];
            $_SESSION['User_ID'] = $row['User_ID']; // Set the User_ID in the session
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect Password or Username");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login to Account - Hotel Booking</title>
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

    .error {
      background: #F2DEDE;
      color: #a94442;
      padding: 10px;
      width: 350px;
      margin: 20px auto;
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

    <div class="back-button" onclick="goBack()">
      <i class="fas fa-chevron-left"></i>
    </div>

  <div class="form-container">
    <div class="form-mainlogo" href="index.php">
      <a href="index.php">HOTELINGO</a>
    </div>
    <div class="form-logo" href="index.php">
      <a href="index.php">Official Booking Website</a>
    </div>
    <div class="form-title">Login Account</div>
    <form action="" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit">Login</button>
      </div>
    </form>
    <div class="form-footer">
      Don't have an account? <a href="regis.php">Register here</a>
    </div>
  </div>

  </script>
</body>
</html>