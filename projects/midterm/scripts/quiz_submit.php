<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm

    // Check if a user is logged in or has the correct permissions to view this page
    // If no, route them back to the site index
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 1) {
      header('Location: index.php');
    }

    // Connect to DB
    include_once("connect.inc.php");

    // Declare vars
    $grade = 0;
    $totalPoints = 0;
    $quiz;
    $answers = [];
    $wrong = [];

    // Loop through all GETs and assign their values to the correct variables
    $i = 0;
    foreach ($_GET as $key => $value) {
        if ($i == 0) {
            $quiz = $value; // Quiz ID
            $i++; // Increment
        }
        else {
            $answers[] = trim($value); // Fix any trailing whitepsace
        }
    }

    // Build query and run it
    $query = 'SELECT questionID, points, answer FROM question WHERE quiz=' . $quiz;
    $query_run = mysqli_query($mysqli, $query); 
    
    // Tick through all results from the query
    $counter = 0;
    while ($query_array = mysqli_fetch_assoc($query_run)) {
        // Fetch columns and store into vars
        $questionID = $query_array['questionID'];
        $points = $query_array['points'];
        $answer = $query_array['answer'];

        // Check if the submitted answer meets the correct answer
        if ($answers[$counter] == trim($answer)) {
            $grade = $grade + $points; // Add question points to user's points
        }
        else {
            $wrong[] = $questionID; // Mark the question as being wrong
        }
        $totalPoints = $totalPoints + $points; // Add question points to total points possible
        $counter++; // Increment
    }

    $grade = ($grade / $totalPoints) * 100; // Calculate final grade

    $wrongString = ""; // Declare var
    // Tick through all wrong values
    foreach ($wrong as $value) {
        if ($wrongString == "")
            $wrongString = $value; // Start string
        else
            $wrongString = $wrongString . " " . $value; // Record all questions the user got wrong in a string
    }
    
    // Completed val
    $completed = 1;

    // Update user's quiz record to be completed, with the final score, and what questionst they got wrong
    if ($stmt = mysqli_prepare($mysqli, "UPDATE user_has_quiz SET completed=?, score=?, wrong=? WHERE quizID=" . $quiz . " AND userID=" . $_SESSION['user_id'])) {
        mysqli_stmt_bind_param($stmt, "iis", $completed, $grade, $wrongString); // Bind data to query

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt); // Close query
            header('Location: ../review_quiz.php?id=' . $quiz); // Route user
        }
        else {
            mysqli_stmt_close($stmt); // Close query
            echo "Error submitting record: " . mysqli_error($mysqli); // Print error
        }  
    }
?>