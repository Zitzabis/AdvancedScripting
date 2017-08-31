<?php include("../../php/html_head.php") ?>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">Advanced Scripting</h3>
      </div>

      <div class="jumbotron">
        <h1 class="display-3">Advanced Scripting</h1>
        <p class="lead">Stephen Floyd's work for Advanced Scripting in the Fall semester of 2017.</p>
      </div>

      <div class="row marketing">
        <div class="col-lg-6">
          <h4>Project #1</h4>
          <p>Mad Libs</p>
        </div>

        <div class="col-lg-6" style="text-align: right;">
          <a class="btn btn-primary" href="projects/project1/index.php" role="button">View Project --></a>
        </div>
      </div>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
