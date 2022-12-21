<?php 

$this->load->view('templates/header', $bandeau);

?>
			<!--
			<h1>Home page</h1>
			-->
			<table style="margin-left: auto;margin-right: auto;">
				<tr>
					<td><a href="<?php echo base_url('index.php/records/');?>" title="<?php echo lang('nav_section_records') ; ?>"><img src="<?php echo base_url('resource/img/nav/menu_records.png');?>" width="280" height="110" alt="menu_records" /></a></td>
					<td><a href="<?php echo base_url('index.php/misc/');?>" title="<?php echo lang('nav_section_misc') ; ?>"><img src="<?php echo base_url('resource/img/nav/menu_misc.png');?>" width="280" height="110" alt="menu_misc" /></a></td>
				</tr>
<?php 

if ($this->session->userdata('user_rights') == "SuperAdmin") {

?>
				<tr>
					<td><a href="<?php echo base_url('index.php/admin/');?>" title="<?php echo lang('nav_section_admin') ; ?>"><img src="<?php echo base_url('resource/img/nav/menu_admin.png');?>" width="280" height="110" alt="menu_admin" /></a></td>
					<td><a href="<?php echo base_url('index.php/bank/');?>" title="<?php echo lang('nav_section_bank') ; ?>"><img src="<?php echo base_url('resource/img/nav/menu_bank.png');?>" width="280" height="110" alt="menu_bank" /></a></td>
				</tr>
<?php 

}

?>
			</table>
<?php 

$this->load->view('templates/footer');













