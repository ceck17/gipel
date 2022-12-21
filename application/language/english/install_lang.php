<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* ##################################################################
----------		LANGUAGE :: install_lang [en = english]	  ----------
----------		version  :: 2013-10-26							  ----------
################################################################## */

$lang['error_tables_creation']							= "An error occured creating the database tables !";
$lang['info_tables_creation']								= "Database tables were created successfully !";
$lang['info_the_superadmin_account']					= "The Â« SuperAdmin Â» account <strong>";

$lang['install_instructions_db_ph2']					= "<p>If you have created your database (manually using phpMyAdmin), with Â« utf8_general_ci Â» collation, you can click on the link below to launch automatically the creation of your tables.</p>";
$lang['install_instructions_db_settings']				= "<p><strong>Please verifiy the settings</strong> you have defined in the file<br /><em>./application/config/database.php</em><br />to connect to your database :</p>";
$lang['install_instructions_config_settings']		= "<span class=\"rouge\"><strong>IMPORTANT : </strong></span><br />Before you start using GIPel, you must manually edit the configuration variables that follow :";

$lang['install_legend_db_infos']							= "Database information";

$lang['install_next']										= "Next step";

$lang['install_phase1']										= "Installation : phase 1";
$lang['install_phase2']										= "Installation : phase 2";
$lang['install_phase3']										= "Installation : phase 3";

$lang['install_ph1_title']									= "Configuration and creation of the database";
$lang['install_ph2_title']									= "Creating MySQL tables and the administrator account";
$lang['install_ph3_title']									= "Creating administrator account and end";

$lang['legende_superadmin_infos']						= "Administrator information";






/* End of file install_lang.php */
/* Location: ./application/language/english/install_lang.php */