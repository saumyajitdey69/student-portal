<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php
        if($this->session->flashdata('success') == TRUE)
            echo '<div class="alert alert-success"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('success').'</div>';

        if($this->session->flashdata('warning') == TRUE)
            echo '<div class="alert alert-warning"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('warning').'</div>';

        if($this->session->flashdata('info') == TRUE)
            echo '<div class="alert alert-info"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('info').'</div>';

        if($this->session->flashdata('danger') == TRUE)
            echo '<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>'.$this->session->flashdata('danger').'</div>';
        ?>
        <style type="text/css">
            .imgareaselect-outer {
                background-color: #000;
                opacity: 0.6;
                filter: alpha(opacity=50);
            }
            
        </style>

        <h4 class="text-primary"><strong>Upload Profile Photo</strong></h4>
        <?php if(isset($errors) and !empty($errors)) :?>
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul><li><strong>Error uploading profile picture!</strong></li><li><?php echo $errors ;?></li></ul>
            </div>
        <?php endif ;?>

        <?php if($large_photo_exists && $thumb_photo_exists) :?>
            <div class="alert alert-success">
            Profile picture uploaded successfully.
            </div>
            <?php echo $thumb_photo_exists; ?>
            <?php //echo $large_photo_exists."&nbsp;".$thumb_photo_exists; ?>
            <div class="clearfix">
            
            </div>
            <br>
            For re-uploading the image <a href="<?php echo base_url('upload');?>"><button class="btn btn-sm btn-primary">click here</button></a>
            <hr>
            <span class="text-info">

            <strong>Troubleshooting:</strong>
            <ul>
                <li>Try to logout and then login or use another updated browser.</li>
                <li>Sometime just refreshing the page might work</li>
                <li>Ensure that the image file extension ".jpg" is in lowercase, not it uppercase like ".JPG"</li>
            </ul>
            </span>
        <?php elseif($large_photo_exists && $thumb_photo_exists == NULL) :?>

            <?php
            $this->load->library('upload');
            $data['img']  = $this->upload->data();
            ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <p>To crop this image, click and drag the region (large image) below and then click "Set as Profile photo" (Scroll down)</p>
            </div>
            
            <img src="<?php echo base_url($upload_path.$img['file_name']);?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />

            <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                <img src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
            </div>
            

            <br style="clear:both;"/>
            <form name="thumbnail" action="<?php echo base_url('upload');?>" method="post">
                <input type="hidden" name="x1" value="" id="x1" />
                <input type="hidden" name="y1" value="" id="y1" />
                <input type="hidden" name="x2" value="" id="x2" />
                <input type="hidden" name="y2" value="" id="y2" />
                <input type="hidden" name="file_name" value="<?php echo $img['file_name'] ;?>" /><br><p align="center">
                <input type="submit" name="upload_thumbnail" class="btn btn-primary btn-lg" value="Set as Profile Picture" id="save_thumb" />
                <input type="submit" name="cancel" class="btn btn-danger btn-lg" value="cancel" id="cancel" /></p>
            </form>


            <hr />
        <?php   else : ?>
            <ul>
                <li><strong>Invalid profile pictures will be automatically deleted from the system without any prior notice. Students are requested to follow the instructions carefully and cooperate.</strong></li>
                <li><strong>Upload your profile picture to avoid any inconvenience viewing results, attendance, filling feedback or generating no dues certificate</strong>.</li>
                <li><span class="label label-danger">new</span> File extension must be '.jpg' in lowercase only.</li>
                <li><span class="text-danger">Upload your profile picture. Invalid profile picture may lead to blocking of your results.</span></li>
                <li>Upload a clear scanned/photographed coloured passport size profile picture. Ensure that plain background in image.</li>
                <li>Ensure that 70% of the profile picture filled with your face. </li>
                <li>Only jpg format images are allowed.</li>
                <li>Please note that maximum allowed file size is <strong>4.768 MB (4882.81 KB)</strong> for Microsoft Windows users & <strong>5 MB (5120 KB)</strong> for others.</li>
                <li>Maximum width of picture is <strong>1500 px. (recommended 1024 px)</strong></li>
                <li>Maximum height of picture is <strong>1500 px. (recommended 789 px)</strong></li>
                <li>Profile picture will be used to print new Institute Identity cards (RFID or smartcards), Alumni ID Cards, Mess Card & New TAPS (Training & Placement Section) Web applications.</li>
                <li>ID cards of first year B.Tech students will be replaced with new in next semester.</li>
                <li>Final year students must upload the profile picture carefully, it may appear in some very important documents.</li>
                <li>
                    <i>How to resize image if it exceed maximum dimensions? Or How to reduce image size?</i>
                    <br>Please Google it!
                </li>
                <!-- <li><a href="#" target="_blank">Click here</a> for help & support to upload your profile picture on student portal.</li> -->
            </ul>
            <form class="form" name="photo" enctype="multipart/form-data" action="<?php echo base_url('upload') ?>" method="post" id="crop-button">
              <div class="form-group">
                 <label for="">Select Image</label>  <input type="file" name="image" size="30"/>
             </div>
             <div class="form-group">
                <button type="submit" name="upload" class="btn btn-primary" value="Upload"><span class="glyphicon glyphicon-user"></span> Upload</button>
            </div>
        </form>
    <?php   endif ?>
    <script type="text/javascript">
        var thumb_width    = <?php echo $thumb_width ;?> ;
        var thumb_height   = <?php echo $thumb_height ;?> ;
        <?php if($img['image_width']!=""): ?>
        var image_width    = <?php echo $img['image_width'] ;?> 
        var image_height   = <?php echo $img['image_height'] ;?> 
        <?php endif; ?>
    </script>
</div>
</div>

