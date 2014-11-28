</div> <!-- container close here -->
<div class="row hidden-print well footer-well">
  <div class="container">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <!-- <hr> -->
      <footer>
        <div class="row">
          <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <strong>News & Notifications</strong><br><br>
            <ul type="square" style="margin-left:-1.5em">
             <li>Students should fill the academic feedback on or beforee 28th, Nov, 2014</li>
           </ul>
         </div>
         <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <strong>Quick Links</strong><br><br>
          <ul type="square" style="margin-left:-1.5em">
            <li><a href="http://www.nitw.ac.in" target="_blank">College main website </a></li>
            <li><a href="http://www.nitw.ac.in/nitw/index.php/home/index.php?option=com_content&view=article&id=607" target="_blank">Fee structure 2014-15 </a></li>
            <li><a href="http://student.nitw.ac.in" target="_blank">Student Webmail</a></li>
            <li><a href="http://www.nitw.ac.in/nitw/index.php?option=com_content&view=article&id=554&amp;Itemid=60" target="_blank">Department Websites</a></li>
            <li><a href="http://www.nitw.ac.in/nitw/index.php/academics/rules" target="_blank">Rules and regulations</a></li>
          </ul>
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <strong>About Us</strong><br><br>
          <address>
            WSDC Office, <br>
            Level 1, Center for Innovation & Incubation <br>
            NIT Warangal, Telangana - 506004
          </address>
          Drop us an email on
          <a href="mailto:wsdc@nitw.ac.in">  <span class="glyphicon glyphicon-envelope"></span>  wsdc@nitw.ac.in</a> 
        </div>
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
          <strong>Follow us on Facebook</strong><br><br>
          Stay in touch with WSDC, NIT Warangal</br>
          <div class="fb-like" data-href="https://www.facebook.com/wsdc.nitw" data-layout="button" data-action="like" data-show-faces="false" data-share="true">
          </div>
          <br><br>
          Read more at  <a href="http://wsdc.nitw.ac.in" target="_blank">wsdc.nitw.ac.in <span class="glyphicon glyphicon-new-window"></span></a>
          <br>
          <span class="glyphicon glyphicon-copyright-mark"></span> <a class="tips" title="Web & Software Development Cell, NIT Warangal" target="_blank" href="http://wsdc.nitw.ac.in/">WSDC, NIT Warangal </a>
        </div>
      </div>

    </footer>
  </div>
</div> <!-- footer container close here -->
</div> <!-- /row with hidden print closes -->


<script src="<?php echo asset_url()."js/jquery-1.11.1.min.js"; ?> "></script>
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
