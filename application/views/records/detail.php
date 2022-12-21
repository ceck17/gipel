<?php 

$this->load->view('templates/header', $bandeau); 
echo $titre;
$uid = $record['uid'];

switch ($record['itemid']) {
	case "1":

?>
			<table style="margin-left: auto;margin-right: auto;">
				<tr>
					<td><?php echo $this->all_model->fill_it(135, 2);?></td>
					<td><?php echo $this->all_model->fill_it(2, 2);?></td>
					<td><?php echo $this->all_model->fill_it(260, 2);?></td>
					<td><?php echo $this->all_model->fill_it(200, 2);?></td>
				</tr>
				<tr>
					<td rowspan="3"><?php echo $record['associated_image']; ?></td>
					<td><?php echo $this->all_model->fill_it(2, 26);?></td>
					<!-- cellule des actions -->
<?php 

if ($current_user_rights != "ReadOnly") {

?>
					<td colspan="2" style="background-color:#ffffff;"><img src="<?php echo base_url('resource/img/actions/keywords.png');?>" alt="keywords" width="44" height="24" title="<?php echo lang('wording_keywords') . $record['keywords'] ;?>" onclick="popup_keywords('<?php echo base_url('index.php/records/keywords_edit/'.$uid); ?>')" /><?php echo $this->all_model->fill_it(38);?><a href="<?php echo base_url('index.php/records/edit/'.$uid); ?>" title="<?php echo lang('action_edit');?>"><img src="<?php echo base_url('resource/img/actions/edit.png');?>" height="24" width="44" alt="edit" /></a><?php echo $this->all_model->fill_it(38);?><?php echo $record['bloc_actions']; ?><?php echo $this->all_model->fill_it(38);?><img src="<?php echo base_url('resource/img/actions/delete.png');?>" alt="delete" width="44" height="24" title="<?php echo lang('action_delete');?>" onclick="popup_delete('<?php echo base_url('index.php/records/delete_request/'.$uid); ?>')" /><?php echo $this->all_model->fill_it(38);?><img src="<?php echo base_url('resource/img/actions/histo.png');?>" alt="popup" width="44" height="24" title="<?php echo lang('action_show_history');?>" onclick="popup_history('<?php echo base_url('index.php/records/history/'.$uid); ?>')" /></td>
<?php 

} else {

?>
					<td colspan="2" style="background-color:#ffffff;"><?php echo $this->all_model->fill_it(135);?><?php echo $record['bloc_actions']; ?><?php echo $this->all_model->fill_it(100);?></td>
<?php 

}

?>
				</tr>
				<tr>
					<td><?php echo $this->all_model->fill_it(2, 14);?></td>
					<td style="background-color:#e0e0e0;text-align:center;font-size: 14px;font-weight: bold;"><?php echo $record['groupe']; ?></td>
					<td style="background-color:#e0e0e0;text-align:center;"> contact </td>
				</tr>
				<tr>
					<td><?php echo $this->all_model->fill_it(2, 140);?></td>
					<td style="background-color:#ffffff;padding: 0 8px;"><?php echo $record['bloc_identite']; ?></td>
					<td style="background-color:#ffffff;padding: 0 6px;"><?php echo $record['bloc_contact']; ?></td>
				</tr>
			</table>
			<div id="toggleTriggerDetail"><h4><?php echo lang('wording_see_more');?></h4></div>
			<div id="togglePanelDetail">
				<table>
					<tr>
						<td style="width:180px"><?php echo lang('info_maked_on') . $this->all_model->timestamp_to_date($record['maked_on'], '') ; ?><br /><br /><?php echo lang('info_revised_on') . $this->all_model->timestamp_to_date($record['revised_on'], '[non modifiÃ©]') ; ?><br /><br /><?php echo lang('info_popularity') . $record['clicks']; ?><br /><br /><?php echo lang('info_confidentiality') . $record['visibility']; ?></td>
						<td><textarea style="font-size: 12px;" name="memo" rows="5" cols="55" readonly="readonly"><?php echo $record['memo']; ?></textarea></td>
						
					</tr>
				</table>
			</div>
			<p>&nbsp;</p>
<?php 

	break;
	case "2":

?>
			<table style="margin-left: auto;margin-right: auto;">
				<tr>
					<!-- cellule des actions -->
<?php 

if ($current_user_rights != "ReadOnly") {

?>
					<td style="background-color:#ffffff;"><img src="<?php echo base_url('resource/img/actions/keywords.png');?>" alt="keywords" width="44" height="24" title="<?php echo lang('wording_keywords') . $record['keywords'] ;?>" onclick="popup_keywords('<?php echo base_url('index.php/records/keywords_edit/'.$uid); ?>')" /><?php echo $this->all_model->fill_it(38);?><a href="<?php echo base_url('index.php/records/edit/'.$uid); ?>" title="<?php echo lang('action_edit');?>"><img src="<?php echo base_url('resource/img/actions/edit.png');?>" height="24" width="44" alt="edit" /></a><?php echo $this->all_model->fill_it(38);?><?php echo $record['bloc_actions']; ?><?php echo $this->all_model->fill_it(38);?><img src="<?php echo base_url('resource/img/actions/delete.png');?>" alt="delete" width="44" height="24" title="<?php echo lang('action_delete');?>" onclick="popup_delete('<?php echo base_url('index.php/records/delete_request/'.$uid); ?>')" /><?php echo $this->all_model->fill_it(38);?><img src="<?php echo base_url('resource/img/actions/histo.png');?>" alt="popup" width="44" height="24" title="<?php echo lang('action_show_history');?>" onclick="popup_history('<?php echo base_url('index.php/records/history/'.$uid); ?>')" /></td>
<?php 

} else {

?>
					<td colspan="2" style="background-color:#ffffff;"><?php echo $this->all_model->fill_it(135);?><?php echo $record['bloc_actions']; ?><?php echo $this->all_model->fill_it(100);?></td>
<?php 

}

?>
				</tr>
			</table>
			<div style="width: 590px;margin-left: auto;margin-right: auto;">
				<textarea style="font-size: 12px;" name="memo" rows="10" cols="80" readonly="readonly"><?php echo $record['memo']; ?></textarea>
			</div>
			<h3><?php echo lang('info_ranked_in_group') . $record['groupe'];?></h3>
			<div id="toggleTriggerDetail"><h4>En voir plus ...</h4></div>
			<div id="togglePanelDetail">
				<div style="height: 60px;width: 400px;margin-left: auto;margin-right: auto;">
					<p class="align_left"><?php echo lang('info_maked_on') . $this->all_model->timestamp_to_date($record['maked_on'], '') ; ?><br /><br /><?php echo lang('info_revised_on') . $this->all_model->timestamp_to_date($record['revised_on'], '[non modifiÃ©]') ; ?></p>
					<p class="align_right"><?php echo lang('info_popularity') . $record['clicks']; ?><br /><br /><?php echo lang('info_confidentiality') . $record['visibility']; ?></p>
				</div>
			</div>
			<p>&nbsp;</p>
<?php 

	break;
	case "3": case "4":

?>
			<table style="margin-left: auto;margin-right: auto;">
				<tr>
					<td><?php echo $this->all_model->fill_it(135, 2);?></td>
					<td><?php echo $this->all_model->fill_it(2, 2);?></td>
					<td><?php echo $this->all_model->fill_it(260, 2);?></td>
					<td><?php echo $this->all_model->fill_it(200, 2);?></td>
				</tr>
				<tr>
					<td rowspan="3"><?php echo $record['associated_image']; ?></td>
					<td><?php echo $this->all_model->fill_it(2, 26);?></td>
					<!-- cellule des actions -->
<?php 

if ($current_user_rights != "ReadOnly") {

?>
					<td colspan="2" style="background-color:#ffffff;"><img src="<?php echo base_url('resource/img/actions/keywords.png');?>" alt="keywords" width="44" height="24" title="<?php echo lang('wording_keywords') . $record['keywords'] ;?>" onclick="popup_keywords('<?php echo base_url('index.php/records/keywords_edit/'.$uid); ?>')" /><?php echo $this->all_model->fill_it(38);?><a href="<?php echo base_url('index.php/records/edit/'.$uid); ?>" title="<?php echo lang('action_edit');?>"><img src="<?php echo base_url('resource/img/actions/edit.png');?>" height="24" width="44" alt="edit" /></a><?php echo $this->all_model->fill_it(38);?><?php echo $record['bloc_actions']; ?><?php echo $this->all_model->fill_it(38);?><img src="<?php echo base_url('resource/img/actions/delete.png');?>" alt="delete" width="44" height="24" title="<?php echo lang('action_delete');?>" onclick="popup_delete('<?php echo base_url('index.php/records/delete_request/'.$uid); ?>')" /><?php echo $this->all_model->fill_it(38);?><img src="<?php echo base_url('resource/img/actions/histo.png');?>" alt="popup" width="44" height="24" title="<?php echo lang('action_show_history');?>" onclick="popup_history('<?php echo base_url('index.php/records/history/'.$uid); ?>')" /></td>
<?php 

} else {

?>
					<td colspan="2" style="background-color:#ffffff;"><?php echo $this->all_model->fill_it(135);?><?php echo $record['bloc_actions']; ?><?php echo $this->all_model->fill_it(100);?></td>
<?php 

}

?>
				</tr>
				<tr>
					<td><?php echo $this->all_model->fill_it(2, 14);?></td>
					<td style="background-color:#e0e0e0;text-align:center;font-size: 14px;font-weight: bold;"><?php echo $record['groupe']; ?></td>
					<td style="background-color:#e0e0e0;text-align:center;"><?php echo $record['titre_bloc_complement']; ?></td>
				</tr>
				<tr>
					<td><?php echo $this->all_model->fill_it(2, 140);?></td>
					<td style="background-color:#ffffff;padding: 0 8px;"><?php echo $record['bloc_denomination']; ?></td>
					<td style="background-color:#ffffff;padding: 0 6px;"><?php echo $record['bloc_complement']; ?></td>
				</tr>
			</table>
			<div id="toggleTriggerDetail"><h4><?php echo lang('wording_see_more');?></h4></div>
			<div id="togglePanelDetail">
				<table>
					<tr>
						<td style="width:180px"><?php echo lang('info_maked_on');?><?php echo $this->all_model->timestamp_to_date($record['maked_on'], '') ; ?><br /><br /><?php echo lang('info_revised_on');?><?php echo $this->all_model->timestamp_to_date($record['revised_on'], '[non modifiÃ©]') ; ?><br /><br /><?php echo lang('info_popularity');?><?php echo $record['clicks']; ?><br /><br /><?php echo lang('info_confidentiality');?><?php echo $record['visibility']; ?></td>
						<td><textarea style="font-size: 12px;" name="memo" rows="5" cols="55" readonly="readonly"><?php echo $record['memo']; ?></textarea></td>
						
					</tr>
				</table>
				<p><?php echo lang('info_site_doc_url') . $record['url']; ?></p>
			</div>
			<p>&nbsp;</p>
<?php 

	break;

}

$this->load->view('templates/footer'); 








