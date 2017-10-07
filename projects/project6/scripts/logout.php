<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

    // Destroy all login details and direct them to home
    session_start();
    session_destroy();
    header("Location: ../index.php")
?>