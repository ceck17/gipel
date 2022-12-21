<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_model extends CI_Model {
	// dÃ©claration de variables
	
	public function la_fonction() {
		return '';
	}
	
	public function get_fullrow($table, $id_name, $id) {
		$query = $this->db->get_where($table, array($id_name => $id));
		return $query->row_array();
	}
	
	public function get_field_by_id($table, $field, $id_name, $id) {
		$query = $this->db->get_where($table, array($id_name => $id));
		$row = $query->row_array();
		return $row[$field];
	}
	
	public function add_ligne($table, $data) {
		// insertion dans la table
		$this->db->insert($table, $data);
		// retour de l'id insÃ©rÃ©
		return $this->db->insert_id();
	}
	
	public function update_ligne($table, $data, $id_name, $id) {
		// modification dans la table
		$this->db->where($id_name, $id);
		$this->db->update($table, $data);
		// teste si une modif a Ã©tÃ© faite
		return $this->db->affected_rows();
	}
	
	public function delete_ligne($table, $id_name, $id) {
		// suppression de la table
		$this->db->where($id_name, $id);
		$this->db->limit(1);
		return $this->db->delete($table);
	}
	
	public function increment_field($table, $field, $id_name, $id, $val) {
		$incremente = "UPDATE `$table` SET `$field` = `$field` + $val WHERE `$id_name` = $id LIMIT 1";
		$this->db->query($incremente);
		return $this->db->affected_rows();
	}
	
	
	public function get_countries() {
		$query = $this->db->query("SELECT * FROM `country` ORDER BY `country_fr` ASC");
		foreach ($query->result() as $row) {
			$countries[$row->country_id] = $row->country_fr;
		}
		return $countries;
	}
	
	public function timestamp_to_date($time_stamp, $not_defined) {
		if ($time_stamp < 60) return $not_defined;
		else return date("d M Y", $time_stamp);
	}
	
	function fill_it($width=44, $height=24) {
		$alt = "clear_".$width."x".$height ;
		return "<img src=\"" . base_url('resource/img/clear.gif') . "\" width=\"".$width."\" height=\"".$height."\" alt=\"".$alt."\" />" ;
	}
	
	public function add_nav_to_title($titre) {
		$category = $this->uri->segment(1);
		$nav_title = "\t\t\t<table id=\"navTitleTable\">\r\n\t\t\t\t<tr><td style=\"width:75px;background-color:#f0f0f0;\">";
		if ($this->uri->segment(2) != '') {
			if ($category == 'admin') $nav_title .= "<a href=\"".base_url('index.php/admin/')."\" title=\"".lang('nav_section_admin')."\"><img src=\"" . base_url('resource/img/nav/small_menu_admin.png') . "\" width=\"70\" height=\"36\" alt=\"nav\" /></a></td><td><h1>" . $titre;
			if ($category == 'bank') $nav_title .= "<a href=\"".base_url('index.php/bank/')."\" title=\"".lang('nav_section_bank')."\"><img src=\"" . base_url('resource/img/nav/small_menu_bank.png') . "\" width=\"70\" height=\"36\" alt=\"nav\" /></a></td><td><h1>" . $titre;
			if ($category == 'misc') $nav_title .= "<a href=\"".base_url('index.php/misc/')."\" title=\"".lang('nav_section_misc')."\"><img src=\"" . base_url('resource/img/nav/small_menu_misc.png') . "\" width=\"70\" height=\"36\" alt=\"nav\" /></a></td><td><h1>" . $titre;
			if ($category == 'records') $nav_title .= "<a href=\"".base_url('index.php/records/')."\" title=\"".lang('nav_section_records')."\"><img src=\"" . base_url('resource/img/nav/small_menu_records.png') . "\" width=\"70\" height=\"36\" alt=\"nav\" /></a></td><td><h1>" . $titre;
			if ($category == 'home') $nav_title .= "<a href=\"".base_url('index.php/')."\" title=\"".lang('title_home_page')."\"><img src=\"" . base_url('resource/img/nav/small_home_gipel.png') . "\" width=\"70\" height=\"36\" alt=\"nav\" /></a></td><td><h1>" . $titre;
		} else {
			$nav_title .= "<a href=\"".base_url('index.php/')."\" title=\"".lang('title_home_page')."\"><img src=\"" . base_url('resource/img/nav/small_home_gipel.png') . "\" width=\"70\" height=\"36\" alt=\"nav\" /></a></td><td><h1>" . $titre;
		}
		return $nav_title . "</h1></td></tr>\r\n\t\t\t</table>\r\n";
	}
	
	
	
	
}


/* End of file all_model.php */
/* Location: ./application/models/all_model.php */