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
	<script type="text/javascript" src="<?php echo base_url('resource/js/fonctions.js');?>"></script>
<?php if(isset($js)) echo $js; ?>
</head>
<body>
<div id="global">
	<div id="header">
		<table>
			<tr>
				<td style="width:180px"><a href="<?php echo base_url('index.php');?>" title="<?php echo lang('title_home_page');?>"><img src="<?php echo base_url('resource/img/logo.png');?>" height="40" width="180" alt="home" title="<?php echo lang('title_home_page');?>" /></a></td>
				<td style="width:180px">
					<div id="general_search">
						<form method="post" action="<?php echo base_url('index.php/records/find/');?>" name="search_form" id="search_form">
							<input type="text" id="search_string" name="search_string" value="" placeholder="<?php echo lang('label_search');?>" size="16" />
							<input type="submit" id="search_submit" name="search_submit" value="x" />
						</form>
					</div>
				</td>
				<td style="width:32px"><img src="<?php echo base_url('resource/img/clear.gif');?>" width="32"  height="24" alt="clear" /></td>
				<td style="width:44px"><a href="<?php echo base_url('index.php/home/about/');?>" title="<?php echo lang('nav_about_gipel');?>"><img src="<?php echo base_url('resource/img/actions/about.png');?>" width="44"  height="24" alt="about" /></a></td>
<?php 

if ($this->session->userdata('user_id')) {
	// calcul du temps de session restant
	$just_now = date("U");
	$delta = $this->session->userdata('time_limit') - $just_now ;
	$hour = floor($delta / 3600) ;
	$remaining = $delta % 3600 ;
	$minute = floor($remaining / 60) ;
	if ($minute < 10) $minute = "0" . $minute ;
	$seconde = $remaining % 60 ;
	if ($seconde < 10) $seconde = "0" . $seconde ;
	if ($delta > 1800) $remaining_time = "[" . lang('wording_remains') . " " . "$hour H $minute ' $seconde \" ]" ;
	else $remaining_time = "<span class=\"rouge\">" . "[" . lang('wording_remains') . " <strong>" . "$hour H $minute ' $seconde \" </strong>]</span>" ;
	$user_name = $this->session->userdata('user_name');

?>
				<!-- BLOC identification -->
				<td style="width:160px;text-align:right;"><?php echo "<a href=\"" . base_url('index.php/home/edit_my_account/'.$user_name) . "\" title=\"" . lang('action_edit_my_account') . "\">" . $user_name . "</a><br />" . $this->session->userdata('user_rights') . "<br />" . $remaining_time ; ?></td>
				<td style="width:44px"><a href="<?php echo base_url('index.php/home/logout/');?>" title="<?php echo lang('nav_logout');?>"><img src="<?php echo base_url('resource/img/actions/logout.png');?>" width="44"  height="24" alt="logout" /></a></td>
				<!-- #BLOC identification -->
<?php 

} else {

?>
				<!-- BLOC identification -->
				<td style="width:200px;">&nbsp;</td>
				<!-- #BLOC identification -->
<?php 

}

?>
			</tr>
		</table>
	</div><!-- #header -->
	<div id="container">
		<div id="content">
<?php 

// affichage Ã©ventuel du message de feedback
if(($this->session->flashdata('error')) != "") echo "\t\t\t<p class=\"fbox error\">" . $this->session->flashdata('error') . "</p>\r\n" ;
if(($this->session->flashdata('good')) != "") echo "\t\t\t<p class=\"fbox good\">" . $this->session->flashdata('good') . "</p>\r\n" ;
if(($this->session->flashdata('info')) != "") echo "\t\t\t<p class=\"fbox info\">" . $this->session->flashdata('info') . "</p>\r\n" ;
if(($this->session->flashdata('warning')) != "") echo "\t\t\t<p class=\"fbox warning\">" . $this->session->flashdata('warning') . "</p>\r\n" ;








