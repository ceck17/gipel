<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="icon" href="<?php echo base_url('resource/favicon.ico');?>">
	<meta name="generator" content="GIPel - www.ceck.org">
	<meta name="robots" content="noindex, nofollow" />
	<title><?php echo $bandeau; ?> - <?php echo $this->config->item('appli_site_title'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resource/css/look_main.css');?>" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('resource/css/look_form.css');?>" />
</head>
<body>
<div id="global">
	<div id="header">
		<table>
			<tr>
				<td style="width:180px"><img src="<?php echo base_url('resource/img/logo.png');?>" height="40" width="180" alt="home" /></td>
				<td style="width:100px"><img src="<?php echo base_url('resource/img/clear.gif');?>" width="100"  height="24" alt="clear" /></td>
				<td style="width:360px;font-size:20px"><?php echo $bandeau; ?></td>
			</tr>
		</table>
	</div><!-- #header -->
	<div id="container">
		<div id="content">
<?php 

// affichage du titre de la page
echo "\r\n\t\t\t<h1 style=\"color:#666;\">" . $titre . "</h1>\r\n" ;

// affichage du contenu de la page
if ($form_validated == 'no') $this->load->view('install/step2', $step2);
elseif ($this->uri->segment(3) == '') $this->load->view('install/step1', $step1);
elseif ($this->uri->segment(3) == '2') $this->load->view('install/step2', $step2);
elseif ($this->uri->segment(3) == '3') $this->load->view('install/step3', $step3);


?>
		</div><!-- #content -->
	</div><!-- #container -->
	<div id="footer">
		<p class="align_left"><a href="http://www.ceck.org/accueil/copyright/">copyright &copy;</a> &nbsp; &nbsp; &nbsp; powered by : <a href="http://ellislab.com/codeigniter">CodeIgniter 2.1.4</a></p><p class="align_right"><?php echo lang('info_page_rendered_in');?>{elapsed_time}<?php echo lang('wording_seconds');?></p>
		<div style="clear: both;"></div>
	</div><!-- #footer -->
</div><!-- #global -->
</body>
</html>