<?php
$time_from = intVal($_GET['from']/1000);
$time_to = intVal($_GET['to']/1000);
if(User::getRight("CALENDAR_ADD")){
	$add_where = "";
}else{
	$add_where = " (`e`.`id_user` = '".User::getId()."' OR `e`.`id` IN (SELECT `id_event` FROM `event_add_user` WHERE `id_user` = '".User::getId()."' AND `type` = 'u')) AND ";
}
$events = Db::instance()->query("SELECT 
		`e`.*, 
		`u`.`fio` as `user`, 
		`c`.`fio` as `client`,
		`et`.`title` as `type`
	FROM 
		`event` `e` 
		LEFT JOIN `user` `u` ON `u`.`id` = `e`.`id_user` 
		LEFT JOIN `client` `c` ON `c`.`id` = `e`.`id_client` 
		LEFT JOIN `event_type` `et` ON `et`.`id` = `e`.`id_type`
	WHERE ".$add_where." `e`.`status` != 3 
		AND `e`.`id_city` = '".intVal($_GET['id_city'])."'
		AND (`e`.`start_date` < '".date("Y-m-d", $time_to)."' OR `e`.`end_date` > '".date("Y-m-d", $time_from)."')")->getManyArray();
$result = new stdClass;
$result->success = 1;
$result->result = Array();
foreach($events as $event){
	$add_users = Db::instance()->query("SELECT `a`.*, `u`.`fio` as `fio` FROM `event_add_user` `a` LEFT JOIN `user` `u` ON `a`.`id_user` = `u`.`id` WHERE `type` = 'u' AND `id_event` = ".$event['id'])->getManyArray();
	$add_partners = Db::instance()->query("SELECT `a`.*, `p`.`title` as `title` FROM `event_add_user` `a` LEFT JOIN `partner` `p` ON `a`.`id_user` = `p`.`id` WHERE `type` = 'p' AND `id_event` = ".$event['id'])->getManyArray();
	$obj = new stdClass;
	$obj->id = $event['id'];
	$obj->title = $event['title']."<br />";
	$obj->title .= "Тип: ".$event['type']."<br />";
	if($event['id_client'] != 0){
		$obj->title .= "Клиент: ".$event['client']."<br />";
	}
	$obj->title .= "Сотрудник: ".$event['user'];
	foreach($add_users as $user){
		$obj->title .= ", ".$user['fio'];
	}
	foreach($add_partners as $partner){
		$obj->title .= ", ".$partner['title'];
	}
	$obj->title .= "<br />C ".date("H:i", strtotime($event['start_date']))." до ".date("H:i", strtotime($event['end_date']));
	$obj->title = str_replace('"', '&quot;', $obj->title);
	$obj->url = "/?page=event&id=".$event['id'];
	$obj->class = "event-".$event['color'];
	$obj->start = strtotime($event['start_date'])."000";
	$obj->end = strtotime($event['end_date'])."000";
	$result->result[] = $obj;
}
echo Page::JSON($result);
?>