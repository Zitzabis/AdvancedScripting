<?php
    include("../../php/html_head.php");
    include_once("scripts/connect.inc.php");
    $id = $_GET["id"]; // GET destination email
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
      <a href="index.php"><button type="button" class="btn btn-info" style="float: right;"><-</button></a>

      <?php
        $query = "SELECT `articleID`, `title`, `body`, `author`, DATE_FORMAT(`date`, '%M %D, %Y') as 'date' FROM article WHERE `articleID`='" . $id . "'";
        $query_run = mysqli_query($mysqli, $query);
        $query_array = mysqli_fetch_assoc($query_run);
        $title = $query_array['title'];
        $body = $query_array['body'];
        $author = $query_array['author'];
        $date = $query_array['date'];

        $q = "SELECT `firstName`, `lastName`, `email` FROM user WHERE `id`=" . $author;
        $q_r = mysqli_query($mysqli, $q);
        $q_a = mysqli_fetch_assoc($q_r);
        $author = $q_a['firstName'] . " " . $q_a['lastName'];
        $email = $q_a['email'];
      ?>

      <br>
      <br>
      <h2><?php echo $title; ?></h2>
      <p class="text-muted"><?php echo $author . " (" . $email . ")<br>" . $date; ?></p>
      <?php echo $body; ?>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
