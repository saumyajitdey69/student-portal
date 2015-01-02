<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3>Select Profile Photo</h3>
        <?php if($error) :?>
            <ul><li><strong>Error uploading an Image!</strong></li><li><?php echo $error ;?></li></ul>
        <?php endif ;?>

        <?php if($large_photo_exists && $thumb_photo_exists) :?>
            <?php echo $large_photo_exists."&nbsp;".$thumb_photo_exists; ?>
            <p align="center"><a href="<?php echo base_url('upload');?>"><b>Back</b></a></p>

        <?php elseif($large_photo_exists && $thumb_photo_exists == NULL) :?>
 
            <?php
            $this->load->library('upload');
            $data['img']  = $this->upload->data();

            if ($data['img']['file_name'] != NULL)
            {
                echo 'Upload : '.$data['img']['file_name'];
            }
            ?>
            <p>To crop this image, click and drag the region below and then click "Set as Profile photo"</p>
            <img class="img img-responsive col-sm-9 col-xs-12" src="<?php echo base_url($upload_path.$img['file_name']);?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />

            <div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
                <img class="img img-responsive" src="<?php echo base_url() . $upload_path.$img['file_name'];?>" style="position: relative;" alt="Thumbnail Preview" />
            </div>
            <br style="clear:both;"/>
            <form name="thumbnail" action="<?php echo base_url('upload');?>" method="post">
                <input type="text" name="x1" value="" id="x1" />
                <input type="text" name="y1" value="" id="y1" />
                <input type="text" name="x2" value="" id="x2" />
                <input type="text" name="y2" value="" id="y2" />
                <input type="text" name="file_name" value="<?php echo $img['file_name'] ;?>" /><br><p align="center">
                <input type="submit" name="upload_thumbnail" class="btn btn-primary" value="Set as Profile Picture" id="save_thumb" />
                <input type="submit" name="cancel" class="btn btn-primary" value="cancel" id="cancel" /></p>
            </form>


            <hr />
        <?php   else : ?>
            <h3>Upload Image</h3>Maximum Resolution (1024X576)
            <form name="photo" enctype="multipart/form-data" action="<?php echo base_url('upload') ?>" method="post" id="crop-button">
                Select Image <input type="file" name="image" size="30"/> <br><hr><p align="center"><input type="submit" name="upload" class="btn btn-primary" value="Upload" /></p>
            </form>
        <?php   endif ?>
        <script type="text/javascript">
            var thumb_width    = <?php echo $thumb_width ;?> ;
            var thumb_height   = <?php echo $thumb_height ;?> ;
            var image_width    = <?php echo $img['image_width'] ;?> 
            var image_height   = <?php echo $img['image_height'] ;?> 
        </script>
    </div>
</div>

