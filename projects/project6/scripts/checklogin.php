<?php
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['permission'] < 1) {
      header('Location: index.php');
    }

    require 'connect.inc.php'; //Connect to database

    //Retrieve username and password
    $username = $_GET['username'];
    $password = $_GET['password'];
    $password = hash('ripemd160', $password); //Hash password

    $count;
    //Try and find a matching entry
    if ($stmt = mysqli_prepare($mysqli, "SELECT * FROM user WHERE username=? and passwordHash=?")) {
        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

        /* execute query */
        mysqli_stmt_execute($stmt);

        /* store result */
        mysqli_stmt_store_result($stmt);

       $count = mysqli_stmt_num_rows($stmt);

        /* close statement */
        mysqli_stmt_close($stmt);
    }

    // If result matched $myusername and $mypassword, table row must be 1 row
    if($count == 1) {
        if ($stmt = mysqli_prepare($mysqli, "SELECT id, permission FROM user WHERE username=? and passwordHash=?")) {
            /* bind parameters for markers */
            mysqli_stmt_bind_param($stmt, "ss", $username, $password);

            /* execute query */
            mysqli_stmt_execute($stmt);

            /* bind result variables */
            mysqli_stmt_bind_result($stmt, $_SESSION['user_id'], $_SESSION['permission']);

            /* fetch value */
            mysqli_stmt_fetch($stmt);

            /* close statement */
            mysqli_stmt_close($stmt);
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