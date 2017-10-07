<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Connect to DB
    include_once("connect.inc.php");

    $title = $_GET["title"]; // GET destination email
    $body = $_GET["body"]; // GET destination email
    $author = 1; // Manually set author ID for now (will change later when multiple users are available)

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