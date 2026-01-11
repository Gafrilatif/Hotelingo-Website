<?php
session_start();
$isLoggedIn = isset($_SESSION['User_ID']); // Check if the user is logged in

// Get the username from the session
$loggedInUsername = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Check if the user is logged in and get their username from the session
$loggedInUsername = '';
if ($isLoggedIn) {
    // Retrieve the username from the database based on the User_ID stored in the session
    // Modify the code based on how you store user information in the database
    $loggedInUserID = $_SESSION['User_ID'];

    // Database connection (Replace with your database credentials)
    include 'connect.php';

    // Prepare and execute a query to get the username
    $stmt = $conn->prepare("SELECT username FROM user_table WHERE User_ID = ?");
    $stmt->bind_param("i", $loggedInUserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $loggedInUsername = $row['username'];
    } else {
        // Handle the case where the user is logged in but not found in the database
        // You can handle this case based on your application's logic
        // For now, let's assume that the user is not logged in
        $isLoggedIn = false;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/bootstrap.min.css" rel="stylesheet"> 
  <script src="js/bootstrap.bundle.min.js"></script>
  <title>Hotelingo - Official Booking Website</title>
  <style>
    body {
      opacity: 0;
    }

    .fade-in-animation {
      animation: fadeIn 1s ease-in-out forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }

    .separator-line {
      height: 5px;
      width: 100%;
      background: linear-gradient(to right, #0068d7, #eb2e2e, #f6ff00);
      background-size: 200% 100%;
      animation: gradientAnimation 3s linear infinite;
    }

    @keyframes gradientAnimation {
      0%, 100% {
        background-position: 0 50%;
      }
      25% {
        background-position: 25% 50%;
      }
      50% {
        background-position: 50% 50%;
      }
      75% {
        background-position: 75% 50%;
      }
    }

    .background-container {
      position: relative;
    }

    .background-image {
      width: 100%;
      height: auto;
      opacity: 0.95;
    }

    .background-overlay {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.7);
    }

    .centered-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: white;
      width: 90%;
    }

    .login-button {
      position: absolute;
      top: 20px;
      right: 20px;
      padding: 10px 20px;
      background-color: #0084ff;
      color: white;
      border: none;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }

    .login-button:hover {
      background-color: #0056b8;
    }

    .logout-button {
      position: absolute;
      top: 60px;
      right: 150px;
      padding: 10px 20px;
      background-color: #0084ff;
      color: white;
      border: none;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      cursor: pointer;
    }

    .logout-button:hover {
      background-color: #0056b8;
    }

    .book-button {
      position: absolute;
      bottom: 80px;
      left: 50%;
      transform: translateX(-50%);
      padding: 12px 24px;
      background-color: #0084ff;
      color: white;
      border: none;
      border-radius: 50px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      cursor: pointer;
      overflow: hidden;
      text-decoration: none; /* Remove underline */
    }


    .book-button::before {
      content: "";
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 0;
      height: 0;
      background-color: rgba(255, 255, 255, 0.7);
      border-radius: 50%;
      opacity: 0;
      transition: width 0.4s ease, height 0.4s ease, opacity 0.4s ease;
    }

    .book-button:hover::before {
      width: 200px;
      height: 200px;
      opacity: 1;
    }

    .book-button span {
      position: relative;
      z-index: 1;
    }

    .nav-item.dropdown:hover .dropdown-menu {
      opacity: 1;
      visibility: visible;
      transition: opacity 0.3s ease-in-out;
    }

    .dropdown-menu {
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease-in-out;
    }

    .nav-link {
      transition: color 0.3s ease-in-out;
    }

    .nav-item:hover .nav-link {
      color: #0084ff;
    }
  </style>
</head>
<body class="fade-in-animation">
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(218, 217, 207);">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <h2>Hotelingo</h2> 
        <h5>Official Booking Website</h5>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profiles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="book.php">Room & Pricing</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Services
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="YourBookedRoom.php">Your Booked Room</a></li>
              <li><a class="dropdown-item" href="Contacts.php">Contacts</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <div style="display: flex; align-items: center; margin-left: auto;">
    <?php if ($isLoggedIn) { ?>
        <div style="display: flex; flex-direction: column; align-items: center; margin-right: 10px;">
            <?php
            include 'connect.php';
            // Retrieve the profile picture URL from the database based on the User_ID
            $profilePictureURL = ''; // Initialize the profile picture URL
            $stmt = $conn->prepare("SELECT Picture FROM user_table WHERE User_ID = ?");
            $stmt->bind_param("i", $loggedInUserID);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $profilePictureURL = $row['Picture'];
            }

            $stmt->close();
            $conn->close();

            // Display the profile picture if it exists
            if (!empty($profilePictureURL)) {
                echo '<img src="' . $profilePictureURL . '" alt="Profile Picture" style="width: 70px; height: 70px; border-radius: 50%; margin-bottom: 5px;">';
            }
            ?>
            <span class="navbar-text" style="text-align: center;"><strong>Hello, <?php echo $loggedInUsername; ?></strong></span>
            <a href="logout.php" class="logout-button">Logout</a>
        </div>
    <?php } else { ?>
        <a href="login.php" class="login-button">Login</a>
    <?php } ?>
</div>
  </nav>
  <div class="separator-line"></div>
  <div class="background-container">
    <img src="image/lambohotel.jpg" class="background-image" alt="...">
    <div class="background-overlay"></div>
    <div class="centered-text">
      <h1>THANK YOU FOR YOUR RESERVATION</h1>
      <h6>- - - - - - - </h6>
      <br>
      <br>
      <h5> kelompok 4 Successfull order.</h5>
    </div>
    <a href="index.php" class="book-button">
      <span>Go Back to " Home " page</span>
    </a>
  </div>
</body>
</html>