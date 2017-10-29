<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Check if a user is logged in or has the correct permissions to view this page
    // If no, route them back to the site index
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 1) {
      header('Location: index.php');
    }

    // Connect to DB
    include_once("connect.inc.php");

    $grade = 0;
    $totalPoints = 0;
    $quiz;
    $answers = [];
    $wrong = [];

    // Loop through all GETs and assign their values to the correct variables
    $i = 0;
    foreach ($_GET as $key => $value) {
        if ($i == 0) {
            $quiz = $value; // Row information
            $i++; // Increment
        }
        else {
            $answers[] = $value;
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

        if ($answers[$counter] == $answer) {
            $grade = $grade + $points;
        }
        else {
            $wrong[] = $questionID;
        }
        $totalPoints = $totalPoints + $points;
        $counter++;
    }

    $grade = ($grade / $totalPoints) * 100;

    $wrongString = "";
    foreach ($wrong as $value) {
        if ($wrongString == "")
            $wrongString = $value;
        else
            $wrongString = $wrongString . " " . $value;
    }
    
    // Delete val
    $completed = 1;

    // Update article data to be deleted
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