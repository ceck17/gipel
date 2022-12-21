<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

$i = 1;
echo "\t\t\t<table id=\"listeTable\">\r\n" ;
// parcours du rÃ©sultat de recherche
foreach($groupes as $groupe) {
	$gid = $groupe['gid'] ;
	// remplissage de la ligne du tableau de rÃ©sultat avec alternance pair/impair
	if (($i % 2) != 0) $result_table = "\t\t\t\t<tr>\r\n";
	else $result_table = "\t\t\t\t<tr class=\"alt\">\r\n";
	// numÃ©ro de ligne
	$result_table .= "\t\t\t\t\t<td style=\"width:40px;text-align: center;\">" . $i . "</td>\r\n";
	// intitulÃ© du groupe
	$result_table .= "\t\t\t\t\t<td style=\"width:250px\">" . $groupe['wording'] . "</td>\r\n";
	// action Ã©diter (ouvre une fenÃªtre popup)
	$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/actions/edit.png')."\" alt=\"edit\" width=\"44\" height=\"24\" title=\"".lang('action_edit')."\" onclick=\"popup_edit('" . base_url('index.php/records/group_edit/'.$gid) . "')\" /></td>\r\n";
	// action supprimer
	$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><a href=\"".base_url('index.php/records/group_delete_request/'.$gid)."\" title=\"".lang('action_delete')."\"><img src=\"".base_url('resource/img/actions/delete.png')."\" height=\"24\" width=\"44\" alt=\"delete\" /></a></td>\r\n";
	// fin de la ligne
	$result_table .= "\t\t\t\t</tr>\r\n";
	echo $result_table;
	$i++ ;
}
echo "\t\t\t</table>\r\n" ;

$this->load->view('templates/footer');




