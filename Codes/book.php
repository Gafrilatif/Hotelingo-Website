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
    <title>Hotelingo - Room and Pricing</title>
    <style>
      /* Your existing CSS styles here */
	body {
        background-image: url('image/lorong.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        
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
      background: linear-gradient(to right, #FF9810, #D74518, #1A77C8);
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

    .room-card {
      position: relative; /* Add relative positioning to allow absolute positioning for overlay and image */
      border: 1px solid #ccc;
      border-radius: 10px;
      padding: 20px;
      margin: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('path/to/your/image.jpg'); /* Add dark smoke overlay and image */
      background-size: cover; /* Adjust to your image size */
      background-position: center center; /* Center the background image */
    }

      .room-card:hover {
        transform: scale(1.05);
      }

      .room-name {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
      }

      .room-description {
        margin-bottom: 10px;
      }

      .room-price {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
      }

      .book-button {
        background-color: #0084ff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        text-decoration: none;
      }

      .book-button:hover {
        background-color: #0056b8;
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
      
      .centered-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
        width: 90%;
      }

          .room-selection {
        position: relative;
        text-align: center;
        margin-top: 50px; /* Adjust the spacing from the navigation bar */
        color: white; /* Set the text color to white */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4); /* Add a shadow around the text */
      }

      .room-selection-text {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
      }

      .room-selection-description {
        font-size: 18px;
        margin-bottom: 20px;
      }

    </style>
  </head>
  <body>
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
    <div class="background-overlay"></div>
    <div class="container">
      <div class="room-selection">
        <h2 class="room-selection-text">Choose Your Perfect Room</h2>
        <p class="room-selection-description">Experience utmost comfort and luxury with our variety of rooms tailored to meet your needs.</p>
        <h6 class="room-selection-description"> Available at 3 various room's : </h6>
        <div class="row">
      </div>
        <div class="row">
          <div class="col-md-4">
            <div class="room-card" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/regularroom.jpg');">
              <div class="room-name">Regular Room</div>
              <div class="room-description">A comfortable room with essential amenities and satisfying views.</div>
              <div class="room-price">$150 per night</div>
              <a class="book-button" href="RoomBooking1.php">Booking</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="room-card" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/eliteroom.jpg');">
              <div class="room-name">Elite Room</div>
              <div class="room-description">A luxurious room with extra amenities and stunning views.</div>
              <div class="room-price">$250 per night</div>
              <a class="book-button" href="RoomBooking2.php">Booking</a>
            </div>
          </div>
          <div class="col-md-4">
            <div class="room-card" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('image/suiteclass.jpg');">
              <div class="room-name">Suite Class</div>
              <div class="room-description">An exclusive suite with top-notch facilities and personalized service.</div>
              <div class="room-price">$500 per night</div>
              <a class="book-button" href="RoomBooking3.php">Booking</a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    </body>
  </html>
  