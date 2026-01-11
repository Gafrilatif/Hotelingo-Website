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
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Room 1</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <script src="js/bootstrap.bundle.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Luxurious+Script&display=swap" rel="stylesheet">
        <style>
            
            body{
                background-color: #ccc;
            }

            <script>
                const images = [
                    'image/hotelwhite.jpeg',
                    'image/hotel1.jpeg',
                    'image/hotel2.jpg',
                    'image/img_2.jpg',
                ];

                const preloadImages = () => {
                    images.forEach((image) => {
                        const img = new Image();
                        img.src = image;
                    });
                };
                preloadImages();
            </script>

            .fade-in-animation {
                animation: fadeIn 1s ease-in-out forwards;
            }

            @keyframes fadeIn {
                to {
                    opacity: 1;
                }
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

            .profile-container {
                position: absolute;
                max-width: 600px;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                border-radius: 20px;
                top: 35%;
                left: 60%;
            }

            .separator-line {
                height: 5px;
                width: 100%;
                background: linear-gradient(to right, #0068d7, #eb2e2e, #f6ff00);
                background-size: 200% 100%;
                animation: gradientAnimation 3s linear infinite;
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
                position: relative;
                top: 20px;
            }

            .form-group button:hover {
                background-color: #0056b8;
            }

            .figure-image-container {
                position: absolute;
                left: 12%;
                top: 59%;
                transform: translateY(-50%);
                width: 650px; /* Adjust the width and height as needed */
                height: 550px;
                overflow: hidden;
                border-radius: 20px;
                border: 10px solid silver;
            }


            .figure-image {
                position: relative;
                width: 650px; /* Adjust the width as needed */
                height: 650px; /* Adjust the height as needed */
                border-radius: 20px;
                overflow: hidden;
                transition: opacity 2s ease-in-out; /* Add CSS transition for smooth image fade-in/fade-out */
            }

            .figure-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                opacity: 0; /* Initially hide the image */
                transition: opacity 0.9s ease-in-out; /* Add CSS transition for smooth image fade-in/fade-out */
            }

            .carousel-button {
                position: absolute;
                bottom: 20px;
                left: 50%;
                transform: translateX(-50%);
                padding: 10px;
                background-color: transparent;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            .room-title {
                font-family: 'Luxurious Script' , serif; 
                position: absolute ;
                top: 170px;
                left: 420px;
                text-decoration: none;
                color: black;
            }

            .room-title:hover {
                color: black; /* Set the color to the same value as the default color */
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
        <div>
            <a class="room-title">
                <h2 style="font-size: 64px;">Regular Room</h2>
            </a>
        </div>
        

        <section class="profile-container">
                <h2 class="py-2"> Enter The Date of Your Stay </h2>
                <form class="row" action="BookProcess1.php" method="POST">
                    <label for="startDate">Start</label>
                    <input id="startDate" class="form-control" type="date" name="startDate"  />
                    <label for="endDate">End</label>
                    <input id="endDate" class="form-control" type="date" name="endDate"  />
                    <div class="form-group">
                        <button type="submit">Book</button>
                    </div>
                </form>
        </section>
        <div class="figure-image-container" id="imageCarousel">
            <div class="figure-image">
                <img src="image/hotelwhite.jpeg" alt="Hotel Image" id="carouselImage">
            </div>
            <!-- Call handleButtonClicked() directly when the button is clicked -->
            <button class="carousel-button" id="carouselButton" onclick="handleButtonClicked()">Next Picture</button>
        </div>

        <script>
            const images = [
                'image/reg1.png',
                'image/reg2.png',
                'image/reg3.png',
            ];

            let currentImageIndex = 0;
            const carouselImage = document.getElementById('carouselImage');
            const carouselButton = document.getElementById('carouselButton');
            let interval; // To store the interval ID
            let isTransitioning = false;

            function fadeInImage() {
                carouselImage.style.opacity = '1';
                isTransitioning = false;
            }

            function fadeOutImage() {
                carouselImage.style.opacity = '0';
                isTransitioning = true;
            }

            function cycleImages() {
                fadeOutImage(); // Fade out the current image
                setTimeout(function () {
                    currentImageIndex = (currentImageIndex + 1) % images.length;
                    carouselImage.src = images[currentImageIndex];
                    fadeInImage(); // Fade in the new image after it's set as the source
                }, 500); // Add a delay to match the CSS transition time (0.5s)
            }

            function startAutomaticCarousel() {
                interval = setInterval(function () {
                    if (!isTransitioning) {
                        cycleImages();
                    }
                }, 3000); // Change the interval (in milliseconds) as needed
            }

            function stopAutomaticCarousel() {
                clearInterval(interval);
            }

            // Start the automatic carousel rotation when the page loads
            startAutomaticCarousel();

            // Add click event listener to the carousel container for manual cycling
            document.getElementById('imageCarousel').addEventListener('click', function () {
                if (!isTransitioning) {
                    cycleImages(); // Manually cycle the images when the user clicks
                    stopAutomaticCarousel(); // Stop the automatic carousel rotation
                    setTimeout(startAutomaticCarousel, 5000); // Restart automatic rotation after 5 seconds
                }
            });

            function handleButtonClicked() {
                if (!isTransitioning) {
                    cycleImages(); // Manually cycle the images when the user clicks the button
                    stopAutomaticCarousel(); // Stop the automatic carousel rotation
                    setTimeout(function () {
                        fadeInImage(); // Make sure the image is fully faded in after the transition is complete
                        startAutomaticCarousel(); // Restart automatic rotation after 5 seconds
                    }, 500); // Adjust the delay based on your CSS transition duration
                }
            }

            // Add click event listener to the "Next Picture" button for manual cycling
            carouselButton.addEventListener('click', function (event) {
                event.stopPropagation(); // Prevent the container click event from triggering
                handleButtonClicked(); // Handle the button click
            });
        </script>
    </body>
</html>