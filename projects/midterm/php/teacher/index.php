<h4 class="text-muted text-center">Your Quizzes</h4>
<table class="table" style="margin-top: 2em;">
  <thead class="thead-inverse">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Active</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <?php
      // Connect to DB
      include_once("scripts/connect.inc.php");

      // Build query and run it
      $query = "SELECT id, title, madeBy, active FROM quiz WHERE madeBy=" . $_SESSION['user_id'] . " ORDER BY `id` DESC";
      $query_run = mysqli_query($mysqli, $query); 
      
      // Tick through all results from the query
      while ($query_array = mysqli_fetch_assoc($query_run)) {
        // Fetch columns and store into vars
        $id = $query_array['id'];
        $title = $query_array['title'];
        $active = $query_array['active'];

        // Check if the row needs to be marked as deleted
        echo "<tr ";
        if ($active == 0) {
          echo 'style="background-color: #ffa5a5;"';
        }
        echo ">";
          // Fill out table with data
          echo "<td>" . $id . "</td>";
          echo "<td>" . $title . "</td>";
          echo "<td>" . $date . "</td>";
          echo '<td><a href="edit.php?id=' . $id . '"><button type="button" class="btn btn-info">Edit</button></a></td>';

          // Check if it should show deleted or restored button
          if ($deleted == 0) {
            echo '<td><a href="scripts/article_delete.php?id=' . $id . '" onclick="return confirm(\'Are you sure you want to delete this article?\');"><button type="button" class="btn btn-danger">Delete</button></a></td>';
          }
          else {
            echo '<td><a href="scripts/article_restore.php?id=' . $id . '"><button type="button" class="btn btn-success">Restore</button></a></td>';
          }
          
        echo "</tr>";
      }
    ?>
    <tr><td><a href="add_quiz.php"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Quiz</button></a></td></tr>
  </tbody>
</table>