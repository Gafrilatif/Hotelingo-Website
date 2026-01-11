<?php


session_start();
include 'connect.php';

// Check if the user is logged in (if User_ID is available in the session)
if (isset($_SESSION['User_ID'])) {
    // Get the User_ID from the session
    $userID = $_SESSION['User_ID'];

    // Get the start date and end date from the form
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    

    
    // Prepare and execute the SQL query to insert the booking data
    $stmt = $conn->prepare("INSERT INTO booking_table (User_ID, Date_Start, Date_End) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userID, $startDate, $endDate);
    $stmt->execute();

    // Check if the insertion was successful and handle accordingly (e.g., show success message, redirect, etc.)
    if ($stmt->affected_rows > 0) {
        // Redirect to a success page or wherever you want to take the user after booking
        header('Location: SuccessfullyBooked.php');
        // exit;
    } else {
        echo "Booking failed. Please try again.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "User not logged in. Please login first.";
}

?>