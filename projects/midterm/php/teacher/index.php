<!--
Author:      Stephen Floyd
Date:        10/30/17
Assignment:  Midterm

This displays the teacher content for the index page.
-->

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

      // Fetch all non-deleted quizzes made by the currently logged in teacher
      $query = "SELECT id, title, madeBy, active, deleted FROM quiz WHERE madeBy=" . $_SESSION['user_id'] . " AND deleted=0 ORDER BY `id` DESC";
      $query_run = mysqli_query($mysqli, $query); 
      
      // Tick through all results from the query
      while ($query_array = mysqli_fetch_assoc($query_run)) {
        // Fetch columns and store into vars
        $id = $query_array['id'];
        $title = $query_array['title'];
        $active = $query_array['active'];
        $deleted = $query_array['deleted'];

        echo "<tr>";
          // Fill out table with data
          echo "<td>" . $title . "</td>";
          echo '<td>';
            echo '<a href="scripts/quiz_delete.php?id=' . $id . '" onclick="return confirm(\'Are you sure you want to delete this quiz?\');"><button type="button" class="btn btn-danger paddedButton">Delete</button></a>';
            echo '<a href="student_attempts.php?id=' . $id . '"><button type="button" class="btn btn-info paddedButton">Review</button></a>';
            // Show Activate or Disable button depending on quiz state
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

<h2 class="text-muted text-center">Users</h2>
<table class="table" style="margin-top: 2em;">
    <thead class="thead-inverse">
        <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Role</th>
        <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            // Build query and run it
            $query = "SELECT id, username, firstName, lastName, teacher FROM user";
            $query_run = mysqli_query($mysqli, $query); 
            
            // Tick through all results from the query
            while ($query_array = mysqli_fetch_assoc($query_run)) {
                // Fetch columns and store into vars
                $id = $query_array['id'];
                $username = $query_array['username'];
                $firstName = $query_array['firstName'];
                $lastName = $query_array['lastName'];
                $teacher = $query_array['teacher'];

                // Fill out table with data
                echo "<tr>";
                  echo "<td>" . $id . "</td>";
                  echo "<td>" . $username . "</td>";
                  echo "<td>" . $lastName . ", " . $firstName . "</td>";
                  if ($teacher == 0)
                    echo "<td>Student</td>";
                  else
                    echo "<td>Teacher</td>";
                  echo '<td><a href="reset_password.php?user=' . $id . '"><button type="button" class="btn btn-warning paddedButton">Reset Password</button></a></td>';
                echo "</tr>";
            }
        ?>
    </tbody>
</table>
<a href="new_user.php"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add User</button></a><br><br>