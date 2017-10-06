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

      <a href="index.php"><button type="button" class="btn btn-info" style="float: right;"><-</button></a>
      <br>
      <br>

      <!-- Form for creating the article -->
      <h5 class="text-muted">Add Article</h5>
      <form class="form text-center" action="scripts/article_add.php">
        <input type="hidden" class="form-control" id="row" name="row" value="null">
        <div class="form-group" style="padding: 0.5em;">
          <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        </div>
        <div class="form-group" style="padding: 0.5em;">
          <textarea class="form-control" id="body" name="body"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Post Article</button>
      </form>

      <br>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
