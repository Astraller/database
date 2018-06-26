<?
$vars = Array(
	'partners' => Db::instance()->query("SELECT * FROM `partner` WHERE `status` = 1")->getManyArray()
);
if(count($_POST)){
	if(!empty($_POST['start_date'])){
		list($day, $month, $year) = explode(".", $_POST['start_date']);
		$start_date = $year."-".$month."-".$day." 00:00:00";
	}else{
		$start_date = "0000-00-00 00:00:00";
	}
	if(!empty($_POST['end_date'])){
		list($day, $month, $year) = explode(".", $_POST['end_date']);
		$end_date = $year."-".$month."-".$day." 00:00:00";
	}else{
		$end_date = date("Y-m-d H:i:s");
	}
	$query = "SELECT * FROM `partner` WHERE `status` = 1";
	if(isset($_POST['partner']) AND !empty($_POST['partner'])){
		$query .= " AND `id` IN (".implode(",", $_POST['partner']).")";
	}
	$partners = Db::instance()->query($query)->getManyArray();
	foreach($partners as $id => $partner){
		$partners[$id]['in'] = Db::instance()->query("SELECT
			`c`.*
		FROM
			`client` `c`
		WHERE `c`.`id_partner` = ".$partner['id']."
			AND `c`.`date_in` >= '".$start_date."'
			AND `c`.`date_in` <= '".$end_date."'")->getManyArray();
		$partners[$id]['out'] = Db::instance()->query("SELECT
			`c`.`id` as `id`,
			`c`.`fio` as `fio`
		FROM
			`link` `l`
			LEFT JOIN `client` `c` ON `c`.`id` = `l`.`id_client`
		WHERE `l`.`id_partner` = ".$partner['id']."
			AND `l`.`type` = 'p'
			AND `l`.`start_date` >= '".$start_date."'
			AND `l`.`start_date` <= '".$end_date."'")->getManyArray();
		if(count($partners[$id]['in'])==0 AND count($partners[$id]['out'])==0)
			unset($partners[$id]);
	}
	$vars['partners_list'] = $partners;
}else{
	$vars['partners_list'] = Array();
}
if(!isset($_POST['template']) OR $_POST['template'] == "view"){
	Page::instance()->parse("report/partners", $vars)->show();
}else{
	Page::instance()->parse("report/partners.print", $vars)->show(false);
}