<?php
// delete_process.php

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
                // Perform the actual deletion
                $delete_query1 = mysqli_query($conn, "DELETE FROM booking_table WHERE Book_ID = $Book_ID");
                $delete_query2 = mysqli_query($conn, "DELETE FROM booking_table2 WHERE Book_ID = $Book_ID");
                $delete_query3 = mysqli_query($conn, "DELETE FROM booking_table3 WHERE Book_ID = $Book_ID");

                if ($delete_query1 && $delete_query2 && $delete_query3) {
                    // Redirect back to the table page after successful deletion
                    header("Location: YourBookedRoom.php");
                    exit;
                } else {
                    echo "Error deleting data.";
                }
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
