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
  $gradesFile = fopen($gradesPath, "w") or die("Unable to open file!"); // Open file in write mode
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
      <h5 class="text-muted">Send the following data to this email address:</h5>
      <form action="mail.php">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="example@mail.com" name="email" id="email">
          <span class="input-group-btn">
            <button class="btn btn-success" type="submit">Go!</button>
          </span>
        </div><!-- /input-group -->
      </form>
      <br>
      <?php
        // Feedback on email sending
        if ($_SESSION["emailsent"] == "success")
          echo '<div class="alert alert-success" role="alert">Email Sent!</div>';
        if ($_SESSION["emailsent"] == "fail")
          echo '<div class="alert alert-danger" role="alert">Unable to send the email. Please ensure the email address is valid.</div>';
      ?>
      <br>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Average Grade</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Loop in the lines from the file
            while ($line = fgets($gradesFile)) {
              $line = explode(" ", $line); // Sepperate the line into an array using " " as a delimiter
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
              ?>
              <tr>
                <td><?php print $name[1]; // Print last name ?></td>
                <td><?php print $name[0]; // Print first name ?></td>
                <td><?php print $grades; // Print grade average ?></td>
              </tr>
              <?php
            }
            fclose($gradesFile); // Closes the TXT file
          ?>
        </tbody>
      </table>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
