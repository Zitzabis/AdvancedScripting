<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Check if a user is logged in or has the correct permissions to view this page
    // If no, route them back to the site index
    session_start();
    if (isset($_SESSION['user_id']) || $_SESSION['teacher'] < 1) {
      header('Location: index.php');
    }

    require 'connect.inc.php'; //Connect to database

    // Retrieve username and password
    $username = $_GET['username'];
    $password = $_GET['password'];
    $password = hash('ripemd160', $password); // Hash password

    $count; // Init
    // Try and find a matching entry
    if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM user WHERE username=? and passwordHash=?")) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password); // Bind data

        mysqli_stmt_execute($stmt); // Execute

        mysqli_stmt_store_result($stmt); // Extract results

       $count = mysqli_stmt_num_rows($stmt); // Count results (there should only be 1)

        mysqli_stmt_close($stmt); // Close query
    }

    // There can only be 1 result
    if($count == 1) {
        if ($stmt = mysqli_prepare($mysqli, "SELECT id, teacher FROM user WHERE username=? and passwordHash=?")) {
            mysqli_stmt_bind_param($stmt, "ss", $username, $password); // Bind data

            mysqli_stmt_execute($stmt); // Execute

            mysqli_stmt_bind_result($stmt, $_SESSION['user_id'], $_SESSION['teacher']); // Pass data to session

            mysqli_stmt_fetch($stmt); // Fetch data

            mysqli_stmt_close($stmt); // Close query
        }
        $_SESSION['login_status'] = "success";
        header("location: ../index.php");
    }
    else {
        $_SESSION['login_status'] = "fail";
        //echo "Error submitting record: " . mysqli_error($mysqli);
        header("location: ../index.php");
    }
?>