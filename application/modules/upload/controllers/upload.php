<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload/image_moo') ;
	}

	public function index() {

		$data['current_page'] = 'image-upload';
		$data['upload_path']        = $upload_path          = "assets/upload/real/" ;
		$data['destination_thumbs'] = $destination_thumbs   = "assets/upload/thumbs/" ;

		$data['large_photo_exists'] = $data['thumb_photo_exists'] = $data['error'] = NULL ;
		$data['thumb_width']        = "100";
		$data['thumb_height']       = "100";


		if (!empty($_POST['upload'])) {

			$config['overwrite']   = TRUE;
			//$config['maintain_ratio']    = TRUE;
			$config['upload_path']  = $upload_path ;
			$config['allowed_types']= 'jpg';
			$config['max_size']     = '5000';
			$config['max_width']    = '1500';
			$config['max_height']   = '1500';
			$config['file_name'] = $this->user_name;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload("image")) {
				$img = $data['img']	 = $this->upload->data();
				$url = $data['large_photo_exists']  = "<img src=\"".base_url() . $upload_path.$data['img']['file_name']."\" alt=\"Large Image\"/>";
			}
		}

		elseif (!empty($_POST['upload_thumbnail'])) {
			$x1 = $this->input->post('x1',TRUE) ;
			$y1 = $this->input->post('y1',TRUE) ;
			$x2 = $this->input->post('x2',TRUE) ;
			$y2 = $this->input->post('y2',TRUE) ;
			$w  = $this->input->post('w',TRUE) ;
			$h  = $this->input->post('h',TRUE) ;

			$file_name = $this->user_name.'.jpg';

			if ($file_name) {
				$this->image_moo
				->load($upload_path . $file_name)
				->crop($x1,$y1,$x2,$y2)
				->save($destination_thumbs . $file_name, $overwrite= TRUE) ;

				if ($this->image_moo->errors) {
					$data['error'] = $this->image_moo->display_errors() ;
				}
				else {
					$data['thumb_photo_exists'] = "<img src=\"".base_url() . $destination_thumbs . $file_name."\" alt=\"Thumbnail Image\"/>";
					$data['large_photo_exists'] = "<img src=\"".base_url() . $upload_path.$file_name."\" alt=\"Large Image\"/>";
				}
			}

		}


        $this->load->library('upload');
		$data['img']  = $this->upload->data();
        $data['scripts'] = array('upload/jquery.imgareaselect.min.js', 'upload/jquery.imgpreview.js');
		$this->_render_page('upload/profile',$data) ;

 
		// Uploading the files the DB
        $this->load->library('upload');
        $data['img']  = $this->upload->data();
        $file_name = $this->user_name.'.jpg';

        if ($data['img']['file_name'] != NULL){
        
        $this->load->model("upload_model");
		$newRow = array(
			'Filename' => $this->user_name,
            'RealImage' => $upload_path. $data['img']['file_name'] ,
            'ThumbImage' => $destination_thumbs. $data['img']['file_name']
		);

		$this->upload_model->insert1($newRow);
        }
		
		
		
    }
    function _render_page($view, $data=null, $render=false)
    {
    	$data['current_section'] = 'audit';
    	$data['admin_logged']=$this->ion_auth->is_admin();
    	$view_html = array(
    		$this->load->view('base/header', $data, $render),
    		$this->load->view('audit/menu/header', $data, $render),
    		$this->load->view($view, $data, $render),
    		$this->load->view('audit/menu/footer', $data, $render),
    		$this->load->view('base/footer', $data, $render)
    		);
    	if (!$render) return $view_html;
    }

}


/* End of file upload.php */
/* Location: ./application/modules/upload/controllers/upload.php */