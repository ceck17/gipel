<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

$i = 1;
echo "\t\t\t<table id=\"listeTable\">\r\n" ;
echo "\t\t\t\t<tr>\r\n";
echo "\t\t\t\t\t<th style=\"width:40px;text-align: center;\">nÂ°</th>\r\n";
echo "\t\t\t\t\t<th style=\"width:150px\">" . lang('info_ip_address') . "</th>\r\n";
echo "\t\t\t\t\t<th style=\"width:180px\">" . lang('info_last_activity') . "</th>\r\n";
echo "\t\t\t\t</tr>\r\n";
// parcours du rÃ©sultat de recherche
foreach($sessions as $session) {
	$session_id = $session['session_id'] ;
	// remplissage de la ligne du tableau de rÃ©sultat avec alternance pair/impair
	if (($i % 2) != 0) $result_table = "\t\t\t\t<tr>\r\n";
	else $result_table = "\t\t\t\t<tr class=\"alt\">\r\n";
	// numÃ©ro de ligne
	$result_table .= "\t\t\t\t\t<td style=\"text-align: center;\">" . $i . "</td>\r\n";
	// adresse ip de l'utilisateur avec lien pour afficher ses infos
	$result_table .= "\t\t\t\t\t<td>" . anchor('/admin/session_detail/'.$session_id, $session['ip_address'], array('title' => lang('action_show_detail'))) . "</td>\r\n";
	// DerniÃ¨re activitÃ©
	$last_activity = unix_to_human($session['last_activity'] + 7200, TRUE, 'eu');
	$result_table .= "\t\t\t\t\t<td>" . $last_activity . "</td>\r\n";
	// fin de la ligne
	$result_table .= "\t\t\t\t</tr>\r\n";
	echo $result_table;
	$i++ ;
}
echo "\t\t\t</table>\r\n" ;

$this->load->view('templates/footer');













