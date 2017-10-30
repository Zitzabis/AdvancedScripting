<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Check if a user is logged in or has the correct permissions to view this page
    // If no, route them back to the site index
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 0) {
      header('Location: index.php');
    }

    // Connect to DB
    include_once("connect.inc.php");

    $quiz;
    $students = [];
    // Loop through all GETs and assign their values to the correct variables
    $i = 0;
    foreach ($_GET as $key => $value) {
        if ($i == 0) {
            $quiz = $value; // Row information
            $i++; // Increment
        }
        else {
            $students[] = $key;
        }
    }

    for ($x = 0; $x < count($students); $x++) {
        // Insert form data into DB
        if ($stmt = mysqli_prepare($mysqli, 'INSERT INTO user_has_quiz (userID, quizID) VALUES (?, ?)')) { // Prepare the fields
            mysqli_stmt_bind_param($stmt, "ii", $students[$x], $quiz); // Bind the data into the query statement
            if(mysqli_stmt_execute($stmt)) { // Run query
                mysqli_stmt_close($stmt); // Close query
                header('Location: ../index.php'); // Route user
            }
            // If query fails
            else {
                mysqli_stmt_close($stmt); // Close query
                echo "Error submitting record: " . $mysqli->error; // Print error
            }  
        }
    }
?>