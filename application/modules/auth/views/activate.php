<?php
if ($activated === true) {
    ?>
    <p>Successfully activated account. Login <a href="<?php echo base_url();?>">here.</a></p>
    <?php } else { ?>
    <p>Activation failed.</p>
    <?php echo $message;}
    ?>
