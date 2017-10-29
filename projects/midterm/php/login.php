<?php
    // Check if a user is logged in
    // If so, display panel button and logout link
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['teacher'] == "1") {
            echo '<a href="index.php"><button type="button" class="btn btn-info">Panel</button></a>';
        }
        echo '<a href="scripts/logout.php" style="float: right;"><button type="button" class="btn btn-default btn-sm">Logout</button></a>';
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