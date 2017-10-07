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

    // GET article information
    $id = $_GET['id'];
    $title = $_GET['title'];
    $body = $_GET['body'];

    // Update article title, body and edit date
    if ($stmt = mysqli_prepare($mysqli, "UPDATE `article` SET `title`=?, `body`=?, `date`=(now()) WHERE `article`.`articleID` = $id")) {
        mysqli_stmt_bind_param($stmt, "ss",  $title, $body); // Bind data to query

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Close query
            header('Location: ../panel.php'); // Route user
        }
        else {
            mysqli_stmt_close($stmt); // Close query
            echo "Error submitting record: " . mysqli_error($mysqli); // Print error
        }  
    }
?>