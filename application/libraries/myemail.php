<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Myemail
{
    protected   $CI;
    protected   $config;

    public function __construct()
    {
        $this->CI =& get_instance();
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'xxx',
            'smtp_pass' => 'xxx',
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1'
        );
        $this->CI->load->library('email');
    }

    public function send($details)
    {
        $details['from'] = 'wsdc.nitw@gmail.com';
        $details['fromName'] = 'WSDC NITW';
        $this->CI->email->clear();
        $this->CI->email->from($details['from'], $details['fromName']);
        $this->CI->email->to($details['to']);
        $this->CI->email->reply_to('wsdc.nitw@gmail.com', 'WSDC');
        // $this->CI->email->bcc('gopkarthik@gmail.com');
        $this->CI->email->subject($details['subject']);
        $this->CI->email->message($details['message']);
        $this->CI->email->send();
        return true;
        return $CI->email->print_debugger();
    }



}

/* End of file email.php */
/* Location: ./application/libraries/email.php */
