<?php 

$this->load->view('templates/header', $bandeau);

echo $titre;

$user_array = $this->admin_model->get_user_by_name($username);

echo "\t\t\t<p>&nbsp;</p>\r\n" ;
echo "\t\t\t<h3 style=\"text-align:center\"><span class=\"gris_moyen\">" . lang('label_username') . " : </span>" . $user_array[0]->user_username . " &nbsp; &nbsp; | &nbsp; &nbsp; " . "<a href=\"".base_url('index.php/home/password/'.$user_array[0]->user_id)."\" title=\"".lang('action_change_password')."\">" . lang('action_change_password') . "</a></h3>\r\n" ;
echo "\t\t\t<p>&nbsp;</p>\r\n" ;

// attributs pour les labels
$label_attributes = array('class' => 'styled');
// dÃ©but du formulaire('url', $attributes, $hidden) avec champs cachÃ©s pour user_id, user_username et user_history
echo "\t\t\t" . form_open('home/save_my_account/', array('class' => 'formContainer', 'id' => 'account_form'), array('user_id' => $user_array[0]->user_id, 'user_history' => $user_array[0]->user_history, 'user_username' => $user_array[0]->user_username)) . "\r\n" ;
echo "\t\t\t" . form_fieldset(lang('legende_my_datas')) . "\r\n" ;

// champ user_first_name (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_first_name'), 'user_first_name', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_first_name',
	'id' => 'user_first_name',
	'value' => $user_array[0]->user_first_name,
	'size' => '24',
	'maxlength' => '24',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ user_last_name (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_last_name'), 'user_last_name', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_last_name',
	'id' => 'user_last_name',
	'value' => $user_array[0]->user_last_name,
	'size' => '24',
	'maxlength' => '24',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ user_address (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_adress1'), 'user_address', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_address',
	'id' => 'user_address',
	'value' => $user_array[0]->user_address,
	'size' => '48',
	'maxlength' => '48',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ user_postcode (number)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_postcode'), 'user_postcode', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_postcode',
	'id' => 'user_postcode',
	'type' => 'number',
	'value' => $user_array[0]->user_postcode,
	'size' => '8',
	'maxlength' => '8',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;
// champ user_city (text)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_city'), 'user_city', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_city',
	'id' => 'user_city',
	'value' => $user_array[0]->user_city,
	'size' => '40',
	'maxlength' => '40',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// acquisition de la liste des pays
$countries = $this->all_model->get_countries();
// champ select pour le pays (select)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_country'), 'user_country_id', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_dropdown('user_country_id', $countries, $user_array[0]->user_country_id) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;

// champ email (email)
echo "\t\t\t\t<div class=\"fieldContainer\">\r\n" ;
echo "\t\t\t\t\t" . form_label(lang('label_email'), 'user_email', $label_attributes) . "\r\n" ;
echo "\t\t\t\t\t<div class=\"thefield\">\r\n" ;
echo "\t\t\t\t\t\t" . form_input(array(
	'name' => 'user_email',
	'id' => 'user_email',
	'type' => 'email',
	'value' => $user_array[0]->user_email,
	'size' => '32',
	'maxlength' => '255',
)) . "\r\n" ;
echo "\t\t\t\t\t</div>\r\n" ;
echo "\t\t\t\t</div>\r\n" ;


// fin du fieldset | champ de validation | fin du formulaire
?>
			</fieldset>
			<div class="buttonsdiv">
				<input type="submit" value="<?php echo lang('label_update');?>" />
			</div>
			</form><!--  #Formulaire de saisie -->
			<p><?php echo lang('wording_sender_informations');?></p>
<?php

$this->load->view('templates/footer');













