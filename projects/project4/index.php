<?php
  // Author:      Stephen Floyd
  // Date:        10/6/17
  // Assignment:  Project #4

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
        <h3 class="text-muted">Project #4 "Designing the Database"</h3>
      </div>
        <a href="add_article.php"><button type="button" class="btn btn-info">New Article</button></a>
        <br>
        <br>
        <?php
          // Connect to DB
          include_once("scripts/connect.inc.php");

          // Build query and run it
          $query = "SELECT `articleID`, `title`, `body`, `author`, DATE_FORMAT(`date`, '%M %D, %Y') as 'date' FROM article ORDER BY `articleID` DESC";
          $query_run = mysqli_query($mysqli, $query); 
          
          // Tick through all results from the query
          while ($query_array = mysqli_fetch_assoc($query_run)) {
            // Fetch columns and store into vars
            $id = $query_array['articleID'];
            $title = $query_array['title'];
            $body = $query_array['body'];
            $author = $query_array['author'];
            $date = $query_array['date'];

            // Run query for author name and store results
            $q = "SELECT `firstName`, `lastName` FROM user WHERE `id`=" . $author;
            $q_r = mysqli_query($mysqli, $q);
            $q_a = mysqli_fetch_assoc($q_r);
            $author = $q_a['firstName'] . " " . $q_a['lastName'];
        ?>
            <div class="well">
              <h3><?php echo $title; // Title ?></h3>
              <hr>
              <?php echo substr(strip_tags($body), 0, 200) . "..."; // Head of article body ?>
              <hr>
              <div class="text-muted" style="text-align: right;">
                <?php echo $author; // Author first and last ?>
                <br>
                <?php
                  echo $date // Article creation date;
                ?>
              </div>
              <div class="text-center"><a href="article.php?id=<?php echo $id; ?>"><button type="button" class="btn btn-info" style="align-text: center;">Read More</button></a></div>
            </div>
        <?php
          }
        ?>
      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
