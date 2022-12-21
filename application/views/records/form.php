<?php 

$this->load->view('templates/header', $bandeau);

// rÃ©cupÃ©ration de la catÃ©gorie et de l'identifiant
if ($mode == 'creation') {
	$uid = 'not_set';
	$itemid = $this->uri->segment(3);
} else {
	$uid = $this->uri->segment(3);
	$itemid = $record['itemid'];
}
// affectation des valeurs de champs communs Ã  toutes les catÃ©gories
if($uid == 'not_set'){
	// cas d'une crÃ©ation
	$first_name			= set_value('first_name');
	$memo					= set_value('memo');
	$visibility			= set_value('visibility');
	if ($visibility == 'personal') $personal_checked = TRUE;
	else $personal_checked = FALSE;
	if ($visibility == 'communal') $communal_checked = TRUE;
	else $communal_checked = FALSE;
} else {
	// cas d'une modification
	$first_name			= $record['first_name'];
	$memo					= $record['memo'];
	$visibility			= $record['visibility'];
	if ($visibility == 'personal') $personal_checked = TRUE;
	else $personal_checked = FALSE;
	if ($visibility == 'communal') $communal_checked = TRUE;
	else $communal_checked = FALSE;
}
// acquisition de la liste des groupes
$groupes = $this->records_model->get_groupes($itemid);
// affichage du titre de la page
echo $titre ;
// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes, $hidden) avec champs cachÃ©s pour itemid et uid
echo "\t\t\t" . form_open('records/save/'.$itemid."/".$uid, array('class' => 'formContainer', 'id' => 'record_form'), array('itemid' => $itemid, 'uid' => $uid)) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_record_content')) . "\r\n" ;
// aiguillage en fonction de la catÃ©gorie
switch ($itemid) {
	case "1":
		// acquisition de la liste des pays
		$countries = $this->all_model->get_countries();
		// affectation des valeurs de champs spÃ©cifiques
		if($uid == 'not_set'){
			// cas d'une crÃ©ation
			$title			= set_value('title');
								if ($title == 'miss') $miss_checked = TRUE;
								else $miss_checked = FALSE;
								if ($title == 'mr') $mr_checked = TRUE;
								else $mr_checked = FALSE;
								if ($title == 'mrs') $mrs_checked = TRUE;
								else $mrs_checked = FALSE;
			$groupid			= set_value('groupid', 10001);
			$last_name		= set_value('last_name');
			$adress1			= set_value('adress1');
			$adress2			= set_value('adress2');
			$postcode		= set_value('postcode');
			$city				= set_value('city');
			$country_id		= set_value('country_id', 173);
			$phone_home		= set_value('phone_home');
			$phone_work		= set_value('phone_work');
			$phone_cell		= set_value('phone_cell');
			$fax				= set_value('fax');
			$email			= set_value('email');
			$gmap				= set_value('gmap');
			$birthday		= set_value('birthday');
			// visibility par dÃ©faut
			if ($visibility == '') $communal_checked = TRUE;
		} else {
			// cas d'une modification
			$title			= $record['title'];
								if ($title == lang('label_radio_miss')) $miss_checked = TRUE;
								else $miss_checked = FALSE;
								if ($title == lang('label_radio_mr')) $mr_checked = TRUE;
								else $mr_checked = FALSE;
								if ($title == lang('label_radio_mrs')) $mrs_checked = TRUE;
								else $mrs_checked = FALSE;
			$groupid			= $record['groupid'];
			$last_name		= $record['last_name'];
			$adress1			= $record['adress1'];
			$adress2			= $record['adress2'];
			$postcode		= $record['postcode'];
			$city				= $record['city'];
			$country_id		= $record['country_id'];
			$phone_home		= $record['phone_home'];
			$phone_work		= $record['phone_work'];
			$phone_cell		= $record['phone_cell'];
			$fax				= $record['fax'];
			$email			= $record['email'];
			$gmap				= $record['gmap'];
			$birthday		= $record['birthday'];
		}
		// champ title (radio)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_title'), 'title', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . lang('label_radio_miss') . form_radio('title', 'miss', $miss_checked) . " &nbsp; &nbsp; " . lang('label_radio_mrs') . form_radio('title', 'mrs', $mrs_checked) . " &nbsp; &nbsp; " . lang('label_radio_mr') . form_radio('title', 'mr', $mr_checked) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ PrÃ©nom (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_first_name'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => $first_name,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
//		)) . "<img src=\"".base_url('resource/img/actions/add.png')."\" height=\"24\" width=\"44\" alt=\"vide\" />\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('first_name') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Nom (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_last_name'), 'last_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'last_name',
			'id' => 'last_name',
			'value' => $last_name,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('last_name') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ birthday (date)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_birthday'), 'birthday', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'birthday',
			'id' => 'birthday',
			'type' => 'date',
			'placeholder' => 'AAAA/MM/JJ',
			'value' => $birthday,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ select pour le groupe (select)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_group'), 'groupid', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_dropdown('groupid', $groupes, $groupid) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
	//			echo "\t\t\t\t<img src=\"".base_url('resource/img/actions/add.png')."\" height=\"24\" width=\"44\" alt=\"vide\" /></div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ adress1 (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_adress1'), 'adress1', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'adress1',
			'id' => 'adress1',
			'value' => $adress1,
			'size' => '32',
			'maxlength' => '64',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ adress2 (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_adress2'), 'adress2', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'adress2',
			'id' => 'adress2',
			'value' => $adress2,
			'size' => '32',
			'maxlength' => '64',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ postcode (number)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_postcode'), 'postcode', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'postcode',
			'id' => 'postcode',
			'type' => 'number',
			'value' => $postcode,
			'size' => '8',
			'maxlength' => '8',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ city (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_city'), 'city', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'city',
			'id' => 'city',
			'value' => $city,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ select pour le pays (select)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_country'), 'country_id', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_dropdown('country_id', $countries, $country_id) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ phone_home (tel)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_phone_home'), 'phone_home', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'phone_home',
			'id' => 'phone_home',
			'type' => 'tel',
			'value' => $phone_home,
			'size' => '24',
			'maxlength' => '24',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ phone_work (tel)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_phone_work'), 'phone_work', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'phone_work',
			'id' => 'phone_work',
			'type' => 'tel',
			'value' => $phone_work,
			'size' => '24',
			'maxlength' => '24',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ phone_cell (tel)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_phone_cell'), 'phone_cell', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'phone_cell',
			'id' => 'phone_cell',
			'type' => 'tel',
			'value' => $phone_cell,
			'size' => '24',
			'maxlength' => '24',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ fax (tel)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_fax'), 'fax', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'fax',
			'id' => 'fax',
			'type' => 'tel',
			'value' => $fax,
			'size' => '24',
			'maxlength' => '24',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ email (email)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_email'), 'email', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'email',
			'id' => 'email',
			'type' => 'email',
			'value' => $email,
			'size' => '32',
			'maxlength' => '255',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('email') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ gmap (url)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_gmap'), 'gmap', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'gmap',
			'id' => 'gmap',
			'type' => 'url',
			'value' => $gmap,
			'size' => '32',
			'maxlength' => '2048',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
	break;
	case "2":
		// affectation des valeurs de champs spÃ©cifiques
		if($uid == 'not_set'){
			// cas d'une crÃ©ation
			$groupid				= set_value('groupid', 10034);
			// visibility par dÃ©faut
			if ($visibility == '') $communal_checked = TRUE;
		} else {
			// cas d'une modification
			$groupid				= $record['groupid'];
		}
		// champ Titre pour la note (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_note_title'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => $first_name,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('first_name') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ select pour le groupe
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_group'), 'groupid', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_dropdown('groupid', $groupes, $groupid) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
	//	echo "\t\t\t\t\t<img src=\"".base_url('resource/img/actions/add.png')."\" height=\"24\" width=\"44\" alt=\"vide\" />\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ textarea pour la note
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_textarea(array(
			'name' => 'memo',
			'id' => 'memo',
			'value' => $memo,
			'wrap' => 'hard',
			'rows' => '10',
			'cols' => '80',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('memo') . "\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
	break;
	case "3":
		// affectation des valeurs de champs spÃ©cifiques
		if($uid == 'not_set'){
			// cas d'une crÃ©ation : groupe et visibility par dÃ©faut
			$groupid				= set_value('groupid', 10030);
			if ($visibility == '') $communal_checked = TRUE;
			$last_name			= set_value('last_name');
			$birthday			= set_value('birthday');
			$url					= set_value('url');
			$width				= set_value('width', 800);
			$height				= set_value('height', 400);
			
		} else {
			// cas d'une modification
			$groupid				= $record['groupid'];
			$last_name			= $record['last_name'];
			$birthday			= $record['birthday'];
			$url					= $record['url'];
			$width				= $record['width'];
			$height				= $record['height'];
			
		}
		// champ Nom du document (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_doc_name'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => $first_name,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('first_name') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Version du document (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_doc_version'), 'last_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'last_name',
			'id' => 'last_name',
			'value' => $last_name,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Date de parution (date)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_doc_date'), 'birthday', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'birthday',
			'id' => 'birthday',
			'type' => 'date',
			'placeholder' => 'AAAA/MM/JJ',
			'value' => $birthday,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Groupe (select)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_group'), 'groupid', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_dropdown('groupid', $groupes, $groupid) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
	//			echo "\t\t\t\t<img src=\"".base_url('resource/img/actions/add.png')."\" height=\"24\" width=\"44\" alt=\"vide\" /></div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ url du document (url)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_doc_url'), 'url', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'url',
			'id' => 'url',
			'type' => 'url',
			'value' => $url,
			'size' => '32',
			'maxlength' => '2048',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('url') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Largeur pop-up (number)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_popup_width'), 'width', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'width',
			'id' => 'width',
			'type' => 'number',
			'value' => $width,
			'size' => '8',
			'maxlength' => '4',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Hauteur pop-up (number)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_popup_height'), 'height', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'height',
			'id' => 'height',
			'type' => 'number',
			'value' => $height,
			'size' => '8',
			'maxlength' => '4',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
	break;
	case "4":
		// affectation des valeurs de champs spÃ©cifiques
		if($uid == 'not_set'){
			// cas d'une crÃ©ation : groupe et visibility par dÃ©faut
			$groupid				= set_value('groupid', 10029);
			if ($visibility == '') $personal_checked = TRUE;
			$username			= set_value('username');
			$email				= set_value('email');
			$password			= set_value('password');
			$url					= set_value('url');
			$width				= set_value('width', 800);
			$height				= set_value('height', 400);
		} else {
			// cas d'une modification
			$groupid				= $record['groupid'];
			$username			= $record['username'];
			$email				= $record['email'];
			$password			= $record['password'];
			$url					= $record['url'];
			$width				= $record['width'];
			$height				= $record['height'];
		}
		// champ Nom du site (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_site_name'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => $first_name,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('first_name') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Groupe (select)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_group'), 'groupid', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_dropdown('groupid', $groupes, $groupid) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
	//			echo "\t\t\t\t<img src=\"".base_url('resource/img/actions/add.png')."\" height=\"24\" width=\"44\" alt=\"vide\" /></div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Identifiant1 (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_username'), 'username', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'username',
			'id' => 'username',
			'value' => $username,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Identifiant2 (email)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_user_email'), 'email', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'email',
			'id' => 'email',
			'type' => 'email',
			'value' => $email,
			'size' => '32',
			'maxlength' => '255',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('email') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Mot de passe (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_password'), 'password', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'password',
			'id' => 'password',
			'value' => $password,
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ url du site (url)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_site_url'), 'url', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'url',
			'id' => 'url',
			'type' => 'url',
			'value' => $url,
			'size' => '32',
			'maxlength' => '2048',
		)) . "\r\n" ;
		echo "\t\t\t\t\t\t" . form_error('url') . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Largeur pop-up (number)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_popup_width'), 'width', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'width',
			'id' => 'width',
			'type' => 'number',
			'value' => $width,
			'size' => '8',
			'maxlength' => '4',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// champ Hauteur pop-up (number)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_popup_height'), 'height', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'height',
			'id' => 'height',
			'type' => 'number',
			'value' => $height,
			'size' => '8',
			'maxlength' => '4',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
	break;
}
if ($itemid != 2) {
	// champ textarea (sauf pour la note)
	echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
	echo "\t\t\t\t\t" . form_label(lang('label_memo'), 'memo', $label_attributes) . "\r\n" ;
	echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
	echo "\t\t\t\t\t\t" . form_textarea(array(
		'name' => 'memo',
		'id' => 'memo',
		'value' => $memo,
		'rows' => '5',
		'cols' => '40',
	)) . "\r\n" ;
	echo "\t\t\t\t\t</div>\r\n" ;
	echo "\t\t\t\t</div>\r\n" ;
}
// champ visibility (radio)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_visibility'), 'visibility', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . lang('label_radio_personal') . form_radio('visibility', 'personal', $personal_checked) . lang('label_radio_communal') . form_radio('visibility', 'communal', $communal_checked) . "\r\n" ;
echo "\t\t\t\t\t\t" . form_error('visibility') . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// fin du fieldset | champ de validation | fin du formulaire
?>
			</fieldset>
			<div class="buttonsdiv">
				<input type="submit" value="<?php echo lang('label_validate');?>" />
			</div>
			</form><!--  #Formulaire de saisie -->
<?php

$this->load->view('templates/footer');









