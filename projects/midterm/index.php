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
        <h3 class="text-muted">Project #[number] "[title]"</h3>
      </div>
      <?php
        // Check if a user is logged in
        // If so, display panel button and logout link
        session_start();
        if (isset($_SESSION['user_id'])) {
          if ($_SESSION['teacher'] == "1") {
            echo '<a href="panel.php"><button type="button" class="btn btn-info">Panel</button></a>';
          }
          echo '<a href="scripts/logout.php" style="float: right;">Logout</a>';
        }
        // Otherwise display login form
        else {
      ?>
          <form class="form-inline" action="scripts/checklogin.php">
            <div class="form-group" style="margin-right: 1em;">
              Username
              <input type="username" class="form-control" name="username" placeholder="Username" style="margin-left: 0.5em;">
            </div>
            <div class="form-group">
              Password 
              <input type="password" class="form-control" name="password" placeholder="Password" style="margin-left: 0.5em;">
            </div>
            <button type="submit" class="btn btn-default" style="margin-left: 1em;">Sign in</button>
          </form>
      <?php
        }
      ?>
      <br>
      <br>
      [content]

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
