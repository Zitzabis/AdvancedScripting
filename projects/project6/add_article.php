<?php
  // Author:      Stephen Floyd
  // Date:        10/7/17
  // Assignment:  Project #6

  // Check if a user is logged in or has the correct permissions to view this page
  // If no, route them back to the site index
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['permission'] < 1) {
    header('Location: index.php');
  }

  // HTML head file
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
        <h3 class="text-muted">Project #6 "Protecting the Administration Module"</h3>
      </div>

      <a href="panel.php"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>
      <a href="scripts/logout.php" style="float: right;">Logout</a>
      <br>
      <br>

      <!-- Form for creating the article -->
      <h5 class="text-muted">Add Article</h5>
      <form class="form text-center" action="scripts/article_add.php">
        <input type="hidden" class="form-control" id="row" name="row" value="null">
        <div class="form-group" style="padding: 0.5em;">
          <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div class="form-group" style="padding: 0.5em;">
          <textarea class="form-control" id="body" name="body"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Post Article</button>
      </form>

      <br>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
