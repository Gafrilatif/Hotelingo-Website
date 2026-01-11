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
    <title>Hotelingo - 5 Star Luxury Hotel</title>
    <style>
      body {
        background-image: url('image/lobbyhotel2.jpg');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: 100% 100%;
        
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

      /* Smooth fade-in animation for dropdown menu */
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

      /* Text animation on hover */
      .nav-link {
        transition: color 0.3s ease-in-out;
      }

      .nav-item:hover .nav-link {
        color: #0084ff;
      }
      .hotel-profile {
      text-align: center;
      padding: 20px;
    }

      .hotel-name {
        font-size: 56px;
        font-weight: bold;
        margin-bottom: 20px;
        color: gold
      }

      .hotel-info {
        font-size: 22px;
        margin-bottom: 50px;
        color: white;
      }

      .hotel-description {
        font-size: 18px;
        line-height: 2.0;
        margin-bottom: 50px;
        color: white;

      }

      .team-photos {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        max-width: 800px;
        margin: 0 auto;
        margin-top: 50px;
      }

      .team-member {
        text-align: center;
        margin: 20px;
      }

      .team-member img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: box-shadow 0.3s ease-in-out;
      }

      .team-member img:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
      }

      .member-name {
        font-size: 24px;
        font-weight: bold;
        margin-top: 10px;
        color: white;
      }

      .member-info {
        font-size: 16px;
        margin-top: 5px;
        color: goldenrod;
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
    <div class="container">
      <div class="hotel-profile">
        <div class="hotel-name">Hotelingo by K4</div>
        <div class="hotel-info">Project Established in 2023</div>
        <div class="hotel-description">
          Welcome to Hotelingo, your 5-star luxury escape in the heart of the city. Our hotel was founded in 2023 with a passion for providing the utmost comfort, elegance, and convenience to our esteemed guests.
          Your satisfaction is our utmost priority, and we are committed to creating lasting memories for you.
          <h1><--------------------------------------></h1>
          <h5>Sincerely,The Hotelingo Team<h5>
          <h5>Project Team 4 :<h5>
          <h5>Gafrilatif Aviandi Putra Adnanta & Muhamad Farhan Budiana<h5>
        </div>
        <div class="team-photos">
    <div class="team-member">
      <img src="image/gapri.jpeg" alt="Team Member 1">
      <div class="member-name">Gafrilatif Aviandi Putra Adnanta </div>
      <div class="member-info">Team 4 Web Project</div>
    </div>
    <div class="team-member">
      <img src="image/farhanbud.jpg" alt="Team Member 2">
      <div class="member-name">Muhamad Farhan Budiana</div>
      <div class="member-info">Team 4 Web Project</div>
    </div>
      </div>
    </div>
  </div>

</body>
</html>
      