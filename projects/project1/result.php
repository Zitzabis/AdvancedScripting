<?php
    include("../../php/html_head.php"); // Pulls in generic HTML content

    // Get all words via GET system from the previous form
    $var1 = $_GET["field1"];
    $var2 = $_GET["field2"];
    $var3 = $_GET["field3"];
    $var4 = $_GET["field4"];
    $var5 = $_GET["field5"];
    $var6 = $_GET["field6"];
    $var7 = $_GET["field7"];
    $var8 = $_GET["field8"];
    $var9 = $_GET["field9"];
    $var10 = $_GET["field10"];
    $var11 = $_GET["field11"];
    $var12 = $_GET["field12"];
?>

  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills float-right">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Back <span class="sr-only">(current)</span></a>
            </li>
          </ul>
        </nav>
        <h3 class="text-muted">Advanced Scripting</h3>
      </div>
        <?php
            // Print story with words filled in
            echo(
                "Today I  went to the zoo. I  saw a " . $var1 . " " . $var2 .
                " jumping up and down in its tree. He " . $var3 . " " . $var4 .
                " through the large tunnel that led to its " . $var5 . " " . $var6 .
                ". I got some peanuts and passed them through the cage to a gigantic gray " . $var7 .
                " towering above my head. Feeding that animal made me hungry. I went to get a " . $var8 .
                " scoop of ice cream. It filled my stomach. Afterwards I had to " . $var9 . " " . $var10 .
                " to catch our bus. When I got home I " . $var11 . " my mom for a " . $var12 . " day at the zoo."
                )
        ?>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
