<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes, $hidden) avec champ cachÃ© pour itemid
echo "\t\t\t" . form_open('records/deep_find/', array('class' => 'formContainer', 'id' => 'search_form'), array('itemid' => $itemid)) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_search_criteria')) . "\r\n" ;

// acquisition de la liste des groupes
$groupes     = $this->records_model->get_groupes($itemid);
$groupes[10] = lang('search_any_one');
// champ select pour le groupe
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_group'), 'groupid', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_dropdown('groupid', $groupes, 10) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// aiguillage en fonction de la catÃ©gorie
switch ($itemid) {
	case "1":
		// champ PrÃ©nom (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_first_name'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ Nom (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_last_name'), 'last_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'last_name',
			'id' => 'last_name',
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ adress1 (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_adress1'), 'adress1', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'adress1',
			'id' => 'adress1',
			'value' => '',
			'size' => '32',
			'maxlength' => '64',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ postcode (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_postcode'), 'postcode', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'postcode',
			'id' => 'postcode',
			'type' => 'number',
			'value' => '',
			'size' => '8',
			'maxlength' => '8'
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
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		
		// acquisition de la liste des pays
		$countries     = $this->all_model->get_countries();
		$countries[10] = lang('search_any_one');
		// champ select pour le pays (select)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_country'), 'country_id', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_dropdown('country_id', $countries, 10) . "\r\n" ;
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
			'value' => '',
			'size' => '32',
			'maxlength' => '255',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
	break;
	case "2":
		// champ Titre (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_note_title'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
	break;
	case "3":
		// champ Nom du document (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_doc_name'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ URL du document (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_doc_url'), 'url', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'url',
			'id' => 'url',
			'value' => '',
			'size' => '32',
			'maxlength' => '512',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
	break;
	case "4":
		// champ Nom du site (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_site_name'), 'first_name', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'first_name',
			'id' => 'first_name',
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ Identifiant1 (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_username'), 'username', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'username',
			'id' => 'username',
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ Identifiant2 (!!! text !!!)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_user_email'), 'email', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'email',
			'id' => 'email',
			'value' => '',
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
			'value' => '',
			'size' => '32',
			'maxlength' => '32',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
		// champ URL du site (text)
		echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
		echo "\t\t\t\t\t" . form_label(lang('label_site_url'), 'url', $label_attributes) . "\r\n" ;
		echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
		echo "\t\t\t\t\t\t" . form_input(array(
			'name' => 'url',
			'id' => 'url',
			'value' => '',
			'size' => '32',
			'maxlength' => '512',
		)) . "\r\n" ;
		echo "\t\t\t\t\t</div>\r\n" ;
		echo "\t\t\t\t</div>\r\n" ;
	break;
}
// champ memo (note ou commentaire) (text)
if ($itemid == 2) $memo_label = lang('label_note');
else $memo_label = lang('label_comment');
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label($memo_label, 'memo', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'memo',
	'id' => 'memo',
	'value' => '',
	'size' => '32',
	'maxlength' => '128',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ radio pour - sorted_by -
if ($itemid == 1) {
	$first_choice  = " &nbsp;  &nbsp; " . lang('label_first_name')  . form_radio('sorted_by', 'first_name',  FALSE) ;
	$second_choice = " &nbsp;  &nbsp; " . lang('label_last_name')   . form_radio('sorted_by', 'last_name', TRUE) ;
} elseif ($itemid == 2) {
	$first_choice  = " &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; " . lang('label_note_title')  . form_radio('sorted_by', 'first_name',  TRUE) ;
	$second_choice = "";
} elseif ($itemid == 3) {
	$first_choice  = " &nbsp;  &nbsp; &nbsp;  &nbsp; " . lang('label_doc_name')  . form_radio('sorted_by', 'first_name',  TRUE) ;
	$second_choice = "";
} else {
	$first_choice  = " &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; " . lang('label_site_name')  . form_radio('sorted_by', 'first_name',  TRUE) ;
	$second_choice = "";
}
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_sorted_by'), 'sorted_by', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t"  . $first_choice
							. $second_choice
. " &nbsp;  &nbsp; " . lang('label_radio_m_on')  . form_radio('sorted_by', 'maked_on', FALSE)
. " &nbsp;  &nbsp; " . lang('label_radio_r_on')  . form_radio('sorted_by', 'revised_on', FALSE) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ radio pour - direction -
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_direction'), 'direction', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . lang('label_radio_asc')  . form_radio('direction', 'ASC',  TRUE)
                    . lang('label_radio_desc') . form_radio('direction', 'DESC', FALSE) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// fin du fieldset | champ de validation | fin du formulaire
?>
			</fieldset>
			<div class="buttonsdiv">
				<input type="submit" value="<?php echo lang('label_run_search');?>" />
			</div>
			</form><!--  #Formulaire de saisie -->
<?php 

$this->load->view('templates/footer');










