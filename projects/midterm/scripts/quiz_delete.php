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

    // GET which quiz will be deleted
    $id = $_GET['id'];

    // Delete val
    $delete = 1;

    // Update quiz data to be deleted
    if ($stmt = mysqli_prepare($mysqli, "UPDATE quiz SET deleted=? WHERE id = $id")) {
        mysqli_stmt_bind_param($stmt, "i",  $delete); // Bind data to query

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