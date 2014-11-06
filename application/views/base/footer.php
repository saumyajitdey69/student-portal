       <!-- <div class="container">  </div> -->
        <div class="row hidden-print">
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <hr>
            <footer>
             <span data-step="10" data-intro="Contact WSDC for any queries, feedback, suggestions">
               <div class="fb-like" data-href="https://www.facebook.com/wsdc.nitw" data-layout="standard" data-action="like" data-show-faces="false" data-share="true">
               </div>
               <div class="clearfix visible-sm visible-xs">
              </div>
              <a href="http://wsdc.nitw.ac.in" target="_blank">wsdc.nitw.ac.in</a> | 
              <span class="glyphicon glyphicon-envelope"> </span> <a href="mailto: wsdc.nitw@gmail.com" target="_blank"> wsdc.nitw@gmail.com</a> | 
              <!-- <span class="tips" title="Gopi Krishna, 4/4 Btech CSE"> <span class="glyphicon glyphicon-phone"> </span> +91-9704176445</span> | -->
              <span class="glyphicon glyphicon-copyright-mark"></span> <a target="_blank" href="http://www.nitw.ac.in/wsdc">Web & Software Development Cell, NITW </a> &nbsp;
            </span>
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
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
  </body>
  </html>
