			<p>&nbsp;</p>
<?php 

// affichage du message de feedback
if($error != "") echo "\t\t\t<p class=\"fbox error\">" . $error . "</p>\r\n" ;
if($good  != "") echo "\t\t\t<p class=\"fbox good\">" . $good . "</p>\r\n" ;

echo "\t\t\t<p>&nbsp;</p>\r\n" ;

// affichage du formulaire pour la crÃ©ation du compte administrateur

if ($user_id == 'init') {
	$user_username = '';
} else {
	$user_username = $this->input->post('user_username');
}

// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes, $hidden) avec champ cachÃ© pour user_id
echo "\t\t\t" . form_open('install/proceed/3/', array('class' => 'formContainer', 'id' => 'superadmin_form'), array('user_id' => $user_id)) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_superadmin_infos')) . "\r\n" ;

// champ user_username (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_username'), 'user_username', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
	echo "\t\t\t\t\t\t" . form_input(array(
		'name' => 'user_username',
		'id' => 'user_username',
		'value' => $user_username,
		'size' => '24',
		'maxlength' => '24'
	)) . "\r\n" ;
echo "\t\t\t\t\t\t" . form_error('user_username') . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// champ sa_password Mot de passe (password)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_password'), 'sa_password', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'sa_password',
	'id' => 'sa_password',
	'value' => '',
	'type' => 'password',
	'size' => '24',
	'maxlength' => '16',
)) . "\r\n" ;
echo "\t\t\t\t\t\t" . form_error('sa_password') . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// champ confirm_password Confirmez le (password)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_confirm_it'), 'confirm_password', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'confirm_password',
	'id' => 'confirm_password',
	'value' => '',
	'type' => 'password',
	'size' => '24',
	'maxlength' => '16',
)) . "\r\n" ;
echo "\t\t\t\t\t\t" . form_error('confirm_password') . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;


// fin du fieldset | champ de validation | fin du formulaire
?>
			</fieldset>
			<div class="buttonsdiv">
				<input type="submit" value="<?php echo lang('label_save'); ?>" />
			</div>
			</form>
			<p>&nbsp;</p>
