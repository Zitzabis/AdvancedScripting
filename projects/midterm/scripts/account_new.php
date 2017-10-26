<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // All content here is used to help me generate hashed passwords for accounts. Under normal site circumstances, I would build an interface to work with this script, but I'm lazy.
    // As this file is not part of the assignment, there is no documentation beyond this.

    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['permission'] < 1) {
      header('Location: index.php');
    }

    if (!isset($_SESSION['user_id'])) {
        //header('Location: ../login.php');
    }

    else if ($_SESSION['rank'] < 3) {
        //header('Location: panel.php');
    }

    require 'connect.inc.php'; //Connect to database

    $username = $_GET["username"];
    $password = $_GET["password"];
    $teacher = 0;

    /* create a prepared statement */
    if ($stmt = mysqli_prepare($mysqli, "INSERT INTO `user` (`username`, `passwordHash`, `teacher`) VALUES (?, ?, ?)")) {
        mysqli_stmt_bind_param($stmt, "ssi", $username, hash('ripemd160', $password), $teacher);

        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            header('Location: ../index.php');
        }
        else {
            mysqli_stmt_close($stmt);
            echo "Error submitting record: " . mysqli_error($mysqli);
        }  
    }
?>