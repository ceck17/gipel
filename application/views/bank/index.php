<?php 

$this->load->view('templates/header', $bandeau);

echo $titre ;

?>
			<table style="margin-left:auto;margin-right:auto;">
				<tr>
					<td><a href="<?php echo base_url('index.php/home/about/');?>" title="<?php echo lang('nav_under_construction') ; ?>"><img src="<?php echo base_url('resource/img/nav/menu_bank.png');?>" width="280" height="110" alt="menu_bank" /></a></td>
				</tr>
			</table>
<?php 

$this->load->view('templates/footer');










