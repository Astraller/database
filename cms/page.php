<?php
class Page{

	public $_html = "";
	private $_pagename = null;

	public function show($parts = true){
		if(empty($this->_html))die("HTML is empty!");
		if($parts)
			echo $this->_header();
		echo $this->_html;
		if($parts)
			echo $this->_footer();
	}

	public function showClear($parts = true){
		if(empty($this->_html))die("HTML is empty!");
		echo $this->_html;
	}

	public static function JSON($vars){
		echo json_encode($vars);
	}

	public function parse($pagename, $vars = array()){
		$this->_pagename = $pagename;
		$this->_import($vars);
		ob_start();
		include "pages/".$pagename.".php";
		$this->_html = ob_get_clean();
		return $this;
	}

	public static function instance(){
		return new self();
	}

	private function _import($vars){
		if(!count($vars))return false;
		if($_GET['page'] != "login"){
		$this->_now_events = Db::instance()->query("SELECT
			`e`.*,
			`u`.`fio` as `user`,
			`p`.`title` as `partner`,
			`c`.`fio` as `client`
			FROM `event` `e`
			LEFT JOIN `user` `u` ON `u`.`id` = `e`.`id_user`
			LEFT JOIN `partner` `p` ON `p`.`id` = `e`.`id_partner`
			LEFT JOIN `client` `c` ON `c`.`id` = `e`.`id_client`
			WHERE `e`.`status` != 3 
			AND DATE(NOW()) <= DATE(`end_date`) AND DATE(NOW()) >= DATE(`start_date`)
			AND (
				`e`.`id_user` = '".User::getId()."' OR 
				`e`.`id` IN (SELECT `id_event` FROM `event_add_user` WHERE `id_user` = '".User::getId()."' AND `type` = 'u')
			)
			ORDER BY `start_date` ASC")->getManyArray();
		$this->_new_links = Db::instance()->query("SELECT
			`l`.*,
			`c`.`fio` as `client`
			FROM `link` `l`
			LEFT JOIN `client` `c` ON `c`.`id` = `l`.`id_client`
			WHERE `l`.`status` = 0 AND (
				(`l`.`type` = 'u' AND `l`.`id_partner` = '".User::getId()."') 
				OR 
				(`l`.`type` = 'p' AND `l`.`id_partner` = '".User::getPartnerId()."'))")->getManyArray();
		}
		foreach($vars as $key => $val){
			$this->$key = $val;
		}
		return true;
	}

	private function _header(){
		$this->title = $this->_getTitle();
		ob_start();
		include "pages/part_header.php";
		return ob_get_clean();
	}

	private function _footer(){
		ob_start();
		include "pages/part_footer.php";
		return ob_get_clean();
	}

	private function _getTitle(){
		global $config;
		if(!isset($config['titles'][$this->_pagename]))die("Title is not set!");
		return $config['base_title'].$config['titles'][$this->_pagename];
	}

}
?>