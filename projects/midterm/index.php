<?php include("../../php/html_head.php") ?>

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
        <h3 class="text-muted">Midterm "Quizmania"</h3>
      </div>
      <?php include("php/login.php"); ?>
      <br>
      <br>
      <?php
        if(isset($_SESSION['teacher'])) {
          if($_SESSION['teacher'] == 1) {
            include("php/teacher/index.php");
          }
          else {
            include("php/student/index.php");
          }
        }
        else {
          include("php/public/index.php");
        }
      ?>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
