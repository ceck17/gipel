<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

echo $feedback;

if ($linked_records_qty > 0) {
	$i = 1;
	echo "\t\t\t<table id=\"listeTable\">\r\n" ;
	// parcours du rÃ©sultat de recherche
	foreach($linked_records as $linked_record) {
		// remplissage de la ligne du tableau de rÃ©sultat avec alternance pair/impair
		if (($i % 2) != 0) $result_table = "\t\t\t\t<tr>\r\n";
		else $result_table = "\t\t\t\t<tr class=\"alt\">\r\n";
		$result_table .= "\t\t\t\t\t<td style=\"width:40px;text-align: center;\">" . $i . "</td>\r\n";
		$uid = $linked_record['uid'];
		$result_table .= "\t\t\t\t\t<td style=\"width:280px\"><a href=\"".base_url('index.php/records/detail/'.$uid)."\" title=\"".lang('action_show_detail')."\">" . $linked_record['first_name'] . " " . $linked_record['last_name'] . "</a></td>\r\n";
		$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><a href=\"".base_url('index.php/records/edit/'.$uid)."\" title=\"".lang('action_edit')."\"><img src=\"".base_url('resource/img/actions/edit.png')."\" height=\"24\" width=\"44\" alt=\"edit\" /></a></td>\r\n";
		
		$result_table .= "\t\t\t\t</tr>\r\n";
		
		echo $result_table;
		
		$i++ ;
	}
	echo "\t\t\t</table>\r\n" ;
}

$this->load->view('templates/footer');







