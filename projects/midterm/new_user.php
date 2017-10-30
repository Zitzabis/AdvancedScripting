<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm
    
    include("../../php/html_head.php");

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
        <h3 class="text-muted">Midterm "Quizmania"</h3>
        </div>
        <?php include("php/login.php"); ?>
        <br>
        <br>
        
        <!-- New User Form -->
        <form class="form" action="scripts/account_new.php">
            <div class="text-center">
                <h3 class="text-muted">New User</h3>
            </div>
                <div class="form-group" style="padding: 0.5em;">
                    Username
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="form-group" style="padding: 0.5em;">
                    Password
                    <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <hr>
                <div class="form-group" style="padding: 0.5em;">
                    First Name
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                </div>
                <div class="form-group" style="padding: 0.5em;">
                    Last Name
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                </div>
                <div class="form-group" style="padding: 0.5em;">
                    Email
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <hr>
                <h4 class="text-muted">Role for user:</h4>
                <input type="radio" name="role" value="Student"> Student<br>
                <input type="radio" name="role" value="Teacher"> Teacher<br>
                <br>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Create User</button>
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
