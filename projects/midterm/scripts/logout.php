<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm

    // Destroy all login details and direct them to home
    session_start();
    session_destroy();
    header("Location: ../index.php")
?>