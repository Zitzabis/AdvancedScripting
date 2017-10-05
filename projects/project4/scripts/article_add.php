<?php
    include_once("connect.inc.php");

    $title = $_GET["title"]; // GET destination email
    $body = $_GET["body"]; // GET destination email
    $author = 1;

    if ($stmt = mysqli_prepare($mysqli, 'INSERT INTO article (title, body, author) VALUES (?, ?, ?)')) {
        mysqli_stmt_bind_param($stmt, "ssi", $title, $body, $author);
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