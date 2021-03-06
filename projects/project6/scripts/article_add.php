<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Check if a user is logged in or has the correct permissions to view this page
    // If no, route them back to the site index
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['permission'] < 1) {
      header('Location: index.php');
    }

    // Connect to DB
    include_once("connect.inc.php");

    $title = $_GET["title"]; // GET destination email
    $body = $_GET["body"]; // GET destination email
    $author = $_SESSION['user_id']; // Check currently logged in author and user their ID

    // Insert form data into DB
    if ($stmt = mysqli_prepare($mysqli, 'INSERT INTO article (title, body, author) VALUES (?, ?, ?)')) { // Prepare the fields
        mysqli_stmt_bind_param($stmt, "ssi", $title, $body, $author); // Bind the data into the query statement
        if(mysqli_stmt_execute($stmt)) { // Run query
            mysqli_stmt_close($stmt); // Close query
            header('Location: ../index.php'); // Redirect user
        }
        // If query fails
        else {
            mysqli_stmt_close($stmt); // Closer query
            echo "Error submitting record: " . mysqli_error($mysqli); // Print error
        }  
    }
?>