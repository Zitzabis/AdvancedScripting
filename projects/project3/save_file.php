<?php
    // Author:      Stephen Floyd
    // Date:        9/20/17
    // Assignment:  Project #3

    // Declare vars
    $row;
    $name = [];
    $grades = [];

    $i = 0; // Counter
    // Loop through all GETs and assign their values to the correct variables
    foreach ($_GET as $key => $value) {
        if ($i == 0) {
            $row = $value; // Row information
        }
        else if ($i == 1 || $i == 2) {
            $name[] = $value; // Name information
        }
        else {
            $grades[] = $value; // Grades
        }
        $i++; // Increment
    }

    $gradesPath = "Grades.txt"; // Path to the Grades.txt file

    // If this save has an updated entry
    if ($row != "null") {
        $lines = []; // Will hold all lines for later searching

        $gradesFile = fopen($gradesPath, "r") or die("Unable to open file!"); // Open file in read mode

        // Loop in the lines from the file
        while ($line = fgets($gradesFile)) {
          $lines[] = explode(" ", $line); // Sepperate the line into an array using " " as a delimiter
        }

        fclose($gradesFile); // Closes the TXT file

        $y = 0; // Counter
        $content = ""; // Init content for appending
        // Build the final output
        foreach ($lines as $e) {
            // If the updated row has been reached
            if ($y == $row) {
                $content .= $name[0] . " " . $name[1] . " "; // Add name to line
                // Loop through all grades and append them
                foreach ($grades as $v) {
                    $content .= $v . " ";
                }
                $content .= "-1\n"; // Add EOL
            }
            // All other rows
            else {
                $total = count($e); // Determine when to stop to cut off the EOL/EOF
                for ($c = 0; $c < $total - 1; $c++) {
                    $content .= $e[$c] . " "; // Append content
                }
                $content .= "-1\n"; // Add EOL
            }
            $y++; // Increment
        }

        // Change last EOL to an EOF
        $swap = "2";
        $content = substr($content, 0, -2).$swap;

        file_put_contents($gradesPath, $content); // Erase data and dump new data into file
    }
    // If this save has a new entry
    else {
        $current = file_get_contents($gradesPath); // Load entire file into one string
    
        // Change EOF to EOL
        $swap = "1\n";
        $current = substr($current, 0, -1).$swap;  
    
        $current .= $name[0] . " " . $name[1] . " "; // Append names to full file string
    
        // Append all grades
        foreach ($grades as $number) {
            $current .= $number . " ";
        }
    
        // Append EOL
        $current .= "-2";
    
        file_put_contents($gradesPath, $current); // Erase data and dump new data into file
    }

    header( 'Location: index.php' ); // Send user back to the index page
?>