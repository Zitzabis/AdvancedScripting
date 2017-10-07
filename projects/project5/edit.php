<?php
    // Author:      Stephen Floyd
    // Date:        10/6/17
    // Assignment:  Project #5

    // HTML head file
    include("../../php/html_head.php");
    include_once("scripts/connect.inc.php"); // Connect to DB
    $id = $_GET["id"]; // GET article ID
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
      <a href="panel.php"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>
      <br>
      <br>

      <?php
        // Build and run query for articles and get title, body, author ID and the creation date
        $query = "SELECT `articleID`, `title`, `body`, `author`, DATE_FORMAT(`date`, '%M %D, %Y') as 'date' FROM article WHERE `articleID`='" . $id . "'";
        $query_run = mysqli_query($mysqli, $query);
        $query_array = mysqli_fetch_assoc($query_run);
        $title = $query_array['title'];
        $body = $query_array['body'];
      ?>

      <!-- Form for creating the article -->
      <h5 class="text-muted">Edit Article</h5>
      <form class="form text-center" action="scripts/article_update.php">
        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $id; ?>">
        <div class="form-group" style="padding: 0.5em;">
          <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php echo $title; ?>">
        </div>
        <div class="form-group" style="padding: 0.5em;">
          <textarea class="form-control" id="body" name="body"><?php echo $body; ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update Article</button>
      </form>

      <br>
      <br>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
