<?php 

$this->load->view('templates/header', $bandeau);

// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes)
echo "\t\t\t" . form_open('home/login/', array('class' => 'formContainer', 'id' => 'login_form')) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_login')) . "\r\n" ;

/*
 * 		le formulaire renvoie vers la fonction check_login() de la lib control.php
 */

// champ Identifiant (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_username'), 'user_username', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_username',
	'id' => 'user_username',
	'value' => '',
	'size' => '32',
	'maxlength' => '32',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// champ Mot de passe (password)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_password'), 'user_password', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_password',
	'id' => 'user_password',
	'value' => '',
	'type' => 'password',
	'size' => '32',
	'maxlength' => '32',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// fin du fieldset | champ de validation | fin du formulaire
?>
			</fieldset>
			<div class="buttonsdiv">
				<input type="submit" value="<?php echo lang('label_send');?>" />
			</div>
			</form><!--  #Formulaire de saisie -->
<?php

$this->load->view('templates/footer');








