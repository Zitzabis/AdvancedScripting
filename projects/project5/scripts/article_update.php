<?php
    include_once("connect.inc.php");

    $id = $_GET['id'];
    $title = $_GET['title'];
    $body = $_GET['body'];

    /* create a prepared statement */
    if ($stmt = mysqli_prepare($mysqli, "UPDATE `article` SET `title`=?, `body`=?, `date`=(now()) WHERE `article`.`articleID` = $id")) {

        /* bind parameters for markers */
        mysqli_stmt_bind_param($stmt, "ss",  $title, $body);

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