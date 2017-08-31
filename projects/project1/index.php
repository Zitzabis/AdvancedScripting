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
        <h3 class="text-muted">Project #1 "Mad Libs"</h3>
      </div>

      <form action="result.php">
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Adjective</span>
            <input type="text" class="form-control" name="field1" id="field1" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Noun</span>
            <input type="text" class="form-control" name="field2" id="field2" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Verb: Past Tense</span>
            <input type="text" class="form-control" name="field3" id="field3" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Adverb</span>
            <input type="text" class="form-control" name="field4" id="field4" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Adjective</span>
            <input type="text" class="form-control" name="field5" id="field5" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Noun</span>
            <input type="text" class="form-control" name="field6" id="field6" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Noun</span>
            <input type="text" class="form-control" name="field7" id="field7" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Adjective</span>
            <input type="text" class="form-control" name="field8" id="field8" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Verb</span>
            <input type="text" class="form-control" name="field9" id="field9" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Adverb</span>
            <input type="text" class="form-control" name="field10" id="field10" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Verb: Past Tense</span>
            <input type="text" class="form-control" name="field11" id="field11" aria-describedby="basic-addon1">
          </div>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Adjective</span>
            <input type="text" class="form-control" name="field12" id="field12" aria-describedby="basic-addon1">
          </div>
          
          <div style="text-align: center; padding: 2rem">
              <button type="submit" class="btn btn-success">Submit</button>
          </div>
      </form>

      <footer class="footer">
        <p>&copy; Stephen Floyd <?php echo date("Y"); ?></p>
      </footer>

    </div> <!-- /container -->

    <?php include("../../php/javascript.php") ?>
  </body>
</html>
