<?php
  // Author:      Stephen Floyd
  // Date:        10/6/17
  // Assignment:  Project #5

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
        <h3 class="text-muted">Project #5 "Manipulating News Items"</h3>
      </div>

      <a href="add_article.php"><button type="button" class="btn btn-info">New Article</button></a>
      <br>
      <br>
      <table class="table">
        <thead class="thead-inverse">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Creation Date</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>
        <?php
          // Connect to DB
          include_once("scripts/connect.inc.php");

          // Build query and run it
          $query = "SELECT `articleID`, `title`, `date` FROM article ORDER BY `articleID` DESC";
          $query_run = mysqli_query($mysqli, $query); 
          
          // Tick through all results from the query
          while ($query_array = mysqli_fetch_assoc($query_run)) {
            // Fetch columns and store into vars
            $id = $query_array['articleID'];
            $title = $query_array['title'];
            $date = $query_array['date'];

            echo "<tr>";
              echo "<td>" . $id . "</td>";
              echo "<td>" . $title . "</td>";
              echo "<td>" . $date . "</td>";
              echo '<td><a href="edit.php?row=' . $id . '"><button type="button" class="btn btn-info">Edit</button></a></td>';
              echo '<td><a href="scripts/article_delete.php?row=' . $id . '" onclick="return confirm(\'Are you sure you want to delete this article?\');"><button type="button" class="btn btn-danger">Delete</button></a></td>';
            echo "</tr>";
          }
        ?>
              
        </tbody>
      </table>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
