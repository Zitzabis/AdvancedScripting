<h2 class="text-muted text-center">Your Quizzes</h2>
<h3>Todo</h3>
<table class="table" style="margin-top: 2em;">
  <thead class="thead-inverse">
    <tr>
      <th>Title</th>
      <th>Take</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Connect to DB
      include_once("scripts/connect.inc.php");

      $query = 'SELECT quizID FROM user_has_quiz shq WHERE userID=' . $_SESSION['user_id'] . ' AND completed=0 ORDER BY id ASC';
      $query_run = mysqli_query($mysqli, $query); 
      
      // Tick through all results from the query
      while ($query_array = mysqli_fetch_assoc($query_run)) {
        // Fetch columns and store into vars
        $quizID = $query_array['quizID'];

        $q = "SELECT title FROM quiz WHERE id=" . $quizID;
        $qr = mysqli_query($mysqli, $q);
        $qa = mysqli_fetch_assoc($qr);
        $title = $qa['title'];

        // Check if the row needs to be marked as deleted
        echo "<tr>";
          // Fill out table with data
          echo "<td>" . $title . "</td>";
          echo '<td><a href="take_quiz.php?id=' . $quizID . '"><button type="button" class="btn btn-primary">Take Quiz</button></a></td>';
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

<hr>

<h3>Completed</h3>
<table class="table" style="margin-top: 2em;">
  <thead class="thead-inverse">
    <tr>
      <th>Title</th>
      <th>Grade</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Connect to DB
      include_once("scripts/connect.inc.php");

      $query = 'SELECT quizID, score FROM user_has_quiz WHERE userID=' . $_SESSION['user_id'] . ' AND completed=1 ORDER BY id ASC';
      $query_run = mysqli_query($mysqli, $query); 
      
      // Tick through all results from the query
      while ($query_array = mysqli_fetch_assoc($query_run)) {
        // Fetch columns and store into vars
        $quizID = $query_array['quizID'];
        $grade = $query_array['score'];

        $q = "SELECT title FROM quiz WHERE id=" . $quizID;
        $qr = mysqli_query($mysqli, $q);
        $qa = mysqli_fetch_assoc($qr);
        $title = $qa['title'];

        // Check if the row needs to be marked as deleted
        echo "<tr>";
          // Fill out table with data
          echo "<td>" . $title . "</td>";
          echo '<td>' . $grade . '</td>';
        echo "</tr>";
      }
    ?>
  </tbody>
</table>