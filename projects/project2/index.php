<?php
  include("../../php/html_head.php");
  $gradesPath = "Grades.txt";
  $gradesFile = fopen($gradesPath, 'r'); // Read only mode
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
            while ($line = fgets($gradesFile)) {
              $line = explode(" ", $line);
              $i = 0;
              $name = [];
              $grades = 0;
              foreach ($line as $entry) {
                if ($entry != -1 && $entry != -2) {
                  if ($i < 2) {
                    $name[] = $entry;
                  }
                  else {
                    $grades += $entry;
                  }
                }
                $i++;
              }
              $grades = number_format((float)($grades / $i - 2), 2, '.', '');
              ?>
              <tr>
                <td><?php print $name[0]; ?></td>
                <td><?php print $name[1]; ?></td>
                <td><?php print $grades ?></td>
              </tr>
              <?php
            }
            fclose($gradesFile);
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
