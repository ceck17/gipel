<?php 

$this->load->view('templates/header', $bandeau);


?>
			<p class="fbox error"><?php echo lang('error_forbidden_access') ; ?></p>
<?php 

$this->load->view('templates/footer');



