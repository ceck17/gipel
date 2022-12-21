<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

$i = 1;
echo "\t\t\t<table id=\"listeTable\">\r\n" ;
// parcours du rÃ©sultat de recherche
foreach($users as $user) {
	$user_id = $user['user_id'] ;
	// remplissage de la ligne du tableau de rÃ©sultat avec alternance pair/impair
	if (($i % 2) != 0) $result_table = "\t\t\t\t<tr>\r\n";
	else $result_table = "\t\t\t\t<tr class=\"alt\">\r\n";
	// numÃ©ro de ligne
	$result_table .= "\t\t\t\t\t<td style=\"width:40px;text-align: center;\">" . $i . "</td>\r\n";
	// identifiant de l'utilisateur avec lien pour afficher ses infos
	$result_table .= "\t\t\t\t\t<td style=\"width:250px\">" . anchor('/admin/user_detail/'.$user_id, $user['user_username'], array('title' => lang('action_show_detail'))) . "</td>\r\n";
	// droits de l'utilisateur
	$result_table .= "\t\t\t\t\t<td style=\"width:100px\">" . $user['user_rights'] . "</td>\r\n";
	// action modifier les droits
	$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><a href=\"".base_url('index.php/admin/set_rights/'.$user_id)."\" title=\"".lang('action_edit')."\"><img src=\"".base_url('resource/img/actions/edit.png')."\" height=\"24\" width=\"44\" alt=\"edit\" /></a></td>\r\n";
	// action supprimer le compte (ouvre une fenÃªtre popup)
	$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/actions/delete.png')."\" alt=\"delete\" width=\"44\" height=\"24\" title=\"".lang('action_delete')."\" onclick=\"popup_delete('" . base_url('index.php/admin/user_delete_request/'.$user_id) . "')\" /></td>\r\n";
	// fin de la ligne
	$result_table .= "\t\t\t\t</tr>\r\n";
	echo $result_table;
	$i++ ;
}
echo "\t\t\t</table>\r\n" ;

$this->load->view('templates/footer');













