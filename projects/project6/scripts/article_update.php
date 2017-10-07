<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6
    
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