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
        <?php
            // Connect to DB
            include_once("scripts/connect.inc.php");
            $quizID = $_GET['id'];

            $query = "SELECT title FROM quiz WHERE id=" .$quizID;
            $query_run = mysqli_query($mysqli, $query);
            $query_array = mysqli_fetch_assoc($query_run);
            $title = $query_array['title'];
        ?>
        <h3><?php echo $title; ?></h3>
        <table class="table" style="margin-top: 2em;">
            <thead class="thead-inverse">
                <tr>
                <th>Name</th>
                <th>Grade</th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Build query and run it
                    $query = "SELECT userID, score, completed FROM user_has_quiz WHERE quizID=" . $quizID;
                    $query_run = mysqli_query($mysqli, $query); 
                    
                    // Tick through all results from the query
                    while ($query_array = mysqli_fetch_assoc($query_run)) {
                        // Fetch columns and store into vars
                        $userID = $query_array['userID'];
                        $score = $query_array['score'];
                        $completed = $query_array['completed'];

                        $q = "SELECT firstName, lastName FROM user WHERE id=" .$userID;
                        $qr = mysqli_query($mysqli, $q);
                        $qa = mysqli_fetch_assoc($qr);
                        $firstName = $qa['firstName'];
                        $lastName = $qa['lastName'];

                        // Fill out table with data
                        echo "<tr>";
                            echo "<td>" . $lastName . ", " . $firstName . "</td>";
                            if ($completed == 0)
                                echo '<td>Not yet finished.</td>';
                            else
                                echo '<td>' . $score . '</td>';
                            echo '<td><a href="review_quiz.php?id=' . $quizID . '&student=' . $userID . '"><button type="button" class="btn btn-info paddedButton">Details</button></a></td>';
                        echo "</tr>";
                    }
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
