<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm

    // Check if a user is logged in or has the correct permissions to view this page
    // If no, route them back to the site index
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 0) {
      header('Location: index.php');
    }
    
    // Connect to DB
    include_once("connect.inc.php");

    // Get vars
    $user = $_GET['user'];
    $password = $_GET['password'];

    // Update user with new hashed password
    if ($stmt = mysqli_prepare($mysqli, "UPDATE user SET passwordHash=? WHERE id=?")) {
        mysqli_stmt_bind_param($stmt, "si", hash('ripemd160', $password), $user); // Bind data to query

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Close query
            header('Location: ../index.php'); // Route user
        }
        else {
            mysqli_stmt_close($stmt); // Close query
            echo "Error submitting record: " . mysqli_error($mysqli); // Print error
        }  
    }
?>