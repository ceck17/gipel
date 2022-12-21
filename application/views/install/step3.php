			<p>&nbsp;</p>
<?php 

// affichage du message de feedback
if($error != "") echo "\t\t\t<p class=\"fbox error\">" . $error . "</p>\r\n" ;
if($good  != "") echo "\t\t\t<p class=\"fbox good\">" . $good . "</p>\r\n" ;

?>
			<p>&nbsp;</p>
			<?php echo lang('install_instructions_config_settings');?>
			<p>&nbsp;</p>
			<h3 style="margin-left: 50px;"><span class="gris_moyen">File ./application/config/</span>autoload.php</h3>
			<textarea style="margin-left: 50px;font-size: 12px;" name="autoload" rows="1" cols="70" readonly="readonly">

$autoload['libraries'] = array('database', 'session', 'control');</textarea>
			<p>&nbsp;</p>
			<h3 style="margin-left: 50px;"><span class="gris_moyen">File ./application/config/</span>config.php</h3>
			<textarea style="margin-left: 50px;font-size: 12px;" name="autoload" rows="3" cols="70" readonly="readonly">
// Session Variables
....................
$config['sess_use_database'] = TRUE;
....................</textarea>
			<p>&nbsp;</p>
			<h4><?php echo lang('title_home_page');?> : <a href="<?php echo base_url('index.php');?>" title="<?php echo lang('title_home_page');?>"><?php echo base_url('index.php');?></a></h4>
			<p>&nbsp;</p>
