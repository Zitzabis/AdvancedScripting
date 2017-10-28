<?php
  // Author:      Stephen Floyd
  // Date:        10/7/17
  // Assignment:  Project #6

  // Check if a user is logged in or has the correct permissions to view this page
  // If no, route them back to the site index
  if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
  if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 0) {
    header('Location: index.php');
  }

  // HTML head file
  include("../../php/html_head_noMCE.php");
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
      <?php include("php/login.php"); ?>
      <br>
      <br>

      <!-- Form for creating the article -->
      <p>
          Please add each question option on it's own line.<br>
          For example:
          <textarea class="form-control" disabled style="height: 100px">Option 1
Option 2
Option 3
Option 4</textarea>
      </p>
      <h3 class="text-muted">Add Quiz</h3>
      <form class="form text-center" action="scripts/article_add.php">
        <!-- Pass data from PHP to JS -->
        <div id="entries" style="display: none;">
            <?php 
                echo 0;
            ?>
        </div>
        <input type="hidden" class="form-control" id="row" name="row" value="null">
        <div class="form-group" style="padding: 0.5em;">
          <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div id="questions">
        
        </div>
        <!-- Add button -->
        <button type="button" class="btn btn-primary" onclick="addQuestion()">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New Question
        </button>
        <br>
        <br>
        <button type="submit" class="btn btn-success">Post Quiz</button>
      </form>

      <br>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
