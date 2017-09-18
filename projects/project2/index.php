<?php
  include("../../php/html_head.php");
  $gradesPath = "Grades.txt"; // Path to the Grades.txt file
  $gradesFile = fopen($gradesPath, 'r'); // Open file in read only mode
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
        <h3 class="text-muted">Project #2</h3>
      </div>
      <h5 class="text-muted">Send the following data to this email address:</h5>
      <form action="mail.php">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="example@mail.com">
          <span class="input-group-btn">
            <button class="btn btn-success" type="submit">Go!</button>
          </span>
        </div><!-- /input-group -->
      </form>
      <br>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
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
              $grades = number_format((float)($grades / $i - 2), 2, '.', '');
              ?>
              <tr>
                <td><?php print $name[0]; // Print first name ?></td>
                <td><?php print $name[1]; // Print laste name ?></td>
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
