<h2 class="text-muted text-center">Your Quizzes</h2>
<table class="table" style="margin-top: 2em;">
  <thead class="thead-inverse">
    <tr>
      <th>Title</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Connect to DB
      include_once("scripts/connect.inc.php");

      // Build query and run it
      $query = "SELECT id, title, madeBy, active, deleted FROM quiz WHERE madeBy=" . $_SESSION['user_id'] . " AND deleted=0 ORDER BY `id` DESC";
      $query_run = mysqli_query($mysqli, $query); 
      
      // Tick through all results from the query
      while ($query_array = mysqli_fetch_assoc($query_run)) {
        // Fetch columns and store into vars
        $id = $query_array['id'];
        $title = $query_array['title'];
        $active = $query_array['active'];
        $deleted = $query_array['deleted'];

        // Check if the row needs to be marked as deleted
        echo "<tr>";
          // Fill out table with data
          echo "<td>" . $title . "</td>";
          echo '<td>';
            echo '<a href="scripts/quiz_delete.php?id=' . $id . '" onclick="return confirm(\'Are you sure you want to delete this quiz?\');"><button type="button" class="btn btn-danger paddedButton">Delete</button></a>';
            echo '<a href="edit_quiz.php?id=' . $id . '"><button type="button" class="btn btn-info paddedButton"';
            if ($active == 0)
              echo 'disabled';
            echo '>Edit</button></a>';
            if ($active == 0)
              echo '<a href="scripts/quiz_activate.php?id=' . $id . '"><button type="button" class="btn btn-success paddedButton">Activate</button></a>';
            else
            echo '<a href="scripts/quiz_disable.php?id=' . $id . '"><button type="button" class="btn btn-warning paddedButton">Disable</button></a>';
            echo '</td>';
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
<a href="add_quiz.php"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Quiz</button></a><br><br>