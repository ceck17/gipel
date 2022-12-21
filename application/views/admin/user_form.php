<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

if ($mode == 'creation') {
	$user_id					= 'not_set';
	$user_username			= '';
	$user_history			= '';
	$read_only				= FALSE;
	$ReadOnly_checked		= TRUE;
	$ReadWrite_checked	= FALSE;
} else {
	$user_id					= $user['user_id'];
	$user_history			= $user['user_history'];
	$user_username			= $user['user_username'];
	$read_only				= TRUE;
	$user_rights			= $user['user_rights'];
	if ($user_rights == 'SuperAdmin') {
		// message d'erreur et fin de la vue
		echo "\t\t\t<p class=\"fbox error\">" . lang('error_admin_not_updatable') . "</p>\r\n";
		$this->load->view('templates/footer');
		exit;
	}
	if ($user_rights == 'ReadWrite') $ReadWrite_checked = TRUE;
	else $ReadWrite_checked = FALSE;
	if ($user_rights == 'ReadOnly') $ReadOnly_checked = TRUE;
	else $ReadOnly_checked = FALSE;
}

// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes, $hidden) avec champs cachÃ©s pour mode, user_id et user_history
echo "\t\t\t" . form_open('admin/save_account/', array('class' => 'formContainer', 'id' => 'user_form'), array('mode' => $mode, 'user_id' => $user_id, 'user_history' => $user_history)) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_user_infos')) . "\r\n" ;

// champ user_username (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_username'), 'user_username', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
if ($read_only === TRUE) {
	echo "\t\t\t\t\t\t" . form_input(array(
		'name' => 'user_username',
		'id' => 'user_username',
		'value' => $user_username,
		'size' => '24',
		'maxlength' => '24',
		'readonly' => 'readonly'
	)) . "\r\n" ;
} else {
	echo "\t\t\t\t\t\t" . form_input(array(
		'name' => 'user_username',
		'id' => 'user_username',
		'value' => $user_username,
		'size' => '24',
		'maxlength' => '24'
	)) . "\r\n" ;
}
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// champ user_rights (radio)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_user_rights'), 'user_rights', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . lang('label_radio_ReadWrite') . form_radio('user_rights', 'ReadWrite', $ReadWrite_checked) . lang('label_radio_ReadOnly') . form_radio('user_rights', 'ReadOnly', $ReadOnly_checked) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// fin du fieldset | champ de validation | fin du formulaire
?>
			</fieldset>
			<div class="buttonsdiv">
				<input type="submit" value="<?php echo lang('label_save'); ?>" />
			</div>
			</form><!--  #Formulaire de saisie -->
			<p><?php if ($mode == 'creation') echo lang('wording_user_creation_infos');?></p>
<?php

$this->load->view('templates/footer');













