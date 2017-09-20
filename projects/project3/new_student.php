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
      <h5 class="text-muted">New Student</h5>
      <form class="form-inline" action="edit_grades.php">
        <input type="hidden" class="form-control" id="row" name="row" value="null">
        <div class="form-group" style="padding: 0.5em;">
          <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
        </div>
        <div class="form-group" style="padding: 0.5em;">
          <input type="text" class="form-control" id="lastName" name="lastName"  placeholder="Last Name">
        </div>
        <button type="submit" class="btn btn-success">Add Student</button>
      </form>
      <br>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
