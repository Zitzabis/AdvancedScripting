<h4 class="text-muted text-center">Your Quizzes</h4>
<table class="table" style="margin-top: 2em;">
  <thead class="thead-inverse">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Edit</th>
      <th>Delete</th>
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
        echo "<tr ";
        if ($active == 0) {
          echo 'style="background-color: #ffbd68;"';
        }
        echo ">";
          // Fill out table with data
          echo "<td>" . $id . "</td>";
          echo "<td>" . $title . "</td>";
          echo '<td><a href="edit_quiz.php?id=' . $id . '"><button type="button" class="btn btn-info" disabled>Edit</button></a></td>';
          echo '<td><a href="scripts/quiz_delete.php?id=' . $id . '" onclick="return confirm(\'Are you sure you want to delete this quiz?\');"><button type="button" class="btn btn-danger">Delete</button></a></td>';
        echo "</tr>";
      }
    ?>
  </tbody>
</table>
<a href="add_quiz.php"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Quiz</button></a><br><br>