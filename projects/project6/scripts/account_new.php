<?php
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
    $permission = 1;

    /* create a prepared statement */
    if ($stmt = mysqli_prepare($mysqli, "INSERT INTO `user` (`username`, `passwordHash`, `permission`) VALUES (?, ?, ?)")) {
        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "ssi", $username, hash('ripemd160', $password), $permission);

        /* execute query */
        if(mysqli_stmt_execute($stmt)) {
            /* close statement */
            mysqli_stmt_close($stmt);
            header('Location: ../index.php');
        }
        else {
            /* close statement */
            mysqli_stmt_close($stmt);
            echo "Error submitting record: " . mysqli_error($mysqli);
        }  
    }
?>