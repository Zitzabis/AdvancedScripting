<?php
    include_once("connect.inc.php");

    $id = $_GET['id'];

    $restore = 0;

    /* create a prepared statement */
    if ($stmt = mysqli_prepare($mysqli, "UPDATE `article` SET `deleted`=? WHERE `article`.`articleID` = $id")) {

        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "i",  $restore);

        /* execute query */
        if(mysqli_stmt_execute($stmt)) {
            /* close statement */
            mysqli_stmt_close($stmt);
            header('Location: ../panel.php');
        }
        else {
            /* close statement */
            mysqli_stmt_close($stmt);
            echo "Error submitting record: " . mysqli_error($mysqli);
        }  
    }
?>