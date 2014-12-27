<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Hostel
*
* Author: Vaibhav Awachat
*		  awachat11vaibhav@gmail.com
*         @vaibhavawachat
*
* Added Awesomeness: Anik Das
*
* Location: http://172.20.0.35:10101/wsdc/student-portal
*
*
* Description:  Access the hostel, mess and transaction summary of all the student
* Requirements: PHP5 or above
*
* Dependencies: profile module
*
*/

class Student{

	public function __construct()
	{
		// parent::__construct();
		$this->load->model('hostels/studentmodel');
		$this->load->config('hostels/hostels_config',  TRUE);
		$this->tables = $this->config->item('tables', 'hostels_config');
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 **/
	public function __call($method, $arguments)
	{
		if (!method_exists( $this->studentmodel, $method) )
		{
			throw new Exception('Undefined method Student::' . $method . '() called');
		}

		return call_user_func_array( array($this->studentmodel, $method), $arguments);
	}

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}

	public function details($input_column = array(), $limit = '1', $json = FALSE, $array = TRUE, $output_column = '', $order = 'room asc, registration_number asc')
	{
		if(empty($input_column))
		{
			// student profile api
			$this->load->model('profile/profile_model', 'profile_model', TRUE);
			$raw_data = $this->profile_model->get(array('id' => $this->user_id), TRUE, 'registration_number');
		  	$input_column['registration_number'] = $raw_data['registration_number'];
		}
		return $this->studentmodel->_get( $input_column, $this->tables['student_details'], 'Students details are not available.', $limit, $json, $array, $output_column, $order );
	}

	public function messtransactions($input_column = array(), $limit = FALSE, $json = FALSE, $array = TRUE, $output_column = 'bank_reference_no, transaction_date, registration_number, roll_number, mess_dues, mess_advance, seatrent, emc, maintenance_charges, amount as total, transaction_type, uploaded_by', $order = 'transaction_date asc')
	{
		return $this->studentmodel->_get($input_column, $this->tables['messtransactions'], 'Transactions are not available. <i>State Bank Collect (former i-collect), NEFT and Intra/Inter Bank transfer</i> transactions takes 1-2 working days for approval.', $limit, $json, $array, $output_column, $order);
	}

	public function consolidated_payment($input_column = array(), $limit = FALSE, $json = FALSE, $array = TRUE, $output_column = '*', $order = 'timestamp asc')
	{
		return $this->studentmodel->_get($input_column, $this->tables['studentpayments'], 'Transactions are not available. <i>State Bank Collect (former i-collect), NEFT and Intra/Inter Bank transfer</i> transactions takes 1-2 working days for approval.', $limit, $json, $array, $output_column, $order);
	}
}