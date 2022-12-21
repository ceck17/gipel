<?php 

$this->load->view('templates/header', $bandeau);

echo $titre ;

?>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
					<td><a href="<?php echo base_url('index.php/admin/manage_accounts/');?>" title="<?php echo lang('nav_manage_accounts') ; ?>"><img src="<?php echo base_url('resource/img/nav/admin_manage.png');?>" width="180" height="110" alt="admin_manage" /></a></td>
					<td><a href="<?php echo base_url('index.php/admin/create_account/');?>" title="<?php echo lang('nav_create_account') ; ?>"><img src="<?php echo base_url('resource/img/nav/admin_create.png');?>" width="180" height="110" alt="admin_create" /></a></td>
					<td><a href="<?php echo base_url('index.php/admin/who_is_online/');?>" title="<?php echo lang('nav_who_is_online') ; ?>"><img src="<?php echo base_url('resource/img/nav/admin_who_is.png');?>" width="180" height="110" alt="admin_who_is" /></a></td>
				</tr>
			</table>
<?php 

$this->load->view('templates/footer');










