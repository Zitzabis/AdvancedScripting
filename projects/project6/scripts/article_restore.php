<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Connect to DB
    include_once("connect.inc.php");

    // GET which article will be restored
    $id = $_GET['id'];
]
    // Delete val
    $restore = 0;

    // Update article data to be restored
    if ($stmt = mysqli_prepare($mysqli, "UPDATE `article` SET `deleted`=? WHERE `article`.`articleID` = $id")) {
        mysqli_stmt_bind_param($stmt, "i",  $restore); // Bind data to query

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