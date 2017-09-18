<?php
    session_start();
    $email = $_GET["email"];
    $message = "FirstName | LastName | AverageGrade\n----------\n";

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
        $grades = number_format((float)($grades / $i - 2), 2, '.', '');

        $message = $message . $name[0] . "  -  " . $name[1] . "  -  " . $grades . "\n";
    }
    fclose($gradesFile); // Closes the TXT file

    $to      = $email;
    $subject = 'Grades';
    $headers = 'From: webmaster@zitzasoft.com' . "\r\n" .
        'Reply-To: webmaster@zitzasoft.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    try {
        mail($to, $subject, $message, $headers);

        $_SESSION["emailsent"] = "success";
    }
    catch (Exception $e) {
        $_SESSION["emailsent"] = "fail";
    }

    header( 'Location: index.php' ) ;
?>