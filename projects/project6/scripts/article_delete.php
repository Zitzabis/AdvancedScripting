<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #5
    
    // Connect to DB
    include_once("connect.inc.php");

    // GET which article will be deleted
    $id = $_GET['id'];

    // Delete val
    $delete = 1;

    // Update article data to be deleted
    if ($stmt = mysqli_prepare($mysqli, "UPDATE `article` SET `deleted`=? WHERE `article`.`articleID` = $id")) {
        mysqli_stmt_bind_param($stmt, "i",  $delete); // Bind data to query

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