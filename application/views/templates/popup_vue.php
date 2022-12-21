<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="<?php echo base_url('resource/favicon.ico');?>">
	<meta name="generator" content="OLPIM - www.ceck.org">
	<meta name="robots" content="noindex, nofollow" />
	<title><?php echo $bandeau; ?> - <?php echo $this->config->item('appli_site_title'); ?></title>
	<style type="text/css">
		.entete {
			font-family:Verdana, Arial, Helvetica, sans-serif;
			font-size: 16px;
			font-weight: bold;
			line-height: 18px;
			color: #222222;
			padding-left: 20px;
		}
		.prose {
			font-family: "Courier New";
			font-size: 12px;
			color: #000000;
			padding-left: 20px;
		}
		.gris {
			color: #aaaaaa;
		}
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
		p.fbox.good {
			background-image: url(<?php echo base_url('resource/css/good.png');?>);
			background-color: #E6FBF2;
			border-color: #93D8A1;
		}
		p.fbox.info {
			background-image: url(<?php echo base_url('resource/css/info.png');?>);
			background-color: #E6FBF2;
			border-color: #93D8A1;
		}
		p.fbox.warning {
			background-image: url(<?php echo base_url('resource/css/warning.png');?>);
			background-color:#FBE6F2;
			border-color:#D893A1;
		}
<?php if (isset($css)) echo $css; ?>
	</style>
</head>
<?php 

echo $body_tag;

echo $titre;

echo $corps;

echo "</body>\r\n</html>";










