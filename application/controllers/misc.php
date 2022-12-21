<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc extends CI_Controller {
	
	// constructeur
	public function __construct() {
		parent::__construct();
		// chargement divers
		$this->load->model('all_model');
		$this->lang->load('gipel');
		
		// contrÃ´le d'accÃ¨s
		if (!$this->control->ask_access()) {
			// utilisateur NON authentifiÃ©
			$curr_uri_string = uri_string();
			if ($curr_uri_string != 'misc/index') {
				redirect('home/login');
			}
		}
		
	}
	
	/* ##################################################################
	----------				PAGE :: ./misc/index					  ----------
	################################################################## */
	public function index() {
		$data['bandeau'] = lang('nav_section_misc');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		// affichage de la vue
		$this->load->view('misc/index', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./misc/calendar					  ----------
	################################################################## */
	public function calendar() {
		$data['bandeau'] = lang('nav_misc_calendar');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		// configuration du calendrier et chargement de la librairie
		$prefs = array (
				'start_day'      => 'monday',
				'month_type'     => 'long',
				'day_type'       => 'short',
				'show_next_prev' => TRUE,
				'next_prev_url'  => base_url('index.php/misc/calendar/')
		);
		$prefs['template'] = '
			{table_open}<table style="margin-left:auto;margin-right:auto;">{/table_open}
			{heading_row_start}<tr>{/heading_row_start}
			{heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
			{heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
			{heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}
			{heading_row_end}</tr>{/heading_row_end}
			{week_row_start}<tr>{/week_row_start}
			{week_day_cell}<td style="width:40px">{week_day}</td>{/week_day_cell}
			{week_row_end}</tr>{/week_row_end}
			{cal_row_start}<tr>{/cal_row_start}
			{cal_cell_start}<td>{/cal_cell_start}
			{cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
			{cal_cell_content_today}<div class="rouge"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
			{cal_cell_no_content}{day}{/cal_cell_no_content}
			{cal_cell_no_content_today}<div class="rouge"><strong>{day}</strong></div>{/cal_cell_no_content_today}
			{cal_cell_blank}&nbsp;{/cal_cell_blank}
			{cal_cell_end}</td>{/cal_cell_end}
			{cal_row_end}</tr>{/cal_row_end}
			{table_close}</table>{/table_close}
		';
		$this->load->library('calendar', $prefs);
		// gÃ©nÃ©ration du calendrier
		$data['content'] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));
		// affichage de la vue
		$this->load->view('misc/screen', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./misc/password					  ----------
	################################################################## */
	public function password() {
		$data['bandeau'] = lang('nav_misc_password');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		$data['content'] = "";
		$random_password = random_string('alnum', 16);
		$data['content'] .= "\t\t\t<h3>" . lang('label_password') . " : " . $random_password . "</h3>";
		$data['content'] .= "\t\t\t<p>md5 (" . lang('label_password') . ") = " . md5($random_password) . "</p>";
		// affichage de la vue
		$this->load->view('misc/screen', $data);
	}
	
	/* ##################################################################
	----------				PAGE :: ./misc/special_chars			  ----------
	################################################################## */
	public function special_chars() {
		$data['bandeau'] = lang('nav_misc_special_chars');
		$data['titre'] = $this->all_model->add_nav_to_title($data['bandeau']);
		
		$data['content'] = '<table id="commonTable">
	<tr style="font-size:0.8em;">
		<td style="width:56px">&amp;aacute;</td>
		<td style="width:56px">&amp;agrave;</td>
		<td style="width:56px">&amp;acirc;</td>
		<td style="width:56px">&amp;aelig;</td>
		<td style="width:56px">&amp;ccedil;</td>
		<td style="width:56px">&amp;eacute;</td>
		<td style="width:56px">&amp;egrave;</td>
		<td style="width:56px">&amp;ecirc;</td>
		<td style="width:56px">&amp;euml;</td>
		<td style="width:56px">&amp;icirc;</td>
	</tr>
	<tr style="font-family:Courier New;font-size:2em;">
		<td align="center">&aacute;</td>
		<td align="center">&agrave;</td>
		<td align="center">&acirc;</td>
		<td align="center">&aelig;</td>
		<td align="center">&ccedil;</td>
		<td align="center">&eacute;</td>
		<td align="center">&egrave;</td>
		<td align="center">&ecirc;</td>
		<td align="center">&euml;</td>
		<td align="center">&icirc;</td>
	</tr>
	<tr style="font-size:0.8em;">
		<td align="center">&amp;Aacute;</td>
		<td align="center">&amp;Agrave;</td>
		<td align="center">&amp;Acirc;</td>
		<td align="center">&amp;AElig;</td>
		<td align="center">&amp;Ccedil;</td>
		<td align="center">&amp;Eacute;</td>
		<td align="center">&amp;Egrave;</td>
		<td align="center">&amp;Ecirc;</td>
		<td align="center">&amp;Euml;</td>
		<td align="center">&amp;Icirc;</td>
	</tr>
	<tr style="font-family:Courier New;font-size:2em;">
		<td align="center">&Aacute;</td>
		<td align="center">&Agrave;</td>
		<td align="center">&Acirc;</td>
		<td align="center">&AElig;</td>
		<td align="center">&Ccedil;</td>
		<td align="center">&Eacute;</td>
		<td align="center">&Egrave;</td>
		<td align="center">&Ecirc;</td>
		<td align="center">&Euml;</td>
		<td align="center">&Icirc;</td>
	</tr>
	<tr style="font-size:0.8em;">
		<td align="center">&amp;ocirc;</td>
		<td align="center">&amp;Oslash;</td>
		<td align="center">&amp;ouml;</td>
		<td align="center">&amp;szlig;</td>
		<td align="center">&amp;ugrave;</td>
		<td align="center">&amp;quot;</td>
		<td align="center">&amp;ldquo;</td>
		<td align="center">&amp;rdquo;</td>
		<td align="center">&amp;lsquo;</td>
		<td align="center">&amp;rsquo;</td>
	</tr>
	<tr style="font-family:Courier New;font-size:2em;">
		<td align="center">&ocirc;</td>
		<td align="center">&Oslash;</td>
		<td align="center">&ouml;</td>
		<td align="center">&szlig;</td>
		<td align="center">&ugrave;</td>
		<td align="center">&quot;</td>
		<td align="center">&ldquo;</td>
		<td align="center">&rdquo;</td>
		<td align="center">&lsquo;</td>
		<td align="center">&rsquo;</td>
	</tr>
	<tr style="font-size:0.8em;">
		<td align="center">&amp;laquo;</td>
		<td align="center">&amp;raquo;</td>
		<td align="center">&amp;amp;</td>
		<td align="center">&amp;copy;</td>
		<td align="center">&amp;divide;</td>
		<td align="center">&amp;gt;</td>
		<td align="center">&amp;lt;</td>
		<td align="center">&amp;micro;</td>
		<td align="center">&amp;middot;</td>
		<td align="center">&amp;para;</td>
	</tr>
	<tr style="font-family:Courier New;font-size:2em;">
		<td align="center">&laquo;</td>
		<td align="center">&raquo;</td>
		<td align="center">&amp;</td>
		<td align="center">&copy;</td>
		<td align="center">&divide;</td>
		<td align="center">&gt;</td>
		<td align="center">&lt;</td>
		<td align="center">&micro;</td>
		<td align="center">&middot;</td>
		<td align="center">&para;</td>
	</tr>
	<tr style="font-size:0.8em;">
		<td align="center">&amp;plusmn;</td>
		<td align="center">&amp;euro;</td>
		<td align="center">&amp;reg;</td>
		<td align="center">&amp;sect;</td>
		<td align="center">&amp;trade;</td>
		<td align="center">&amp;ndash;</td>
		<td align="center">&amp;mdash;</td>
		<td align="center">&amp;alpha;</td>
		<td align="center">&amp;beta;</td>
		<td align="center">&amp;gamma;</td>
	</tr>
	<tr style="font-family:Courier New;font-size:2em;">
		<td align="center">&plusmn;</td>
		<td align="center">&euro;</td>
		<td align="center">&reg;</td>
		<td align="center">&sect;</td>
		<td align="center">&trade;</td>
		<td align="center">&ndash;</td>
		<td align="center">&mdash;</td>
		<td align="center">&alpha;</td>
		<td align="center">&beta;</td>
		<td align="center">&gamma;</td>
	</tr>
	<tr style="font-size:0.8em;">
		<td align="center">&amp;epsilon;</td>
		<td align="center">&amp;theta;</td>
		<td align="center">&amp;pi;</td>
		<td align="center">&amp;rho;</td>
		<td align="center">&amp;sigma;</td>
		<td align="center">&amp;phi;</td>
		<td align="center">&amp;delta;</td>
		<td align="center">&amp;omega;</td>
		<td align="center">&amp;Delta;</td>
		<td align="center">&amp;Omega;</td>
	</tr>
	<tr style="font-family:Courier New;font-size:2em;">
		<td align="center">&epsilon;</td>
		<td align="center">&theta;</td>
		<td align="center">&pi;</td>
		<td align="center">&rho;</td>
		<td align="center">&sigma;</td>
		<td align="center">&phi;</td>
		<td align="center">&delta;</td>
		<td align="center">&omega;</td>
		<td align="center">&Delta;</td>
		<td align="center">&Omega;</td>
	</tr>
</table>';
		
		// affichage de la vue
		$this->load->view('misc/screen', $data);
	}
	
	
}









/* End of file misc.php */
/* Location: ./application/controllers/misc.php */