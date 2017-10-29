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

            $quiz = $_GET['id'];

            $query = 'SELECT title FROM quiz WHERE id=' . $quiz;
            $query_run = mysqli_query($mysqli, $query);
            $query_array = mysqli_fetch_assoc($query_run);
            $title = $query_array['title'];

            $query = 'SELECT questionID, question, options, points FROM question WHERE quiz=' . $quiz;
            $query_run = mysqli_query($mysqli, $query);
            
            // Tick through all results from the query
            while ($query_array = mysqli_fetch_assoc($query_run)) {
                // Fetch columns and store into vars
                $questionID = $query_array['questionID'];
                $question = $query_array['question'];
                $options = $query_array['options'];
                $points = $query_array['points'];

                $optionsArray = explode("\n", $options);

                echo '<h1 class="text-center">' . $title . '</h1>';
                echo '<h3 class="text-muted">' . $question . ' (' . $points . ' pts.)</h3>';

                foreach ($optionsArray as $value) {
                    echo '<input type="radio" name="question' . $questionID . '" value="' . $value . '"> ' . $value . '<br>';
                }
                echo "<hr>";
            }
        ?>
        <div class="text-center"><button type="submit" class="btn btn-success">Submit Quiz</button></div>
        <br>
        <br>
      </form>
      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
