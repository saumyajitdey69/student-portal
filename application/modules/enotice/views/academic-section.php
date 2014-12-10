<div class="list-group">
	<p class="list-group-item active">Academic Feedback is closed for July 2014 Session.</p>
    <a class="list-group-item" href="<?php echo base_url('assets/downloads/audit/undertaking.pdf') ?>" target="_blank"><span class="glyphicon glyphicon-download"></span> Undertaking forms</a>
    <a class="list-group-item" href="https://www.onlinesbh.com/prelogin/icollecthome.htm" target="_blank">State Bank Collect (former i-collect)</a>
    <a class="list-group-item" href="<?php echo base_url('assets/downloads/audit/fees/dec_2014.pdf') ?>" target="_blank"><span class="glyphicon glyphicon-download"></span> Tuition fee details for Dec 2014</a>
    <a class="list-group-item" href="<?php echo base_url('assets/downloads/omaha/winter/rules.pdf') ?>" target="_blank"> <span class="glyphicon glyphicon-download"></span> Hostel fee details for Dec 2014</a>

</div>
<!-- RO states from here -->
<div id = "ro" style = "display:none;">
    <?php
    $ch = curl_init("http://172.20.0.202/nitw_prm/archiveNews.aspx");
    curl_exec($ch);
        //echo $ch;
    curl_close($ch);
    ?>
</div>
<!-- RO ends here -->
