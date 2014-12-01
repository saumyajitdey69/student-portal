<html>
<body>
	<h3><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></h3>
	<p><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></p>
	<p>For doubts contact: wsdc.nitw@gmail.com</p>

	<p>Regards</p>
	<p>WSDC, NITW</p>
</body>
</html>