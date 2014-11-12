       <!-- <div class="container">  </div> -->
       <div class="row hidden-print">
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
          <hr>
          <footer>
            <div class="fb-like pull-right" data-href="https://www.facebook.com/wsdc.nitw" data-layout="button" data-action="like" data-show-faces="false" data-share="true">
            </div>
            <div class="clearfix visible-sm visible-xs">
            </div>
            <small data-step="10" data-intro="Contact WSDC for any queries, feedback, suggestions">
            <span class="glyphicon glyphicon-copyright-mark"></span> <a class="tips" title="Web & Software Development Cell, NIT Warangal" target="_blank" href="http://www.nitw.ac.in/wsdc">WSDC, NITW </a> 
              | <a href="http://wsdc.nitw.ac.in" target="_blank">wsdc.nitw.ac.in</a> | 
              <span class="glyphicon glyphicon-envelope"> </span> <a href="mailto:wsdc@nitw.ac.in" target="_blank"> wsdc@nitw.ac.in</a>
            </small>
          </footer>
        </div>
      </div> <!-- /row with hidden print closes -->
      <br>

    </div> <!--  container-fluid from header.php closes here -->
    <script src="<?php echo asset_url()."js/jquery.js"; ?> "></script>
    <script src="<?php echo asset_url()."js/bootstrap.min.js"; ?> "></script>
    <!-- <script src="<?php //echo asset_url()."js/intro.min.js"; ?> "></script> -->
    <script src="<?php echo asset_url()."js/offcanvas.js"; ?> "></script>
    <?php
    if (isset($scripts)) {
      foreach ($scripts as $index => $script) {
        ?>
        <script src="<?php echo asset_url()."js/".$script; ?>"></script>
        <?php
      }
    }
    ?>
    <div id="fb-root"></div>
    <script src="<?php echo asset_url()."js/social.js"; ?> "></script>
  </body>
  </html>
