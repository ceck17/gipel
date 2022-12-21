<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="<?php echo base_url('resource/favicon.ico');?>">
	<meta name="generator" content="OLPIM - www.ceck.org">
	<meta name="robots" content="noindex, nofollow" />
	<title>forbidden access - <?php echo $this->config->item('appli_site_title'); ?></title>
	<style type="text/css">
		p.fbox{
			background-position: 5px 2px;
			background-repeat: no-repeat;
			width: 320px;
			color: #000;
			padding: 4px 4px 4px 40px;
			border-width: 1px;
			border-style: solid;
			font-family: "Courier New";
			font-size: 12px;
			margin-left: 10px;
		}
		p.fbox.error {
			background-image: url(<?php echo base_url('resource/css/error.png');?>);
			background-color:#FBE6F2;
			border-color:#D893A1;
		}
	</style>
</head>
<body onload="setTimeout('self.close();',10*1000)">
	</p>&nbsp;</p>
	<p class="fbox error"><?php echo lang('error_forbidden_access') ; ?></p>
	</p>&nbsp;</p>
</body>
</html>