<?php
  // Author:      Stephen Floyd
  // Date:        10/30/17
  // Assignment:  Midterm

  include("../../php/html_head.php")

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 1) {
    header('Location: index.php');
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
        <h3 class="text-muted">Midterm "Quizmania"</h3>
      </div>
      <a href="index.php"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>
      <?php include("php/login.php"); ?>
      <br>
      <br>
      <form class="form" action="scripts/quiz_submit.php">
        <?php
            echo '<input type="hidden" id="quiz" name="quiz" value="' . $_GET['id'] . '">'; // Store hidden row information for use later in form
        ?>
        <?php
            // Connect to DB
            include_once("scripts/connect.inc.php");

            // Get current quiz
            $quiz = $_GET['id'];

            // Select row that matches current quiz and current user
            $query = "SELECT completed FROM user_has_quiz WHERE quizID=" . $quiz . " AND userID=" . $_SESSION['user_id'];
            $query_run = mysqli_query($mysqli, $query);
            $query_array = mysqli_fetch_assoc($query_run);
            $completed = $query_array['completed'];
            // Determine if user has completed the quiz yet
            // If not, deny them a second attempt
            if ($completed != 1) {
              // Fetch quiz information
              $query = 'SELECT title FROM quiz WHERE id=' . $quiz;
              $query_run = mysqli_query($mysqli, $query);
              $query_array = mysqli_fetch_assoc($query_run);
              $title = $query_array['title'];
              echo '<h1 class="text-center">' . $title . '</h1>';

              // Fetch all questions attached to quiz
              $query = 'SELECT questionID, question, options, points FROM question WHERE quiz=' . $quiz;
              $query_run = mysqli_query($mysqli, $query);
              
              // Tick through all results from the query
              while ($query_array = mysqli_fetch_assoc($query_run)) {
                  // Fetch columns and store into vars
                  $questionID = $query_array['questionID'];
                  $question = $query_array['question'];
                  $options = $query_array['options'];
                  $points = $query_array['points'];

                  $optionsArray = explode("\n", $options); // Break options into an array

                  echo '<h3 class="text-muted">' . $question . ' (' . $points . ' pts.)</h3>';

                  // Tick through the options array and build form
                  foreach ($optionsArray as $value) {
                      echo '<input type="radio" name="question' . $questionID . '" value="' . $value . '"> ' . $value . '<br>';
                  }
                  echo "<hr>";
              }
        ?>
        <div class="text-center"><button type="submit" class="btn btn-success">Submit Quiz</button></div>
        <br>
        <br>
        <?php } else { echo '<h1 class="text-center">You already did this quiz.</h1>'; } ?>
      </form>
      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
