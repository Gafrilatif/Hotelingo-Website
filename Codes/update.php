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
    
    // Get the Book_ID from the form (assuming it's included as a hidden input field in the form)
    $bookID = $_POST['bookID'];

    // Check which table to update based on the Book_ID
    $tableToUpdate = ''; // Initialize an empty variable to store the table name

    if ($bookID >= 100 && $bookID <= 200) {
        $tableToUpdate = 'booking_table'; // Assuming Book_IDs 1 to 100 are in booking_table
    } elseif ($bookID >= 201 && $bookID <= 300) {
        $tableToUpdate = 'booking_table2'; // Assuming Book_IDs 101 to 200 are in booking_table2
    } elseif ($bookID >= 301) {
        $tableToUpdate = 'booking_table3'; // Assuming Book_IDs 201 to 300 are in booking_table3
    } else {
        // Invalid Book_ID, handle the error accordingly
        echo "Invalid Book_ID. Please try again.";
        exit;
    }

    // Prepare and execute the SQL query to update the booking data
    $stmt = $conn->prepare("UPDATE $tableToUpdate SET Date_Start=?, Date_End=? WHERE Book_ID=? AND User_ID=?");
    $stmt->bind_param("ssii", $startDate, $endDate, $bookID, $userID);
    $stmt->execute();

    // Check if the update was successful and handle accordingly (e.g., show success message, redirect, etc.)
    if ($stmt->affected_rows > 0) {
        // Redirect to a success page or wherever you want to take the user after updating the booking
        header('Location: YourBookedRoom.php');
        // exit;
    } else {
        // Redirect to the 'denied.php' page
        header("Location: denied.php");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.php");
        exit();
}
?>