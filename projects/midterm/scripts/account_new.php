<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm

    // Deny access
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 0) {
      header('Location: index.php');
    }

    require 'connect.inc.php'; //Connect to database

    // Fetch vars
    $username = $_GET["username"];
    $password = $_GET["password"];
    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
    $email = $_GET["email"];
    $role = $_GET["role"];
    if ($role == "Teacher")
        $teacher = 1;
    else
        $teacher = 0;

    /* create a prepared statement */
    if ($stmt = mysqli_prepare($mysqli, "INSERT INTO `user` (`username`, `passwordHash`, `firstName`, `lastName`, `email`, `teacher`) VALUES (?, ?, ?, ?, ?, ?)")) {
        mysqli_stmt_bind_param($stmt, "sssssi", $username, hash('ripemd160', $password), $firstName, $lastName, $email, $teacher);

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header('Location: ../index.php');
        }
        else {
            echo "Error submitting record: " . mysqli_error($mysqli);
            mysqli_stmt_close($stmt);
        }  
    }
?>