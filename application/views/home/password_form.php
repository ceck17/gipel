<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

$user = $this->admin_model->get_user_by_id($user_id);

// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes, $hidden) avec champs cachÃ©s pour user_id et user_history
echo "\t\t\t" . form_open('home/save_password/', array('class' => 'formContainer', 'id' => 'password_form'), array('user_id' => $user['user_id'], 'user_history' => $user['user_history'])) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_my_password')) . "\r\n" ;

// champ current_password Mot de passe actuel (password)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_current_password'), 'current_password', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'current_password',
	'id' => 'current_password',
	'value' => '',
	'type' => 'password',
	'size' => '24',
	'maxlength' => '16',
)) . "\r\n" ;
echo "\t\t\t\t\t\t" . form_error('current_password') . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// sÃ©paration
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\"> &nbsp; </div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ new_password Nouveau mot de passe (password)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_new_password'), 'new_password', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'new_password',
	'id' => 'new_password',
	'value' => '',
	'type' => 'password',
	'size' => '24',
	'maxlength' => '16',
)) . "\r\n" ;
echo "\t\t\t\t\t\t" . form_error('new_password') . "\r\n" ;
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
				<input type="submit" value="<?php echo lang('label_update');?>" />
			</div>
			</form><!--  #Formulaire de saisie -->
			<p><?php echo lang('wording_password_informations');?></p>
<?php

$this->load->view('templates/footer');













