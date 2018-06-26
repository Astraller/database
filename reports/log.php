<?
$vars = Array(
	'users' => Db::instance()->query("SELECT * FROM `user` WHERE `status` = 1")->getManyArray(),
	'types' => Db::instance()->query("SELECT * FROM `log_type`")->getManyArray(),
	'target_types' => array(
		"partner" => "Партнеры",
		"client" => "Реаблитанты",
		"user" => "Сотрудники",
		"group" => "Группы сотрудников",
		"partner_group" => "Группы партнеров",
		"event" => "События",
		"raport" => "Отчеты",
		"link" => "Ссылки",
		"settings" => "Настройки"
	)
);
if(count($_POST)){
	$query = "SELECT 
		`l`.*,
		`lt`.`title_ru` as `title`,
		`u`.`fio` as `fio`
	FROM `log` `l`
	LEFT JOIN `log_type` `lt` ON `l`.`id_type` = `lt`.`id`
	LEFT JOIN `user` `u` ON `l`.`id_user` = `u`.`id`
	WHERE 1 = 1";
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
	if(isset($_POST['user']) AND count($_POST['user'])){
		$query .= " AND `id_user` IN (".implode(",", $_POST['user']).")";
	}
	if(isset($_POST['targets']) AND count($_POST['targets'])){
		$query .= " AND `target_type` IN ('".implode("','", $_POST['targets'])."')";
	}
	if(isset($_POST['types']) AND count($_POST['types'])){
		$query .= " AND `id_type` IN (".implode(",", $_POST['types']).")";
	}
	$query .= " AND `datetime` >= '".$start_date."' AND `datetime` <= '".$end_date."' ORDER BY `datetime` DESC";
	$users = Db::instance()->query($query)->getManyArray();
	$vars['log_list'] = $users;
}else{
	$vars['log_list'] = Array();
}

Page::instance()->parse("report/log", $vars)->show();