<?
$vars = Array(
	'users' => Db::instance()->query("SELECT * FROM `user` WHERE `status` = 1")->getManyArray(),
	'types' => Db::instance()->query("SELECT * FROM `event_type`")->getManyArray(),
	'locations' => Db::instance()->query("SELECT * FROM `event_location`")->getManyArray()
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
	$query = "SELECT * FROM `user` WHERE `status` = 1";
	if(isset($_POST['user']) AND !empty($_POST['user'])){
		$query .= " AND `id` IN (".implode(",", $_POST['user']).")";
	}
	$users = Db::instance()->query($query)->getManyArray();
	foreach($users as $id => $user){
		$users[$id]['event_clients'] = Db::instance()->query("SELECT
			count(*) as `cnt`,
			`c`.`id` as `id`,
			`c`.`fio` as `fio`,
			SUM(UNIX_TIMESTAMP(`end_date`) - UNIX_TIMESTAMP(`start_date`)) as `time`
		FROM
			`event` `e`
			LEFT JOIN `client` `c` ON `c`.`id` = `e`.`id_client`
		WHERE (`e`.`id_user` = '".$user['id']."' OR
				`e`.`id` IN (SELECT `id_event` FROM `event_add_user` WHERE `id_user` = '".$user['id']."' AND `type` = 'u')
			)
			AND `e`.`start_date` >= '".$start_date."'
			AND `e`.`end_date` <= '".$end_date."'
			".(
				(isset($_POST['type']) AND !empty($_POST['type'])) ? 
				"AND `e`.`id_type` = ".intVal($_POST['type'])
				: ""
			)."
			".(
				(isset($_POST['location']) AND !empty($_POST['location'])) ? 
				"AND `e`.`id_location` = ".intVal($_POST['location'])
				: ""
			)."
		GROUP BY `c`.`id`")->getManyArray();
		$users[$id]['time'] = Db::instance()->query("SELECT
			SUM(UNIX_TIMESTAMP(`end_date`) - UNIX_TIMESTAMP(`start_date`)) as `time`
		FROM
			`event` `e`
		WHERE (`e`.`id_user` = '".$user['id']."' OR
				`e`.`id` IN (SELECT `id_event` FROM `event_add_user` WHERE `id_user` = '".$user['id']."' AND `type` = 'u')
			)
			AND `e`.`start_date` >= '".$start_date."'
			AND `e`.`end_date` <= '".$end_date."'
			".(
				(isset($_POST['type']) AND !empty($_POST['type'])) ? 
				"AND `e`.`id_type` = ".intVal($_POST['type'])
				: ""
			)."
			".(
				(isset($_POST['location']) AND !empty($_POST['location'])) ? 
				"AND `e`.`id_location` = ".intVal($_POST['location'])
				: ""
			)."
		")->getField('time');
		if(count($users[$id]['event_clients'])==0)
			unset($users[$id]);
	}
	$vars['users_list'] = $users;
}else{
	$vars['users_list'] = Array();
}
if(!isset($_POST['template']) OR $_POST['template'] == "view"){
	Page::instance()->parse("report/users", $vars)->show();
}else{
	Page::instance()->parse("report/users.print", $vars)->show(false);
}