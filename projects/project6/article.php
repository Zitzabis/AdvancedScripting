<?php
    // Author:      Stephen Floyd
    // Date:        10/7/17
    // Assignment:  Project #6

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
        <h3 class="text-muted">Project #6 "Protecting the Administration Module"</h3>
      </div>
      <a href="index.php"><button type="button" class="btn btn-info"><i class="fa fa-reply" aria-hidden="true"></i></button></a>

      <?php
        // Build and run query for articles and get title, body, author ID and the creation date
        $query = "SELECT `articleID`, `title`, `body`, `author`, DATE_FORMAT(`date`, '%M %D, %Y') as 'date' FROM article WHERE `articleID`='" . $id . "'";
        $query_run = mysqli_query($mysqli, $query);
        $query_array = mysqli_fetch_assoc($query_run);
        $title = $query_array['title'];
        $body = $query_array['body'];
        $author = $query_array['author'];
        $date = $query_array['date'];

        // Build and run author query and get name and email
        $q = "SELECT `firstName`, `lastName`, `email` FROM user WHERE `id`=" . $author;
        $q_r = mysqli_query($mysqli, $q);
        $q_a = mysqli_fetch_assoc($q_r);
        $author = $q_a['firstName'] . " " . $q_a['lastName'];
        $email = $q_a['email'];
      ?>

      <br>
      <br>
      <h2><?php echo $title; // Print title ?></h2>
      <p class="text-muted"><?php echo $author . " (" . $email . ")<br>" . $date; // Print author, author contact and creation date ?></p>
      <?php echo $body; // Print the body of the article ?>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->
  </body>
</html>
