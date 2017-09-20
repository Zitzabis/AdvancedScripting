<?php
    // Author:      Stephen Floyd
    // Date:        9/20/17
    // Assignment:  Project #3

    session_start(); // Start session
    $email = $_GET["email"]; // GET destination email
    $message = "LastName | FirstName | AverageGrade\n----------\n"; // Message body headers and content

    $gradesPath = "Grades.txt"; // Path to the Grades.txt file
    $gradesFile = fopen($gradesPath, 'r'); // Open file in read only mode

    // Loop in the lines from the file
    while ($line = fgets($gradesFile)) {
        $line = explode(" ", $line); // Seperate the line into an array using " " as a delimiter
        $i = 0; // Counter
        $name = []; // Init empty array
        $grades = 0; // Init and reset grades value
        
        // Loop through the line's array
        foreach ($line as $entry) {
            // Only catch for non EOL and EOF values
            if ($entry != -1 && $entry != -2) {
            // Catch first and last name
            if ($i < 2) {
                $name[] = $entry; // Store the names into the empty array (PHP auto pushes to the correct index)
            }
            // All other values
            else {
                $grades += $entry; // Adds up the grades
            }
            }
            $i++; // Increment counter
        }
        // Calculate and formate the average
        $grades = number_format((float)($grades / ($i - 3)), 2, '.', '');

        $message = $message . $name[1] . "  -  " . $name[0] . "  -  " . $grades . "\n"; // Construct message
    }
    fclose($gradesFile); // Closes the TXT file

    // Build email data
    $to      = $email;
    $subject = 'Grades';
    $headers = 'From: webmaster@zitzasoft.com' . "\r\n" .
        'Reply-To: webmaster@zitzasoft.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    try {
        mail($to, $subject, $message, $headers); // Send email

        $_SESSION["emailsent"] = "success"; // Set emailsent session variable
    }
    catch (Exception $e) {
        $_SESSION["emailsent"] = "fail"; // Set emailsent session variable
    }

    header( 'Location: index.php' ); // Send user back to the previous page
?>