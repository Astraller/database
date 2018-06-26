<?
$vars = Array(
	'aftermath' => Db::instance()->query("SELECT * FROM `client_aftermath`")->getManyArray(),
	'type' => Db::instance()->query("SELECT * FROM `client_type`")->getManyArray(),
	'status' => Db::instance()->query("SELECT * FROM `client_service`")->getManyArray()
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
	$query = "SELECT 
			`c`.*,
			`p`.`fio` as `patron_name`,
			`s`.`title` as `service`
		FROM `client` `c`
		LEFT JOIN `user` `p` ON `p`.`id` = `c`.`patron`
		LEFT JOIN `client_service` `s` ON `s`.`id` = `c`.`id_service`
		WHERE `c`.`id_type` IN (".implode(",", $_POST['type']).") AND ".
		"(`c`.`id` IN (SELECT `id_client` FROM `client_aftermath_list` WHERE `id_aftermath` IN (".implode(",", $_POST['aftermath'])."))"
		.(in_array(0, $_POST['aftermath'])?
		" OR `c`.`id` NOT IN (SELECT `id_client` FROM `client_aftermath_list`)":
		""
		)
		.") AND `c`.`id_service` IN (".implode(",", $_POST['status']).") AND
		`c`.`date_in` >= '".$start_date."' AND
		`c`.`date_in` <= '".$end_date."' AND
		`c`.`status` = 1
	";
	$clients = Db::instance()->query($query)->getManyArray();
	foreach($clients as $id => $client){
		$clients[$id]['aftermaths'] = Db::instance()->query("SELECT
			`al`.`id`,
			`ca`.`title` as `title`
		FROM
			`client_aftermath_list` `al`
			LEFT JOIN `client_aftermath` `ca` ON `ca`.`id` = `al`.`id_aftermath`
		WHERE `al`.`id_client` = ".$client['id'])->getFieldArray('title');
	}
	$vars['clients'] = $clients;
}else{
	$vars['clients'] = Array();
}
Page::instance()->parse("report/clients", $vars)->show();