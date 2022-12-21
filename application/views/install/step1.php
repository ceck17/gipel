			<p>&nbsp;</p>
			<form action="#" method="post" class="formContainer" id="dummy_form">
			<fieldset><legend><?php echo lang('install_legend_db_infos');?></legend>
				<?php echo lang('install_instructions_db_settings');?>
				<table style="margin:auto;">
					<tr><td style="width:190px">$db['default']['hostname'] =</td><td><?php echo $db['hostname'] ?></td></tr>
					<tr><td style="width:190px">$db['default']['username'] =</td><td><?php echo $db['username'] ?></td></tr>
					<tr><td style="width:190px">$db['default']['password'] =</td><td><?php echo $db['password'] ?></td></tr>
					<tr><td style="width:190px">$db['default']['database'] =</td><td><?php echo $db['database'] ?></td></tr>
				</table>
			</fieldset>
			</form>
			<p>&nbsp;</p>
			<?php echo lang('install_instructions_db_ph2');?>
			<h1><a href="<?php echo base_url('index.php/install/proceed/2/');?>"><img src="<?php echo base_url('resource/img/actions/next.png');?>" width="44" height="24" alt="next" title="<?php echo lang('install_next');?>" /></a></h1>
