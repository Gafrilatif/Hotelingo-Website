<?php
// delete.php

session_start(); // Mulai sesi jika belum dimulai
include 'connect.php';

if (isset($_GET['Book_ID']) && is_numeric($_GET['Book_ID'])) {
    $Book_ID = $_GET['Book_ID'];

    // Check if the user is logged in and has the permission to delete this booking
    if (isset($_SESSION['User_ID'])) {
        $user_id = $_SESSION['User_ID'];

        // Query to check if the booking with the given Book_ID belongs to the logged-in user
        $query = "SELECT User_ID FROM booking_table WHERE Book_ID = $Book_ID UNION 
                  SELECT User_ID FROM booking_table2 WHERE Book_ID = $Book_ID UNION 
                  SELECT User_ID FROM booking_table3 WHERE Book_ID = $Book_ID";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $booking_user_id = $row['User_ID'];

            // Check if the logged-in user is the owner of the booking
            if ($user_id == $booking_user_id) {
                // Display a confirmation popup before deleting
                echo "
                <script>
                    if (confirm('Are you sure you want to delete this data?')) {
                        window.location.href = 'delete_process.php?Book_ID=$Book_ID';
                    } else {
                        window.location.href = 'YourBookedRoom.php'; // Redirect back to the table page if canceled
                    }
                </script>";
            } else {
                // Redirect to denied.php if the user is trying to delete other user's booking
                header("Location: denied.php");
                exit;
            }
        } else {
            echo "Error querying the database.";
        }
    } else {
        // Redirect to the login page if the user is not logged in
        header("Location: login.php");
        exit;
    }
}
?>


