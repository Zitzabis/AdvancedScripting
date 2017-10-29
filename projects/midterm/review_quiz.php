<?php include("../../php/html_head.php") ?>

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
        <h3 class="text-muted">Midterm</h3>
      </div>
      <?php
        session_start();
        $quiz = $_GET['id'];
        if ($_SESSION['teacher'] == 0)
          echo '<a href="index.php"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>';
        else
          echo '<a href="student_attempts.php?id=' . $quiz . '"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>';
      ?>
      <?php include("php/login.php"); ?>
      <br>
      <br>
        <?php
            echo '<input type="hidden" id="quiz" name="quiz" value="' . $_GET['id'] . '">'; // Store hidden row information for use later in form
        ?>
        <?php
            // Connect to DB
            include_once("scripts/connect.inc.php");

            if(isset($_GET['student'])) {
              $user = $_GET['student'];
            }
            else {
              $user = $_SESSION['user_id'];
            }

            $query = "SELECT completed, wrong, score FROM user_has_quiz WHERE quizID=" . $quiz . " AND userID=" . $user;
            $query_run = mysqli_query($mysqli, $query);
            $query_array = mysqli_fetch_assoc($query_run);
            $completed = $query_array['completed'];
            $wrong = $query_array['wrong'];
            $wrong = explode(" ", $wrong);
            $grade = $query_array['score'];

            if ($completed != 0) {
                $query = 'SELECT title FROM quiz WHERE id=' . $quiz;
                $query_run = mysqli_query($mysqli, $query);
                $query_array = mysqli_fetch_assoc($query_run);
                $title = $query_array['title'];

                echo '<h1 class="text-center">' . $title . '</h1>';
                echo '<h4 class="text-center">';
                if ($_SESSION['teacher'] == 0)
                  echo 'You';
                else
                  echo 'The student';
                echo ' got a ' . $grade . ' on this quiz.</h4>';

                $query = 'SELECT questionID, question, options, points, answer FROM question WHERE quiz=' . $quiz;
                $query_run = mysqli_query($mysqli, $query);
                
                // Tick through all results from the query
                while ($query_array = mysqli_fetch_assoc($query_run)) {
                    // Fetch columns and store into vars
                    $questionID = $query_array['questionID'];
                    $question = $query_array['question'];
                    $options = $query_array['options'];
                    $points = $query_array['points'];
                    $answer = $query_array['answer'];

                    $optionsArray = explode("\n", $options);

                    echo '<h3 class="text-muted">';
                    if (in_array($questionID, $wrong))
                        echo '<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color: red;"></span> ';
                    else
                        echo '<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green;"></span> ';
                    echo $question . ' (' . $points . ' pts.)</h3>';

                    foreach ($optionsArray as $value) {
                        $value = trim($value); // Fixes some weird trailing whitespace
                        echo $value;
                        if ($value == $answer) {
                            echo ' <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color: green;"></span>';
                        }
                        echo '<br>';
                    }
                    echo "<hr>";
                }
            }
            else {
              echo '<h1 class="text-center">';
              if ($_SESSION['teacher'] == 0)
                echo 'You still need to take this quiz</h1>';
              else
                echo 'The student still needs to take this quiz</h1>';
            }
        ?>
      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
