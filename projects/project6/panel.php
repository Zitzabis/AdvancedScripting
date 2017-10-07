<?php
  // Author:      Stephen Floyd
  // Date:        10/7/17
  // Assignment:  Project #6

  // Check if a user is logged in or has the correct permissions to view this page
  // If no, route them back to the site index
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['permission'] < 1) {
    header('Location: index.php');
  }

  // HTML head file
  include("../../php/html_head.php");
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
      <a href="index.php"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>
      <a href="scripts/logout.php" style="float: right;">Logout</a>

      <h4 class="text-muted text-center">Articles</h4>
      <table class="table" style="margin-top: 2em;">
        <thead class="thead-inverse">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Last Updated</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
            // Connect to DB
            include_once("scripts/connect.inc.php");

            // Build query and run it
            $query = "SELECT `articleID`, `title`, `date`, `deleted` FROM article ORDER BY `articleID` DESC";
            $query_run = mysqli_query($mysqli, $query); 
            
            // Tick through all results from the query
            while ($query_array = mysqli_fetch_assoc($query_run)) {
              // Fetch columns and store into vars
              $id = $query_array['articleID'];
              $title = $query_array['title'];
              $date = $query_array['date'];
              $deleted = $query_array['deleted'];

              // Check if the row needs to be marked as deleted
              echo "<tr ";
              if ($deleted == 1) {
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
          <tr><td><a href="add_article.php"><button type="button" class="btn btn-success">New Article</button></a></td></tr>
        </tbody>
      </table>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
