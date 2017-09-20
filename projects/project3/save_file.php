<?php
    $row;
    $name = [];
    $grades = [];

    $i = 0;
    foreach ($_GET as $key => $value) {
        if ($i == 0) {
            $row = $value;
        }
        else if ($i == 1 || $i == 2) {
            $name[] = $value;
        }
        else {
            $grades[] = $value;
        }
        $i++;
    }

    $gradesPath = "Grades.txt"; // Path to the Grades.txt file
    if ($row != "null") {
        $lines = [];

        $gradesFile = fopen($gradesPath, "r") or die("Unable to open file!"); // Open file in read mode

        // Loop in the lines from the file
        while ($line = fgets($gradesFile)) {
          $lines[] = explode(" ", $line); // Sepperate the line into an array using " " as a delimiter
        }

        fclose($gradesFile); // Closes the TXT file

        $y = 0;
        $content = "";
        foreach ($lines as $e) {
            if ($y == $row) {
                $content .= $name[0] . " " . $name[1] . " ";
                foreach ($grades as $v) {
                    $content .= $v . " ";
                }
                $content .= "-1\n";
            }
            else {
                $total = count($e);
                for ($c = 0; $c < $total - 1; $c++) {
                    $content .= $e[$c] . " ";
                }
                $content .= "-1\n";
            }
            $y++;
        }

        $swap = "2";
        $content = substr($content, 0, -2).$swap;

        file_put_contents($gradesPath, $content);
    }
    else {
        $current = file_get_contents($gradesPath);
    
        $swap = "1\n";
        $current = substr($current, 0, -1).$swap;  
    
        $current .= $name[0] . " " . $name[1] . " ";
    
        foreach ($grades as $number) {
            $current .= $number . " ";
        }
    
        $current .= "-2";
    
        file_put_contents($gradesPath, $current);
    }

    header( 'Location: index.php' ); // Send user back to the previous page
?>