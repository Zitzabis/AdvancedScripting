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

    // Declare vars
    $quizTitle;
    $question = [];
    $options = [];
    $answer = [];
    $point = [];
    $author = $_SESSION['user_id']; // Check currently logged in author and user their ID

    $i = 0; // Counter
    // Loop through all GETs and assign their values to the correct variables
    foreach ($_GET as $key => $value) {
        echo "i = " . $i . "<br>";
        // Quiz title
        if ($i == 0) {
            $quizTitle = $value; // Quiz title
        }
        // Loop through passed vars and fill arrays
        if ($i > 0 && $i < 5) {
            if ($i == 1) {
                $question[] = $value; // Question
            }
            if ($i == 2) {
                $options[] = $value; // Options
            }
            if ($i == 3) {
                $answer[] = $value; // Answer
            }
            if ($i == 4) {
                $point[] = $value; // Points
                $i = 0; // Reset counter for next question iteration
            }
        }
        $i++; // Increment
    }

    // Insert form data into DB
    if ($stmt = mysqli_prepare($mysqli, 'INSERT INTO quiz (title, madeBy) VALUES (?, ?)')) { // Prepare the fields
        mysqli_stmt_bind_param($stmt, "si", $quizTitle, $author); // Bind the data into the query statement
        if(mysqli_stmt_execute($stmt)) { // Run query
            mysqli_stmt_close($stmt); // Close query
        }
        // If query fails
        else {
            mysqli_stmt_close($stmt); // Close query
            echo "Error submitting record: " . mysqli_error($mysqli); // Print error
        }  
    }
    
    // Fetch what the new quiz ID is
    $query = "SELECT id FROM quiz ORDER BY id DESC LIMIT 1";
    $query_run = mysqli_query($mysqli, $query);
    $query_array = mysqli_fetch_assoc($query_run);
    $quiz = $query_array['id'];

    // Loop through the question arrays and insert the data
    for ($x = 0; $x < count($question); $x++) {
        // Insert form data into DB
        if ($stmt = mysqli_prepare($mysqli, 'INSERT INTO question (quiz, question, options, points, answer) VALUES (?, ?, ?, ?, ?)')) { // Prepare the fields
            mysqli_stmt_bind_param($stmt, "issis", $quiz, $question[$x], $options[$x], $point[$x], $answer[$x]); // Bind the data into the query statement
            if(mysqli_stmt_execute($stmt)) { // Run query
                mysqli_stmt_close($stmt); // Close query
                header('Location: ../add_students_to_quiz.php?quiz=' . $quiz); // Route user
            }
            // If query fails
            else {
                mysqli_stmt_close($stmt); // Close query
                echo "Error submitting record: " . mysqli_error($mysqli); // Print error
            }  
        }
    }
?>