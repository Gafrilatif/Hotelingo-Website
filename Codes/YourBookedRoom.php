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
        opacity: 0.1; /* Adjust the opacity value (0.0 to 1.0) */
      }

      .background-overlay {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7); /* Adjust the opacity value (0.0 to 1.0) and color as needed */
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
    <figure>
        <blockquote class="blockquote">
          <h1 class="mt-4"> Services - Your Booked Room </h1>
        </blockquote>
        <figcaption class="blockquote-footer">
          <h3>Room Database</h3>
          <h6 title="Source Title">Contain customer's occupied hotel room</h6>
          <cite title="Source Title"> * 110/11~ (Reguler Room/ID) * 210/21~ (Elite Room/ID) * 310/31~ (Suite Class/ID)</cite>
        </figcaption>
      </figure>
      <br>
          <div class="container">
    <figure>
        <!-- ... (previous code) ... -->
    </figure>
    <div class="table-responsive">
        <table class="table align-middle table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Room_ID</th>
                    <th>Book_ID</th>
                    <th>User_AccountID</th>
                    <th>Check in</th>
                    <th>Check out</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "connect.php";
                $no = 1;

                // Combine data from three tables and sort by check-in date
                $combinedData = array();

                $query1 = mysqli_query($conn, "SELECT * FROM booking_table WHERE User_ID = '$loggedInUserID'");
                while ($tampil = mysqli_fetch_array($query1)) {
                    $combinedData[] = $tampil;
                }

                $query2 = mysqli_query($conn, "SELECT * FROM booking_table2 WHERE User_ID = '$loggedInUserID'");
                while ($tampil = mysqli_fetch_array($query2)) {
                    $combinedData[] = $tampil;
                }

                $query3 = mysqli_query($conn, "SELECT * FROM booking_table3 WHERE User_ID = '$loggedInUserID' ");
                while ($tampil = mysqli_fetch_array($query3)) {
                    $combinedData[] = $tampil;
                }

                // Sort the combined data by check-in date
                usort($combinedData, function ($a, $b) {
                    return strtotime($a['Date_Start']) - strtotime($b['Date_Start']);
                });

                // Display the sorted data in the table
                foreach ($combinedData as $tampil) {
                    echo "
                    <tr>
                        <td>$no</td>
                        <td>$tampil[Room_ID]</td>
                        <td>$tampil[Book_ID]</td>
                        <td>$tampil[User_ID]</td>
                        <td>$tampil[Date_Start]</td>
                        <td>$tampil[Date_End]</td>
                        <td>
                            <a href='edit.php?Book_ID=$tampil[Book_ID]' class='btn btn-success'>Edit</a>
                            <button class='btn btn-danger' onclick='confirmDelete($tampil[Book_ID])'>Delete</button>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function confirmDelete(bookID) {
        if (confirm("Are you sure you want to delete this booking?")) {
            window.location.href = "delete.php?Book_ID=" + bookID;
        }
    }
</script>

        </thead>
          </tbody>
          </table>
          </div>
        </div>
    </body>
  </body>
</html>
      