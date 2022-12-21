<?php 

$this->load->view('templates/header', $bandeau);

echo $titre ;

?>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
					<td><a href="<?php echo base_url('index.php/misc/calendar/');?>" title="<?php echo lang('nav_misc_calendar') ; ?>"><img src="<?php echo base_url('resource/img/nav/misc_calendar.png');?>" width="180" height="110" alt="misc_calendar" /></a></td>
					<td><a href="<?php echo base_url('index.php/misc/password/');?>" title="<?php echo lang('nav_misc_password') ; ?>"><img src="<?php echo base_url('resource/img/nav/misc_password.png');?>" width="180" height="110" alt="misc_password" /></a></td>
					<td><a href="<?php echo base_url('index.php/misc/special_chars/');?>" title="<?php echo lang('nav_misc_special_chars') ; ?>"><img src="<?php echo base_url('resource/img/nav/misc_special_chars.png');?>" width="180" height="110" alt="misc_special_chars" /></a></td>
				</tr>
			</table>
<?php 

$this->load->view('templates/footer');










