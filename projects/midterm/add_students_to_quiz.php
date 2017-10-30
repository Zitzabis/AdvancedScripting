<?php
    // Author:      Stephen Floyd
    // Date:        10/30/17
    // Assignment:  Midterm

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user_id']) || $_SESSION['teacher'] == 0) {
      header('Location: index.php');
    }

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
            <h3 class="text-muted">Midterm "Quizmania"</h3>
            </div>
            <?php include("php/login.php"); ?>
            <br>
            <br>
            <form class="form" action="scripts/students_to_quiz.php">
                <?php
                    echo '<input type="hidden" id="quiz" name="quiz" value="' . $_GET['quiz'] . '">'; // Store hidden row information for use later in form
                ?>
                <table class="table" style="margin-top: 2em;">
                    <thead class="thead-inverse">
                        <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Add to quiz</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Connect to DB
                        include_once("scripts/connect.inc.php");

                        // Build query and run it
                        $query = "SELECT id, firstName, lastName FROM user WHERE teacher=0 ORDER BY `lastName` ASC";
                        $query_run = mysqli_query($mysqli, $query); 
                        
                        // Tick through all results from the query
                        while ($query_array = mysqli_fetch_assoc($query_run)) {
                            // Fetch columns and store into vars
                            $id = $query_array['id'];
                            $firstName = $query_array['firstName'];
                            $lastName = $query_array['lastName'];

                            // Fill out table with data
                            echo "<tr>";
                                echo "<td>" . $id . "</td>";
                                echo "<td>" . $lastName . ", " . $firstName . "</td>";
                                echo '<td><input type="checkbox" id="' . $id . '" name="' . $id . '"></td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="text-center"><button type="submit" class="btn btn-success">Assign Students to Quiz</button></div>
                <br>
            </form>

            <footer class="footer">
            <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
            </footer>

        </div> <!-- /container -->

        <?php include("../../php/javascript.php") ?>
    </body>
</html>
