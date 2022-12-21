<?php 

$this->load->view('templates/header', $bandeau);

if ($this->session->userdata('user_rights') != "ReadOnly") {

?>
			<!--		MENU ADD RECORD		-->
			<div id="toggleTrigger1"><h2><img src="<?php echo base_url('resource/img/actions/add.png');?>" height="24" width="44" alt="add" /><?php echo lang('menu_add_record');?><img src="<?php echo base_url('resource/img/actions/add.png');?>" height="24" width="44" alt="add" /></h2></div>
			<div id="togglePanel1">
				<h2><a href="<?php echo base_url('index.php/records/add/1/');?>" title="<?php echo lang('item_addressbook');?>"><img src="<?php echo base_url('resource/img/item/addressbook.png');?>" height="24" width="44" alt="addressbook" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/add/2/');?>" title="<?php echo lang('item_notebook');?>"><img src="<?php echo base_url('resource/img/item/notebook.png');?>" height="24" width="44" alt="notebook" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/add/3/');?>" title="<?php echo lang('item_document');?>"><img src="<?php echo base_url('resource/img/item/document.png');?>" height="24" width="44" alt="document" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/add/4/');?>" title="<?php echo lang('item_site-login');?>"><img src="<?php echo base_url('resource/img/item/site-login.png');?>" height="24" width="44" alt="site-login" /></a></h2>
			</div>
			<p>&nbsp;</p>
<?php 

}

?>
			<!--		MENU DEEP SEARCH		-->
			<div id="toggleTrigger3"><h2><img src="<?php echo base_url('resource/img/actions/deep_search.png');?>" height="24" width="44" alt="deep_search" /><?php echo lang('menu_deep_search');?><img src="<?php echo base_url('resource/img/actions/deep_search.png');?>" height="24" width="44" alt="deep_search" /></h2></div>
			<div id="togglePanel3">
				<h2><a href="<?php echo base_url('index.php/records/deep_search/1/');?>" title="<?php echo lang('item_addressbook');?>"><img src="<?php echo base_url('resource/img/item/addressbook.png');?>" height="24" width="44" alt="addressbook" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/deep_search/2/');?>" title="<?php echo lang('item_notebook');?>"><img src="<?php echo base_url('resource/img/item/notebook.png');?>" height="24" width="44" alt="notebook" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/deep_search/3/');?>" title="<?php echo lang('item_document');?>"><img src="<?php echo base_url('resource/img/item/document.png');?>" height="24" width="44" alt="document" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/deep_search/4/');?>" title="<?php echo lang('item_site-login');?>"><img src="<?php echo base_url('resource/img/item/site-login.png');?>" height="24" width="44" alt="site-login" /></a></h2>
			</div>
			<p>&nbsp;</p>
<?php 

if ($this->session->userdata('user_rights') == "SuperAdmin") {

?>
			<!--		MENU MANAGE GROUPS		-->
			<div id="toggleTrigger2"><h2><img src="<?php echo base_url('resource/img/actions/groupe.png');?>" height="24" width="44" alt="groupe" /><?php echo lang('menu_manage_groups');?><img src="<?php echo base_url('resource/img/actions/groupe.png');?>" height="24" width="44" alt="groupe" /></h2></div>
			<div id="togglePanel2">
				<h2><a href="<?php echo base_url('index.php/records/group_liste/1/');?>" title="<?php echo lang('item_addressbook');?>"><img src="<?php echo base_url('resource/img/item/addressbook.png');?>" height="24" width="44" alt="addressbook" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/group_liste/2/');?>" title="<?php echo lang('item_notebook');?>"><img src="<?php echo base_url('resource/img/item/notebook.png');?>" height="24" width="44" alt="notebook" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/group_liste/3/');?>" title="<?php echo lang('item_document');?>"><img src="<?php echo base_url('resource/img/item/document.png');?>" height="24" width="44" alt="document" /></a><img src="<?php echo base_url('resource/img/clear.gif');?>" width="80"  height="24" alt="clear" /><a href="<?php echo base_url('index.php/records/group_liste/4/');?>" title="<?php echo lang('item_site-login');?>"><img src="<?php echo base_url('resource/img/item/site-login.png');?>" height="24" width="44" alt="site-login" /></a></h2>
			</div>
			<p>&nbsp;</p>
<?php 

}

?>
			<h1><?php echo $titre; ?></h1>
			<table id="commonTable">
				<tr class="alt">
					<td style="width:230px"><?php echo lang('synthesis_global') . " :<br />" . $total . " " . lang('item_records'); ?></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/recent/0/');?>" title="<?php echo lang('synthesis_most_recent');?>"><img src="<?php echo base_url('resource/img/synthesis/recent_global.png');?>" height="24" width="84" alt="most_recent" /></a></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/visited/0/');?>" title="<?php echo lang('synthesis_most_visited');?>"><img src="<?php echo base_url('resource/img/synthesis/favori_global.png');?>" height="24" width="84" alt="most_visited" /></a></td>
				</tr>
				<tr>
					<td style="width:230px"><?php echo lang('item_addressbook') . " :<br />" . $adr . " " . lang('item_records');?></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/recent/1/');?>" title="<?php echo lang('synthesis_most_recent');?>"><img src="<?php echo base_url('resource/img/synthesis/recent_address.png');?>" height="24" width="84" alt="most_recent" /></a></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/visited/1/');?>" title="<?php echo lang('synthesis_most_visited');?>"><img src="<?php echo base_url('resource/img/synthesis/favori_address.png');?>" height="24" width="84" alt="most_visited" /></a></td>
				</tr>
				<tr class="alt">
					<td style="width:230px"><?php echo lang('item_notebook') . " :<br />" . $note . " " . lang('item_records');?></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/recent/2/');?>" title="<?php echo lang('synthesis_most_recent');?>"><img src="<?php echo base_url('resource/img/synthesis/recent_note.png');?>" height="24" width="84" alt="most_recent" /></a></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/visited/2/');?>" title="<?php echo lang('synthesis_most_visited');?>"><img src="<?php echo base_url('resource/img/synthesis/favori_note.png');?>" height="24" width="84" alt="most_visited" /></a></td>
				</tr>
				<tr>
					<td style="width:230px"><?php echo lang('item_document') . " :<br />" . $doc . " " . lang('item_records');?></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/recent/3/');?>" title="<?php echo lang('synthesis_most_recent');?>"><img src="<?php echo base_url('resource/img/synthesis/recent_doc.png');?>" height="24" width="84" alt="most_recent" /></a></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/visited/3/');?>" title="<?php echo lang('synthesis_most_visited');?>"><img src="<?php echo base_url('resource/img/synthesis/favori_doc.png');?>" height="24" width="84" alt="most_visited" /></a></td>
				</tr>
				<tr class="alt">
					<td style="width:230px"><?php echo lang('item_site-login') . " :<br />" . $wsl . " " . lang('item_records');?></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/recent/4/');?>" title="<?php echo lang('synthesis_most_recent');?>"><img src="<?php echo base_url('resource/img/synthesis/recent_site-login.png');?>" height="24" width="84" alt="most_recent" /></a></td>
					<td style="width:120px"><a href="<?php echo base_url('index.php/records/most/visited/4/');?>" title="<?php echo lang('synthesis_most_visited');?>"><img src="<?php echo base_url('resource/img/synthesis/favori_site-login.png');?>" height="24" width="84" alt="most_visited" /></a></td>
				</tr>
			</table>
<?php 

$this->load->view('templates/footer');