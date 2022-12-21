<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>404 Page Not Found</title>
	<style type="text/css">
		
		::selection{ background-color: #E13300; color: white; }
		::moz-selection{ background-color: #E13300; color: white; }
		::webkit-selection{ background-color: #E13300; color: white; }
		
		body {
			background-color: #fff;
			margin: 40px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}
		h1 {
			color: #444;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			text-align: center;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}
		#container {
			width: 250px;
			margin-left: auto;
			margin-right: auto;
			border: 1px solid #D0D0D0;
			-webkit-box-shadow: 0 0 8px #D0D0D0;
		}
		p {
			margin: 12px 10px;
			text-align: justify;
		}
	</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
<?php 

if (function_exists('lang')) {

?>
		<p><?php echo lang('wording_404'); ?></p>
		<p style="text-align: center;"><a href="<?php echo base_url('index.php');?>" title="<?php echo lang('title_home_page');?>"><img src="<?php echo base_url('resource/img/logo.png');?>" height="40" width="180" alt="home" title="<?php echo lang('title_home_page');?>" /></a></p>
<?php 

} else {

	echo $message;

}

?>
	</div>
</body>
</html>




























