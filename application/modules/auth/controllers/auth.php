<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('auth/ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');

		// Load MongoDB library instead of native db driver if required
		$this->config->item('use_mongodb', 'ion_auth') ?
		$this->load->library('mongo_db') :

		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) //remove this elseif if you want to enable this for non-admins
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect('audit/home', 'refresh');
			// return show_error('You must be an administrator to view this page.');
		}
		else
		{
			$data['current_section'] = 'profile';
			$data['current_page'] = 'auth';
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['title'] = "User List";
			//list the users
			$data['users'] = $this->ion_auth->users()->result();
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
			$data['scripts'] = array('auth/jquery.dataTables.js','auth/table.js');
			$data['admin_logged']=$this->ion_auth->is_admin();
			$this->load->model('user_data_model','',TRUE);
			$data['users_info']=$this->user_data_model->get_all_user_data();
			$this->_render_wsdc_page('auth/index',$data);
		}
	}

	public function activation_mail()
	{
		$data['title']='Activation Mail';
		//validate form input
		$this->form_validation->set_rules('email', 'Email', 'required');
		if ($this->form_validation->run() == true)
		{
			$email=$_REQUEST['email'];
			$status=$this->ion_auth->send_activation_mail($email);
			if($status==FALSE)
			{
				$this->session->set_flashdata('danger', 'Activation mail sending failed.<br>Enter registered email-id correctly.');
			}
			else if($status==100)
			{
				$this->session->set_flashdata('warning', 'Account already Activated.<br>Click on forgot password to reset your password.');
			}
			else
			{
				$this->session->set_flashdata('success', 'Activation mail sent.<br>Check your email inbox and spam folder too!!.');

			}
			redirect('auth/login','location', 301);
		}
		else
		{
			$this->_render_page('auth/activation_link',$data);
		}
	}
	//log the user in
	function login()
	{

		$data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('audit/home', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				/*
					Check whether data is available in old portal

				*/
					$this->load->model('import_data');
					$status=$this->import_data->check($this->input->post('identity'),$this->input->post('password'));
					if($status['success']==1)
					{
					//Data found in old portal
						$auth_data=$status['auth_data'];
						$studentData=$status['student_data'];
						// print_r($status);
						//Insert into new auth
						if($status['auth_data']['imported']==0)
						{
						//check if already import has been done
						$group_ids=array('2');//general user
						$username=$this->input->post('identity');
						$password=$this->input->post('password');
						$email=$status['student_data']['email'];
						$additional_data=array(
							'first_name' => $status['student_data']['name'],
							'last_name' => '',
							'registration_number'    => $status['student_data']['registration_number'],
							'phone'      => $status['student_data']['mobile'],
							'roll_number'=>$status['student_data']['roll_number']
							);
						// print_r($additional_data);
						$register_id=$this->ion_auth->register($username, $password, $email, $additional_data,$group_ids,true);
						// echo $register_id;
						if($register_id)
						{
							unset($status['student_data']['userid']);
							unset($status['student_data']['username']);

							unset($status['student_data']['password']);
							unset($status['student_data']['email']);
							unset($status['student_data']['roll_number']);
							unset($status['student_data']['registration_number']);
							$this->load->model('audit/audit_model');
							$this->audit_model->update($register_id,$status['student_data']);
							$this->load->model('import_data');
							$this->import_data->finalize_import($status['auth_data']['userid']);
						}

					}
					// print_r($this->input->post('identity'));
					if($this->ion_auth->login($this->input->post('identity'),$this->input->post('password')))
					{
						//if the login is successful
						//redirect them back to the home page
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('audit/home', 'refresh');
					}

					// return;
				}
				/*Ends
				Show the login error
				*/
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
				);

			$this->_render_page('auth/login', $data);
		}
	}

	//log the user out
	function logout()
	{
		$data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	//change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'class'=>'form-control input-sm',
				'type' => 'password',
				);
			$data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'class'=>'form-control input-sm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
			$data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'class'=>'form-control input-sm',
				'type' => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
				);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
				);
			//render
			$this->_render_wsdc_page('auth/change_password', $data);
		}
		else
		{
			$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		$this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required');
		if ($this->form_validation->run() == false)
		{
			//setup the input
			$data['email'] = array('name' => 'email','class'=>'form-control',
				'id' => 'email',
				);

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth/forgot_password', $data);
		}
		else
		{
			// get identity for that email
			$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			if(empty($identity)) {
				$this->ion_auth->set_message('forgot_password_email_not_found');
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/forgot_password", 'refresh');
			}

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
					'class'=>'form-control',
					'type' => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
					);
				$data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'class'=>'form-control',
					'type' => 'password',
					'pattern' => '^.{'.$data['min_password_length'].'}.*$',
					);
				$data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
					);
				$data['csrf'] = $this->_get_csrf_nonce();
				$data['code'] = $code;

				//render
				$this->_render_page('auth/reset_password', $data);
			}
			else
			{
				// do we have a valid request?
				if ($user->id != $this->input->post('user_id'))
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$data['csrf'] = $this->_get_csrf_nonce();
			$data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_wsdc_page('auth/deactivate_user', $data);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($id != $this->input->post('id'))
				{
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}

			//redirect them back to the auth page
			redirect('auth', 'refresh');
		}
	}

	//create normal user
	public function create_general_user()
	{
		$data['title'] = "Create Account";
		$tables = $this->config->item('tables','ion_auth');
		//validate form input

		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('user_id', $this->lang->line('create_user_validation_userid_label'), 'xss_clean|required|is_unique['.$tables['users'].'.username]');
		$this->form_validation->set_rules('regno', $this->lang->line('create_user_validation_regno_label'), 'xss_clean|required|is_unique['.$tables['student_data'].'.registration_number]');
		$this->form_validation->set_rules('rollno', $this->lang->line('create_user_validation_rollno_label'), 'xss_clean|required|is_unique['.$tables['student_data'].'.roll_number]');
		
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true)
		{
			$username = $this->input->post('user_id');
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');
			// $this->load->model('auth/ion_auth_model', 'chut');
			if($this->ion_auth_model->validate_username($username)==TRUE)
			{
				$this->session->set_flashdata('danger', "Username already exists");
				redirect("auth/create_general_user", 'refresh');
			}

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'registration_number'    => $this->input->post('regno'),
				'phone'      => $this->input->post('phone'),
				'roll_number'=>$this->input->post('rollno')
				);
			$group_ids=array('2');
		}

		if ($this->form_validation->run() == true && ($result=$this->ion_auth->register($username, $password, $email, $additional_data,$group_ids)))
		{
			// check to see if we are creating the user
			// redirect them back to the admin page

			// send the mail
			// $mail_id=$result['email'];
			// $activation_code=$result['activation'];
			// $mailDetails['to'] = $userDetails['email'];
		 //            $mailDetails['subject'] = 'Activation Link';
		 //            $mailDetails['message'] =
		 //            '
		 //            Hi,

		 //            To activate your account click on this '.base_url("auth/activate/".$creationStatus['activationLink']).'
		 //            Or copy paste the following link in the browser: '.base_url("auth/activate/".$creationStatus['activationLink']).'.

		 //            For doubts contact: wsdc.nitw@gmail.com

		 //            Reagers,
		 //            WSDC, NITW';
		 //            $this->load->library('myemail');
		 //            if (($creationStatus['status'] = $this->myemail->send($mailDetails)) !== true) {
		 //                $stat['status'] = "success";
		 //                $stat['message'] = 'Account created. Error sending activation mail.';
		 //            } else {
		 //                $stat['message'] = "Account created. Please activate your account before proceeding further";
		 //            }
		 //    return;
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth/login", 'refresh');
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
				);
			$data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
				);
			$data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
				);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('user_id'),
				);
			$data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
				);
			$data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'class' => 'form-control input-sm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
				);
			$data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'class' => 'form-control input-sm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
				);
			$data['regno'] = array(
				'name'  => 'regno',
				'id'    => 'regno',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('regno'),
				'placeholder'=>'eg:- 123456'
				);
			$data['rollno'] = array(
				'name'  => 'rollno',
				'id'    => 'rollno',
				'class' => 'form-control input-sm',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('rollno'),
				'placeholder'=>'eg:- 123456'
				);
			$this->_render_page('auth/create_general_user', $data);
		}
	}

	//create a new user
	function create_user()
	{
		$data['title'] = "Create User";
		$data['current_page']='new_user';
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$tables = $this->config->item('tables','ion_auth');

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|min_length[10]|xss_clean');
		$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));

			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
				);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
				);
			$data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
				);
			$data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
				);
			$data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company'),
				);
			$data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
				);
			$data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'class' => 'form-control',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
				);
			$data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'class' => 'form-control',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
				);

			$this->_render_wsdc_page('auth/create_user', $data);
		}
	}

	//edit a user
	function edit_user($id)
	{
		$data['title'] = "Edit User";

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'xss_clean');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'xss_clean');
		$this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($id != $this->input->post('id'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'phone'      => $this->input->post('phone'),
				);

			// Only allow updating groups if user is admin
			if ($this->ion_auth->is_admin())
			{
				//Update the groups user belongs to
				$groupData = $this->input->post('groups');

				if (isset($groupData) && !empty($groupData)) {

					$this->ion_auth->remove_from_group('', $id);

					foreach ($groupData as $grp) {
						$this->ion_auth->add_to_group($grp, $id);
					}

				}
			}

			//update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

				$data['password'] = $this->input->post('password');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$this->ion_auth->update($user->id, $data);

				//check to see if we are creating the user
				//redirect them back to the admin page
				$this->session->set_flashdata('message', "User Saved");
				if ($this->ion_auth->is_admin())
				{
					redirect('auth', 'refresh');
				}
				else
				{
					redirect('/', 'refresh');
				}
			}
		}

		//display the edit user form
		$data['csrf'] = $this->_get_csrf_nonce();

		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['user'] = $user;
		$data['groups'] = $groups;
		$data['currentGroups'] = $currentGroups;

		$data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			);
		$data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			);
		$data['company'] = array(
			'name'  => 'company',
			'id'    => 'company',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
			);
		$data['phone'] = array(
			'name'  => 'phone',
			'id'    => 'phone',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
			);
		$data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'class' => 'form-control',
			'type' => 'password'
			);
		$data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'class' => 'form-control',
			'type' => 'password'
			);

		$this->_render_wsdc_page('auth/edit_user', $data);
	}

	// create a new group
	function create_group()
	{
		$data['title'] = $this->lang->line('create_group_title');
		$data['current_page']='new_group';
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('description', $this->lang->line('create_group_validation_desc_label'), 'xss_clean');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		}
		else
		{
			//display the create group form
			//set the flash data error message if there is one
			$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
				);
			$data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
				);

			$this->_render_wsdc_page('auth/create_group', $data);
		}
	}

	//edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('auth', 'refresh');
		}

		$data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		//validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash|xss_clean');
		$this->form_validation->set_rules('group_description', $this->lang->line('edit_group_validation_desc_label'), 'xss_clean');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		//set the flash data error message if there is one
		$data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		//pass the user to the view
		$data['group'] = $group;

		$data['group_name'] = array(
			'name'  => 'group_name',
			'id'    => 'group_name',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_name', $group->name),
			);
		$data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
			);

		$this->_render_page('auth/edit_group', $data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	function _render_wsdc_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $data: $data;
		$data['admin_logged']=$this->ion_auth->is_admin();
		$view_html = array( $this->load->view('base/header', $data, $render),
			$this->load->view('audit/menu/sidebar', $data, FALSE),
			$this->load->view($view, $this->viewdata, $render),
			$this->load->view('base/footer', $data, $render));

		if (!$render) return $view_html;
	}
	function _render_page($view, $data=null, $render=false)
	{
		$this->viewdata = (empty($data)) ? $data: $data;
		$view_html = array(
			$this->load->view('menu/header', $data, $render),
			$this->load->view($view, $this->viewdata, $render),
			$this->load->view('menu/footer', $data, $render)
			);
		if (!$render) return $view_html;
	}

}
