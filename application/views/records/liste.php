<?php 

$this->load->view('templates/header', $bandeau);

// affichage du numÃ©ro de page et de la pagination
if(isset($pagination)) {
	if ($this->uri->segment(2) == 'most') {
		$page = ($this->uri->segment(5, 0) / $qty_per_page) + 1 ;
		$p = $this->uri->segment(5, 0) + 1 ;
	} else {
		$page = ($this->uri->segment(4, 0) / $qty_per_page) + 1 ;
		$p = $this->uri->segment(4, 0) + 1 ;
	}
	if ($total_rows > $qty_per_page) echo $this->all_model->add_nav_to_title($bandeau . " (page : " . $page . " )");
	else echo $titre;
	echo $pagination . "<br />" ;
} else echo $titre;

$i = 1;
echo "\t\t\t<table id=\"listeTable\">\r\n" ;
// parcours du rÃ©sultat de recherche
foreach($records as $record) {
	$uid = $record['uid'] ;
	$itemid = $record['itemid'] ;
	// incrÃ©mentation du compteur de clicks
	
	// recherche de la photo liÃ©e Ã  l'enregistrement ou Ã  dÃ©faut du logo de la catÃ©gorie
	$associated_image = $this->records_model->get_associated_image($itemid, $uid, 'liste');
	// remplissage de la ligne du tableau de rÃ©sultat avec alternance pair/impair
	if(isset($pagination)) $l = $p ;
	else $l = $i ;
	if (($l % 2) != 0) $result_table = "\t\t\t\t<tr>\r\n";
	else $result_table = "\t\t\t\t<tr class=\"alt\">\r\n";
		$result_table .= "\t\t\t\t\t<td style=\"width:40px;text-align: center;\">" . $l . "</td>\r\n";
		$result_table .= "\t\t\t\t\t<td style=\"width:44px\"> &nbsp; " . $associated_image . "</td>\r\n";
		$intitule = $record['first_name'] . " " . $record['last_name'];
		$intitule = character_limiter($intitule, 25);
		$result_table .= "\t\t\t\t\t<td style=\"width:280px\"><a href=\"".base_url('index.php/records/detail/'.$uid)."\" title=\"".lang('action_show_detail')."\">" . $intitule . "</a></td>\r\n";
		// action Ã©diter (commune Ã  toutes les catÃ©gories)
		if ($current_user_rights != "ReadOnly") {
			$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><a href=\"".base_url('index.php/records/edit/'.$uid)."\" title=\"".lang('action_edit')."\"><img src=\"".base_url('resource/img/actions/edit.png')."\" height=\"24\" width=\"44\" alt=\"edit\" /></a></td>\r\n";
		} else {
			$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/clear.gif')."\" height=\"24\" width=\"44\" alt=\"vide\" /></td>\r\n";
		}
		// actions spÃ©cifiques Ã  chaque catÃ©gorie (2 au maximum)
		switch ($itemid) {
			case "1":
				// action impression Ã©tiquette d'expÃ©dition
				$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/actions/print.png')."\" alt=\"print\" width=\"44\" height=\"24\" title=\"".lang('action_print_etic')."\" onclick=\"popup_print_etic('" . base_url('index.php/records/print_etic_exp/'.$uid) . "')\" /></td>\r\n";
				// action plan google map (si disponible)
				if (strlen($record['gmap']) > 10) {
					$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/actions/gmap.png')."\" alt=\"gmap\" width=\"44\" height=\"24\" title=\"".lang('action_show_gmap')."\" onclick=\"popup_gmap('" . $record['gmap'] . "')\" /></td>\r\n";
				} else {
					// cellule vide
					$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/clear.gif')."\" height=\"24\" width=\"44\" alt=\"vide\" /></td>\r\n";
				}
			break;
			case "2":
				// action impression de la note
				$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/actions/print.png')."\" alt=\"print\" width=\"44\" height=\"24\" title=\"".lang('action_print_note')."\" onclick=\"popup_print_note('" . base_url('index.php/records/print_note/'.$uid) . "')\" /></td>\r\n";
				// cellule vide
				$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/clear.gif')."\" height=\"24\" width=\"44\" alt=\"vide\" /></td>\r\n";
			break;
			case "3":
				// action Ouvrir la page en popup
				$result_table .= "\t\t\t\t\t<td style=\"width:44px;cursor: pointer;\"><img src=\"".base_url('resource/img/actions/popup.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_open_popup')."\" onclick=\"popup_site('" . $record['url'] . "', '".$record['width']."', '".$record['height']."')\" /></td>\r\n";
				// action Ouvrir la page dans un nouvel onglet
				$result_table .= "\t\t\t\t\t<td style=\"width:40px\"><a href=\"" . $record['url'] . "\" target=\"_blank\" title=\"".lang('action_open_newtab')."\"><img src=\"".base_url('resource/img/actions/newtab.png')."\" height=\"24\" width=\"44\" alt=\"newtab\" /></a></td>\r\n";
			break;
			case "4":
				// action Ouvrir la page en popup
				$result_table .= "\t\t\t\t\t<td style=\"width:44px;cursor: pointer;\"><img src=\"".base_url('resource/img/actions/popup.png')."\" alt=\"popup\" width=\"44\" height=\"24\" title=\"".lang('action_open_popup')."\" onclick=\"popup_site('" . $record['url'] . "', '".$record['width']."', '".$record['height']."')\" /></td>\r\n";
				// action Ouvrir la page dans un nouvel onglet
				$result_table .= "\t\t\t\t\t<td style=\"width:40px\"><a href=\"" . $record['url'] . "\" target=\"_blank\" title=\"".lang('action_open_newtab')."\"><img src=\"".base_url('resource/img/actions/newtab.png')."\" height=\"24\" width=\"44\" alt=\"newtab\" /></a></td>\r\n";
			break;
		}
		// action supprimer (commune Ã  toutes les catÃ©gories)
		if ($current_user_rights != "ReadOnly") {
			$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/actions/delete.png')."\" alt=\"delete\" width=\"44\" height=\"24\" title=\"".lang('action_delete')."\" onclick=\"popup_delete('" . base_url('index.php/records/delete_request/'.$uid) . "')\" /></td>\r\n";
		} else {
			$result_table .= "\t\t\t\t\t<td style=\"width:44px\"><img src=\"".base_url('resource/img/clear.gif')."\" height=\"24\" width=\"44\" alt=\"vide\" /></td>\r\n";
		}
	$result_table .= "\t\t\t\t</tr>\r\n";
	// extrait du champ textarea
	if (strlen($record['memo']) > 3) {
		if (($l % 2) != 0) $result_table .= "\t\t\t\t<tr>\r\n";
		else $result_table .= "\t\t\t\t<tr class=\"alt\">\r\n";
			$memo = html_escape(character_limiter($record['memo'], 50));
			$result_table .= "\t\t\t\t\t<td style=\"width:40px\">&nbsp</td>\r\n";
			$result_table .= "\t\t\t\t\t<td style=\"width:44px\">&nbsp</td>\r\n";
			$result_table .= "\t\t\t\t\t<td colspan=\"5\" style=\"font-size: 12px;font-style: italic;\">" . $memo . "</td>\r\n";
		$result_table .= "\t\t\t\t</tr>\r\n";
	}
	echo $result_table;
	
	if(isset($pagination)) $p++ ;
	$i++ ;
}

if ($i == 1) echo "\t\t\t\t<tr><td>" . lang('search_nothing_found') . "</td></tr>\r\n" ;
echo "\t\t\t</table>\r\n" ;

// affichage des liens de pagination
if(isset($pagination)) echo "<br />" . $pagination ;

$this->load->view('templates/footer');














