<?php
  // Author:      Stephen Floyd
  // Date:        9/17/17
  // Assignment:  Project #2

  session_start(); // Start session
  // Check if session variable has been set
  if(!isset($_SESSION['emailsent'])) {
    $_SESSION["emailsent"] = null; // Set it to null
  }
  include("../../php/html_head.php");
  $gradesPath = "Grades.txt"; // Path to the Grades.txt file
  $gradesFile = fopen($gradesPath, 'r'); // Open file in read only mode

  $row = $_GET["row"];

  if ($row != "null") {
    $gradesPath = "Grades.txt"; // Path to the Grades.txt file
    $gradesFile = fopen($gradesPath, 'r'); // Open file in read only mode

    // Loop in the lines from the file
    $x = 0;
    while ($line = fgets($gradesFile)) {
        if ($x == $row) {
            $line = explode(" ", $line); // Seperate the line into an array using " " as a delimiter
            $i = 0; // Counter
            $name = []; // Init empty array
            $grades = []; // Init empty array
            
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
                    $grades[] = $entry; // Stores grades
                }
                }
                $i++; // Increment counter
            }
        }
        $x++;
    }
    fclose($gradesFile); // Closes the TXT file
    $firstName = $name[0];
    $lastName = $name[1];
  }
  else {
    $firstName = $_GET["firstName"];
    $lastName = $_GET["lastName"];
  }
?>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="../../index.php">Index <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">Project #2 "Grades"</h3>
      </div>
      <div style="text-align: right;"><a href="index.php"><button class="btn btn-primary"><- Back</button></a></div>
      <br>
      <br>
      <form action="save_file.php">
        <h5 class="text-muted">Student Information</h5>
        <?php
            echo '<input type="hidden" id="row" name="row" value="' . $row . '">';
        ?>
        <div id="entries" style="display: none;">
            <?php 
                if ($row != "null") {
                    echo htmlspecialchars($x);
                }
                else {
                    echo htmlspecialchars("0");
                }
            ?>
        </div>
        <div class="form-group">
            First Name
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $firstName ?>">
        </div>
        <div class="form-group">
            Last Name
            <input type="text" class="form-control" id="lastName" name="lastName"  value="<?php echo $lastName ?>">
        </div>
        <br>

        <h5 class="text-muted">Edit Grades</h5>
        <div id="grades">
            <?php
                if ($row != "null") {
                    $i = 1;
                    foreach ($grades as $number) {
                        echo '<input type="number" class="form-control" id="grade' . $i . '" name="grade' . $i . '" value="' . $number . '"><br>';
                        $i++;
                    }
                }
                else {
                    echo '<input type="number" class="form-control" id="grade1" name="grade1" placeholder="Grade"><br>';
                }
            ?>
        </div>
        </br>

        <button type="button" class="btn btn-success" onclick="addGrade()">
            +
        </button>
        
        <br>
        <br>
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
      

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
