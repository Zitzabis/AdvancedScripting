<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm
    
    include("../../php/html_head.php")

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 0) {
      header('Location: index.php');
    }
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
        <h3 class="text-muted">Midterm</h3>
        </div>
        <?php include("php/login.php"); ?>
        <br>
        <br>
        
        <!-- New Password Form -->
        <form class="form" action="scripts/password_reset.php">
            <?php
                echo '<input type="hidden" id="user" name="user" value="' . $_GET['user'] . '">'; // Store hidden row information for use later in form
            ?>
            <div class="text-center">
                <h3 class="text-muted">New Password</h3>
                <div class="form-group" style="padding: 0.5em;">
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success">Reset Password</button>
                <br>
                <br>
            </div>
        </form>

        <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
        </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
</body>
</html>
