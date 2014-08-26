<?php if (!isset($current_section)) { $current_section = ''; } ?>
<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Edit profile of faculty of NITW">
<meta name="author" content="WSDC">
<head>
	<title><?php if(!empty($title)) echo $title; else echo 'WSDC'; ?></title>
	<link href="<?php echo asset_url()."css/flat-bootstrap.min.css" ?> " rel="stylesheet">
	<link href="<?php echo asset_url()."css/introjs.min.css" ?>" rel="stylesheet">
	<link href="<?php echo asset_url()."css/offcanvas.css" ?>" rel="stylesheet">
	 <!-- Notify CSS -->
    <link href="<?php echo asset_url()."css/bootstrap-notify.css" ?>" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="<?php echo asset_url()."css/alert-bangtidy.css" ?>" rel="stylesheet">
    <link href="<?php echo asset_url()."css/alert-blackgloss.css" ?>" rel="stylesheet">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46078676-1', 'nitw.ac.in');
  ga('send', 'pageview');

</script>
</head>
<body>
<div class="col-md-8 col-md-offset-2">
<div class="row">
	<legend>Students who have not submitted their course feedbacks <?php echo $total; ?></legend>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th>Roll No</th>
			<th>Reg No</th>
			<th>Name</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($student_data as $key => $value) {
			?>
		<tr>
			<td><?php  echo $value->roll_number; ?></td>
			<td><?php  echo $value->registration_number; ?></td>
			<td><?php  echo $value->name; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
</div>
</body>
</html>