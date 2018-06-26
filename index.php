<?php
session_start();
include "cms/config.php";
include "cms/db.php";
include "cms/user.php";
include "cms/page.php";
include "cms/log.php";
User::checkAutoLogin();
date_default_timezone_set("Europe/Kiev");

if($_GET['page'] != "login")
	User::checkLogin();

if(!User::checkRigths($_GET["page"])){
	Page::instance()->parse("rights")->show();
	die();
}

switch($_GET['page']){
	case "":
		$vars = Array(
			'clients' => Db::instance()->query("SELECT COUNT(*) as cnt FROM `client` WHERE `status` = 1")->getField("cnt"),
			'users' => Db::instance()->query("SELECT COUNT(*) as cnt FROM `user`")->getField("cnt"),
			'events' => Db::instance()->query("SELECT COUNT(*) as cnt FROM `event` WHERE `status` != 3 AND DATE(NOW()) <= DATE(`end_date`) AND DATE(NOW()) >= DATE(`start_date`)")->getField("cnt"),
			'pastEvents' => Db::instance()->query("SELECT COUNT(*) as cnt FROM `event` WHERE `id_user` = '".User::getId()."' AND `status` = 0 AND DATE(NOW()) >= DATE(`start_date`)")->getField("cnt"),
			"cities" => Db::instance()->query("SELECT * FROM `event_city` WHERE `status` = 1")->getManyArray(),
			"id_city" => intVal($_GET['city'])?intVal($_GET['city']):1
		);
		Page::instance()->parse("dashboard", $vars)->show();
	break;
	case "settings":
		Log::add("view", "settings", 0);
		switch($_GET['type']){
			case "log":
				include "reports/log.php";
			break;
			case "requests":
				if(!empty($_GET['dee'])){
					switch($_GET['dee']){
						case "add":
							Db::instance()->query("INSERT INTO `client_requests` SET 
								`title` = '".mysql_real_escape_string($_POST['title'])."',
								`status` = 1
							");
							header("Location: /?page=settings&type=requests");
						break;
						case "edit":
							if(count($_POST)){
								Db::instance()->query("UPDATE `client_requests` SET `title` = '".mysql_real_escape_string($_POST['title'])."' WHERE `id` = ".intVal($_GET['id']));
								header("Location: /?page=settings&type=requests");
							}
							$request = Db::instance()->query("SELECT * FROM `client_requests` WHERE `id` = ".intVal($_GET['id']))->getOneArray();
							Page::instance()->parse("settings_location_edit", $request)->show();
							die();
						break;
						case "delete":
							Db::instance()->query("UPDATE `client_requests` SET `status` = 0 WHERE `id` = ".intVal($_GET['id']));
							header("Location: /?page=settings&type=requests");
						break;
					}
				}
				$vars = array(
					"requests" => Db::instance()->query("SELECT * FROM `client_requests` WHERE `status` = 1")->getManyArray()
				);
				Page::instance()->parse("settings_requests", $vars)->show();
			break;
			case "cities":
				if(!empty($_GET['dee'])){
					switch($_GET['dee']){
						case "add":
							Db::instance()->query("INSERT INTO `event_city` SET 
								`title` = '".mysql_real_escape_string($_POST['title'])."',
								`status` = 1
							");
							header("Location: /?page=settings&type=cities");
						break;
						case "edit":
							if(count($_POST)){
								Db::instance()->query("UPDATE `event_city` SET `title` = '".mysql_real_escape_string($_POST['title'])."' WHERE `id` = ".intVal($_GET['id']));
								header("Location: /?page=settings&type=cities");
							}
							$location = Db::instance()->query("SELECT * FROM `event_city` WHERE `id` = ".intVal($_GET['id']))->getOneArray();
							Page::instance()->parse("settings_location_edit", $location)->show();
							die();
						break;
						case "delete":
							Db::instance()->query("UPDATE `event_city` SET `status` = 0 WHERE `id` = ".intVal($_GET['id']));
							header("Location: /?page=settings&type=cities");
						break;
					}
				}
				$vars = array(
					"cities" => Db::instance()->query("SELECT * FROM `event_city` WHERE `status` = 1")->getManyArray()
				);
				Page::instance()->parse("settings_cities", $vars)->show();
			break;
			case "locations":
				if(!empty($_GET['dee'])){
					switch($_GET['dee']){
						case "add":
							Db::instance()->query("INSERT INTO `event_location` SET 
								`title` = '".mysql_real_escape_string($_POST['title'])."',
								`status` = 1
							");
							header("Location: /?page=settings&type=locations");
						break;
						case "edit":
							if(count($_POST)){
								Db::instance()->query("UPDATE `event_location` SET `title` = '".mysql_real_escape_string($_POST['title'])."' WHERE `id` = ".intVal($_GET['id']));
								header("Location: /?page=settings&type=locations");
							}
							$location = Db::instance()->query("SELECT * FROM `event_location` WHERE `id` = ".intVal($_GET['id']))->getOneArray();
							Page::instance()->parse("settings_location_edit", $location)->show();
							die();
						break;
						case "delete":
							Db::instance()->query("UPDATE `event_location` SET `status` = 0 WHERE `id` = ".intVal($_GET['id']));
							header("Location: /?page=settings&type=locations");
						break;
					}
				}
				$vars = array(
					"locations" => Db::instance()->query("SELECT * FROM `event_location` WHERE `status` = 1")->getManyArray()
				);
				Page::instance()->parse("settings_locations", $vars)->show();
			break;
			case "types":
				if(!empty($_GET['dee'])){
					switch($_GET['dee']){
						case "add":
							Db::instance()->query("INSERT INTO `event_type` SET 
								`title` = '".mysql_real_escape_string($_POST['title'])."',
								`status` = 1
							");
							header("Location: /?page=settings&type=types");
						break;
						case "edit":
							if(count($_POST)){
								Db::instance()->query("UPDATE `event_type` SET `title` = '".mysql_real_escape_string($_POST['title'])."' WHERE `id` = ".intVal($_GET['id']));
								header("Location: /?page=settings&type=types");
							}
							$location = Db::instance()->query("SELECT * FROM `event_type` WHERE `id` = ".intVal($_GET['id']))->getOneArray();
							Page::instance()->parse("settings_type_edit", $location)->show();
							die();
						break;
						case "delete":
							Db::instance()->query("UPDATE `event_type` SET `status` = 0 WHERE `id` = ".intVal($_GET['id']));
							header("Location: /?page=settings&type=types");
						break;
					}
				}
				$vars = array(
					"types" => Db::instance()->query("SELECT * FROM `event_type` WHERE `status` = 1")->getManyArray()
				);
				Page::instance()->parse("settings_types", $vars)->show();
			break;
		}
	break;
	case "raport":
		Log::add("view", "raport", 0);
		switch($_GET['type']){
			case "clients":
				include "reports/clients.php";
			break;
			case "incoming":
				include "reports/incoming.php";
			break;
			case "users":
				include "reports/users.php";
			break;
			case "partners":
				include "reports/partners.php";
			break;
			case "all":
				include "reports/all.php";
			break;
			default:
				Page::instance()->parse("404")->show();
			break;
		}
	break;
	case "partners":
		Log::add("view", "partner", 0);
		Page::instance()->parse("partners")->show();
	break;
	case "user_delete":
		Log::add("delete", "user", intVal($_GET['id']));
		Db::instance()->query("UPDATE `user` SET `status` = 0 WHERE `id` = ".intVal($_GET['id']));
		header("Location: /?page=users");
	break;
	case "link_delete":
		Log::add("delete", "link", intVal($_GET['id']));
		$client = Db::instance()->query("SELECT `id_client` FROM `link` WHERE `id` = ".intVal($_GET['id']))->getField("id_client");
		Db::instance()->query("UPDATE `link` SET `status` = 2 WHERE `id` = ".intVal($_GET['id']));
		header("Location: /?page=client&id=".$client);
	break;
	case "link_approve":
		Log::add("approve", "link", intVal($_GET['id']));
		$client = Db::instance()->query("SELECT `id_client` FROM `link` WHERE `id` = ".intVal($_GET['id']))->getField("id_client");
		Db::instance()->query("UPDATE `link` SET `status` = 1, `start_date` = NOW() WHERE `id` = ".intVal($_GET['id']));
		header("Location: /?page=client&id=".$client);
	break;
	case "create_link":
		$client = intVal($_GET['client']);
		if(count($_POST)){
			Db::instance()->query("DELETE FROM `link` WHERE `id_client` = ".$client);
			if(is_array($_POST['id_partner']) AND count($_POST['id_partner'])){
				foreach($_POST['id_partner'] as $partner){
					list($type, $id) = explode("_", $partner);
					$id = Db::instance()->query("INSERT INTO `link` SET
						`id_client` = ".$client.",
						`id_partner` = ".intVal($id).",
						`type`= '".$type."',
						`status` = 1,
						`start_date` = NOW()
					")->insertId();
					Log::add("add", "link", $id);
				}
			}
			header("Location: /?page=client&id=".$client);
		}

		$_POST['clients'] = Db::instance()->query("SELECT * FROM `client` WHERE `status` = 1")->getManyArray();
		$_POST['partners'] = Db::instance()->query("SELECT * FROM `partner` WHERE `status` = 1")->getManyArray();
		$_POST['users'] = Db::instance()->query("SELECT * FROM `user` WHERE `status` = 1")->getManyArray();
		$_POST['usersList'] = Db::instance()->query("SELECT `id`, `id_partner` FROM `link` WHERE `status` != 2 AND `id_client` = '".$client."' AND `type` = 'u'")->getFieldArray("id_partner");
		$_POST['partnersList'] = Db::instance()->query("SELECT `id`, `id_partner` FROM `link` WHERE `status` != 2 AND  `id_client` = '".$client."' AND `type` = 'p'")->getFieldArray("id_partner");
		Page::instance()->parse("link_create", $_POST)->show();
	break;
	case "partner":
		$id = intVal($_GET['id']);
		Log::add("view", "partner", $id);
		$partner = Db::instance()->query("SELECT 
			`p`.*,
			`u`.`fio` as `user`,
			`pg`.`title` as `group`
		FROM `partner` `p` 
		LEFT JOIN `user` `u` ON `u`.`id` = `p`.`id_user`
		LEFT JOIN `partner_group` `pg` ON `pg`.`id` = `p`.`id_group`
		WHERE `p`.`id` = ".$id)->getOneArray();
		$partner['links'] = Db::instance()->query("SELECT `l`.*, `c`.`fio` as `client` FROM `link` `l` LEFT JOIN `client` `c` ON `c`.`id` = `l`.`id_client` WHERE `l`.`type` = 'p' AND `l`.`id_partner` = ".$id." AND `l`.`status` != 2 AND `c`.`status` = 1")->getManyArray();
		$partner['events'] = Db::instance()->query("SELECT
			`e`.*,
			`u`.`fio` as `user`,
			`p`.`title` as `partner`
			FROM `event` `e`
			LEFT JOIN `user` `u` ON `u`.`id` = `e`.`id_user`
			LEFT JOIN `partner` `p` ON `p`.`id` = `e`.`id_partner`
			WHERE (`e`.`id_partner` = ".$id." OR `e`.`id` IN (
				SELECT `id_event` FROM `event_add_user` WHERE `id_user` = '".$id."' AND type = 'p'
			)) AND `e`.`status` != 3")->getManyArray();
		Page::instance()->parse("partner", $partner)->show();
	break;
	case "partner_delete":
		$id = intVal($_GET['id']);
		Log::add("delete", "partner", $id);
		Db::instance()->query("UPDATE `partner` SET `status` = 2 WHERE `id` = ".$id);
		header("Location: /?page=partners");
	break;
	case "partner_edit":
		$id = intVal($_GET['id']);
		Log::add("edit", "partner", $id);
		if(count($_POST)){
			Db::instance()->query("UPDATE `partner` SET
				`title` = '".mysql_real_escape_string($_POST['title'])."',
				`contacts` = '".mysql_real_escape_string($_POST['contacts'])."',
				`services` = '".mysql_real_escape_string($_POST['services'])."',
				`id_user` = '".intVal($_POST['id_user'])."',
				`id_group` = '".intVal($_POST['id_group'])."',
				`description` = '".mysql_real_escape_string($_POST['description'])."'
			WHERE `id` = '".$id."'");
			if(isset($_FILES['logotype']['tmp_name'])){
				$tmp = explode(".", $_FILES['logotype']['name']);
				$ext = $tmp[count($tmp)-1];
				move_uploaded_file($_FILES['logotype']['tmp_name'], "./uploads/".$id.".".$ext);
				Db::instance()->query("UPDATE `partner` SET `image` = '".$id.".".$ext."' WHERE `id` = '".$id."'");
			}
			header("Location: /?page=partners");
			die();
		}
		$partner = Db::instance()->query("SELECT * FROM `partner` WHERE `id` = '".$id."'")->getOneArray();
		$partner['users'] = Db::instance()->query("SELECT * FROM `user`")->getManyArray();
		$partner['groups'] = Db::instance()->query("SELECT * FROM `partner_group` WHERE `status` = 1")->getManyArray();
		Page::instance()->parse("partner_edit", $partner)->show();
	break;
	case "partner_add":
		if(count($_POST)){
			$id = Db::instance()->query("INSERT INTO `partner` SET
				`title` = '".mysql_real_escape_string($_POST['title'])."',
				`contacts` = '".mysql_real_escape_string($_POST['contacts'])."',
				`services` = '".mysql_real_escape_string($_POST['services'])."',
				`id_user` = '".intVal($_POST['id_user'])."',
				`id_group` = '".intVal($_POST['id_group'])."',
				`description` = '".mysql_real_escape_string($_POST['description'])."',
				`status` = 1
			")->insertId();
			Log::add("add", "partner", $id);
			if(isset($_FILES['logotype']['tmp_name']) AND !empty($_FILES['logotype']['tmp_name'])){
				$tmp = explode(".", $_FILES['logotype']['name']);
				$ext = $tmp[count($tmp)-1];
				move_uploaded_file($_FILES['logotype']['tmp_name'], "./uploads/".$id.".".$ext);
				Db::instance()->query("UPDATE `partner` SET `image` = '".$id.".".$ext."' WHERE `id` = '".$id."'");
			}
			header("Location: /?page=partners");
			die();
		}
		$_POST['users'] = Db::instance()->query("SELECT * FROM `user`")->getManyArray();
		$_POST['groups'] = Db::instance()->query("SELECT * FROM `partner_group` WHERE `status` = 1")->getManyArray();
		Page::instance()->parse("partner_add", $_POST)->show();
	break;
	case "login":
		if(count($_POST)){
			if(User::login($_POST['email'], $_POST['password'])){
				header("Location: /");
			}else{
				header("Location: /?page=login&message=wrong");
			}
		}else{
			$vars = array();
			if(isset($_GET['message'])){
				switch($_GET['message']){
					case "wrong":
						$vars['message'] = "Пользователя с такими данными не существует";
					break;
				}
			}
			Page::instance()->parse("login", $vars)->show(false);
		}
	break;
	case "logout":
		User::logout();
	break;
	case "profile":
		$user_id = User::getId();
		if(count($_POST)){
			Db::instance()->query("UPDATE `user` SET 
				`fio` = '".mysql_real_escape_string($_POST['fio'])."',
				`email` = '".mysql_real_escape_string($_POST['email'])."',
				`phone` = '".mysql_real_escape_string($_POST['phone'])."'
			WHERE `id` = '".$user_id."'");
			if(!empty($_POST['password'])){
				Db::instance()->query("UPDATE `user` SET 
					`password` = '".User::_hash($_POST['password'])."'
				WHERE `id` = '".$user_id."'");
			}
			header("Location: /?page=profile");
			die();			
		}
		$user = Db::instance()->query("SELECT * FROM `user` WHERE `id` = '".$user_id."'")->getOneArray();
		Page::instance()->parse("profile", $user)->show();
	break;
	case "partner_group_delete":
		$group_id = intVal($_GET['id']);
		Log::add("delete", "partner_group", $group_id);
		Db::instance()->query("UPDATE `partner_group` SET `status` = 0 WHERE `id` = '".$group_id."'");
		header("Location: /?page=partner_groups");
	break;
	case "group_delete":
		$group_id = intVal($_GET['id']);
		Log::add("delete", "group", $group_id);
		Db::instance()->query("UPDATE `group` SET `status` = 0 WHERE `id` = '".$group_id."'");
		header("Location: /?page=groups");
	break;
	case "event_delete":
		$event_id = intVal($_GET['id']);
		Log::add("delete", "event", $event_id);
		Db::instance()->query("UPDATE `event` SET `status` = 3 WHERE `id` = '".$event_id."'");
		header("Location: /?page=calendar");
	break;
	case "event_edit":
		$event_id = intVal($_GET['id']);
		Log::add("edit", "event", $event_id);
		$event = Db::instance()->query("SELECT * FROM `event` WHERE `id` = '".$event_id."'")->getOneArray();
		if(!User::getRight("CALENDAR_ADD") AND $event['id_user'] != User::getId()){
			header("Location: /?page=calendar");
			die();
		}
		if(count($_POST)){
			list($day, $month, $year) = explode(".", $_POST['one_date']);
			$start_h = intVal($_POST['start_h']);
			$start_m = intVal($_POST['start_m']);
			$end_h = intVal($_POST['end_h']);
			$end_m = intVal($_POST['end_m']);
			$start = $year."-".$month."-".$day." ".$start_h.":".$start_m.":00";
			$end = $year."-".$month."-".$day." ".$end_h.":".$end_m.":00";
			list($type, $uid) = explode("_", $_POST['users'][0]);
			if($type == "u"){
				$user = $uid;
			}else{
				$partner = $uid;
			}

			Db::instance()->query("UPDATE `event` SET 
				`title` = '".mysql_real_escape_string($_POST['title'])."',
				`id_type` = '".intVal($_POST['id_type'])."',
				`id_location` = '".intVal($_POST['id_location'])."',
				`id_city` = '".intVal($_POST['id_city'])."',
				`id_user` = '".$user."',
				`id_partner` = '".$partner."',
				`id_client` = '".intVal($_POST['client'])."',
				`color` = '".mysql_real_escape_string($_POST['color'])."',
				`comment` = '".mysql_real_escape_string($_POST['comment'])."',
				`start_date` = '".$start."',
				`end_date` = '".$end."'
			WHERE `id` = '".intVal($_POST['id'])."'");
			Db::instance()->query("DELETE FROM `event_add_user` WHERE `id_event` = ".$event_id);
			if(count($_POST['users']) > 1){
				for($i=1;isset($_POST['users'][$i]);$i++){
					list($type, $uid) = explode("_", $_POST['users'][$i]);
					Db::instance()->query("INSERT IGNORE INTO `event_add_user` SET `type` = '".$type."', `id_user` = '".$uid."', `id_event` = '".$event_id."'");
				}
			}
			header("Location: /?page=event&id=".$event_id);
			die();
		}
		$event['users'] = Db::instance()->query("SELECT * FROM `user`")->getManyArray();
		$event['clients'] = Db::instance()->query("SELECT * FROM `client` WHERE `status` = 1")->getManyArray();
		$event['partners'] = Db::instance()->query("SELECT * FROM `partner` WHERE `status` = 1")->getManyArray();
		$event['is_users'] = Db::instance()->query("SELECT `id`, `id_user` FROM `event_add_user` WHERE `id_event` = ".$event_id)->getFieldArray("id_user");
		$event['is_partners'] = Db::instance()->query("SELECT `id`, `id_user` FROM `event_add_user` WHERE `id_event` = ".$event_id)->getFieldArray("id_user");
		$event['types'] = Db::instance()->query("SELECT * FROM `event_type` WHERE `status` = 1")->getManyArray();
		$event['locations'] = Db::instance()->query("SELECT * FROM `event_location` WHERE `status` = 1")->getManyArray();
		$event['cities'] = Db::instance()->query("SELECT * FROM `event_city` WHERE `status` = 1")->getManyArray();
		Page::instance()->parse("edit_event", $event)->show();
	break;
	case "event":
		$event_id = intVal($_GET['id']);
		Log::add("view", "event", $event_id);
		if(count($_POST)){
			Db::instance()->query("UPDATE `event` SET `status` = '".intVal($_POST['status'])."' WHERE `id` = ".$event_id);
			header("Location: /?page=event&id=".$event_id);
			die();
		}
		$event = Db::instance()->query("SELECT 
			`e`.*, 
			`c`.`fio` as `client`, 
			`u`.`fio` as `user`,
			`et`.`title` as `type`,
			`el`.`title` as `location`,
			`ec`.`title` as `city`
		FROM `event` `e` 
			LEFT JOIN `user` `u` ON `u`.`id` = `e`.`id_user` 
			LEFT JOIN `client` `c` ON `c`.`id` = `e`.`id_client` AND `c`.`status` = 1 
			LEFT JOIN `event_type` `et` ON `et`.`id` = `e`.`id_type`
			LEFT JOIN `event_location` `el` ON `el`.`id` = `e`.`id_location`
			LEFT JOIN `event_city` `ec` ON `ec`.`id` = `e`.`id_city`
		WHERE `e`.`id` = '".$event_id."'")->getOneArray();
		$event['add_users'] = Db::instance()->query("SELECT `a`.*, `u`.`fio` as `fio` FROM `event_add_user` `a` LEFT JOIN `user` `u` ON `a`.`id_user` = `u`.`id` WHERE `type` = 'u' AND `id_event` = ".$event['id'])->getManyArray();
		$event['add_partners'] = Db::instance()->query("SELECT `a`.*, `p`.`title` as `title` FROM `event_add_user` `a` LEFT JOIN `partner` `p` ON `a`.`id_user` = `p`.`id` WHERE `type` = 'p' AND `id_event` = ".$event['id'])->getManyArray();
		Page::instance()->parse("event", $event)->show();
	break;
	case "add_event":
		if(count($_POST)){
			list($day, $month, $year) = explode(".", $_POST['one_date']);
			$start_h = intVal($_POST['start_h']);
			$start_m = intVal($_POST['start_m']);
			$end_h = intVal($_POST['end_h']);
			$end_m = intVal($_POST['end_m']);
			$start = $year."-".$month."-".$day." ".$start_h.":".$start_m.":00";
			$end = $year."-".$month."-".$day." ".$end_h.":".$end_m.":00";
			list($type, $uid) = explode("_", $_POST['users'][0]);
			if($type == "u"){
				$user = $uid;
			}else{
				$partner = $uid;
			}
			$event_id = Db::instance()->query("INSERT INTO `event` SET
				`title` = '".mysql_real_escape_string($_POST['title'])."',
				`id_type` = '".intVal($_POST['id_type'])."',
				`id_location` = '".intVal($_POST['id_location'])."',
				`id_city` = '".intVal($_POST['id_city'])."',
				`id_user` = '".$user."',
				`id_partner` = '".$partner."',
				`id_client` = '".intVal($_POST['client'])."',
				`start_date` = '".$start."',
				`end_date` = '".$end."',
				`color` = '".mysql_real_escape_string($_POST['color'])."',
				`comment` = '".mysql_real_escape_string($_POST['comment'])."',
				`status` = 0
			")->insertId();
			Log::add("add", "event", $event_id);
			if(count($_POST['users']) > 1){
				for($i=1;isset($_POST['users'][$i]);$i++){
					list($type, $uid) = explode("_", $_POST['users'][$i]);
					Db::instance()->query("INSERT INTO `event_add_user` SET `type` = '".$type."', `id_user` = '".$uid."', `id_event` = '".$event_id."'");
				}
			}
			header("Location: /?page=calendar");
			die();
		}
		$_POST['users'] = Db::instance()->query("SELECT * FROM `user` WHERE `status` = 1")->getManyArray();
		$_POST['clients'] = Db::instance()->query("SELECT * FROM `client` WHERE `status` = 1")->getManyArray();
		$_POST['partners'] = Db::instance()->query("SELECT * FROM `partner` WHERE `status` = 1")->getManyArray();
		$_POST['types'] = Db::instance()->query("SELECT * FROM `event_type` WHERE `status` = 1")->getManyArray();
		$_POST['locations'] = Db::instance()->query("SELECT * FROM `event_location` WHERE `status` = 1")->getManyArray();
		$_POST['cities'] = Db::instance()->query("SELECT * FROM `event_city` WHERE `status` = 1")->getManyArray();
		Page::instance()->parse("add_event", $_POST)->show();
	break;
	case "partner_groups":
		Log::add("view", "partner_group", 0);
		Page::instance()->parse("partner_groups")->show();
	break;
	case "calendar":
		Log::add("view", "event", 0);
		$result = Array(
			"cities" => Db::instance()->query("SELECT * FROM `event_city` WHERE `status` = 1")->getManyArray(),
			"id_city" => intVal($_GET['city'])?intVal($_GET['city']):1
		);
		Page::instance()->parse("calendar", $result)->show();
	break;
	case "groups":
		Log::add("view", "group", 0);
		Page::instance()->parse("groups")->show();
	break;
	case "clients":
		Log::add("view", "client", 0);
		Page::instance()->parse("clients")->show();
	break;
	case "client":
		Log::add("view", "client", intVal($_GET['id']));
		$client = Db::instance()->query("SELECT
			`c`.*,
			`ct`.`title` as `type`,
			`cs`.`title` as `service`,
			`u`.`fio` as `patron_name`,
			`ac`.`name` as `city`,
			`ar`.`name` as `region`,
			`p`.`fio` as `parent`,
			`pr`.`title` as `partner`
		FROM `client` `c`
		LEFT JOIN `partner` `pr` ON `pr`.`id` = `c`.`id_partner`
		LEFT JOIN `client_type` `ct` ON `ct`.`id` = `c`.`id_type`
		LEFT JOIN `client_service` `cs` ON `cs`.`id` = `c`.`id_service`
		LEFT JOIN `user` `u` ON `u`.`id` = `c`.`patron`
		LEFT JOIN `city` `ac` ON `ac`.`city_id` = `c`.`id_city`
		LEFT JOIN `region` `ar` ON `ar`.`region_id` = `c`.`id_region`
		LEFT JOIN `client` `p` ON `p`.`id` = `c`.`id_parent` AND `p`.`status` = 1
		WHERE `c`.`id` = ".intVal($_GET['id']))->getOneArray();
		$client['childs'] = Db::instance()->query("SELECT `c`.`id`, `c`.`fio`, `ct`.`title` as `type` FROM `client` `c` LEFT JOIN `client_type` `ct` ON `ct`.`id` = `c`.`id_type` WHERE `c`.`status` = 1 AND `c`.`id_parent` = ".intVal($_GET['id']))->getManyArray();
		$client['links'] = Db::instance()->query("SELECT 
			`l`.`id`, 
			`p`.`title` as `partner`,
			`l`.`id_partner`,
			`u`.`fio` as `upartner`,
			`l`.`type`,
			`l`.`status`,
			`l`.`start_date`
		FROM `link` `l` 
		LEFT JOIN `partner` `p` ON `p`.`id` = `l`.`id_partner` AND `l`.`type` = 'p'
		LEFT JOIN `user` `u` ON `u`.`id` = `l`.`id_partner` AND `l`.`type` = 'u'
		WHERE `l`.`status` != 2 AND `l`.`id_client` = ".intVal($_GET['id']))->getManyArray();
		$client['events'] = Db::instance()->query("SELECT
			`e`.*,
			`u`.`fio` as `user`,
			`p`.`title` as `partner`
			FROM `event` `e`
			LEFT JOIN `user` `u` ON `u`.`id` = `e`.`id_user`
			LEFT JOIN `partner` `p` ON `p`.`id` = `e`.`id_partner`
			WHERE `e`.`status` != 3 AND `e`.`id_client` = ".intVal($_GET['id']))->getManyArray();
		$client['aftermaths'] = Db::instance()->query("SELECT `cal`.`id`, `ca`.`title` as `title` FROM `client_aftermath_list` `cal` LEFT JOIN `client_aftermath` `ca` ON `ca`.`id` = `cal`.`id_aftermath` WHERE `cal`.`id_client` = '".intVal($_GET['id'])."'")->getFieldArray("title");
		Page::instance()->parse("client", $client)->show();
	break;
	case "client_delete":
		$id = intVal($_GET['id']);
		Log::add("delete", "client", $id);
		Db::instance()->query("UPDATE `client` SET `status` = 0 WHERE `id` = ".$id);
		header("Location: /?page=clients");
	break;
	case "client_add":
		if(count($_POST)){
			list($day, $month, $year) = explode(".", $_POST['date_in']);
			$date_in = $year."-".$month."-".$day." 00:00:00";
			list($day, $month, $year) = explode(".", $_POST['date_birth']);
			$date_birth = $year."-".$month."-".$day." 00:00:00";
			$id = Db::instance()->query("INSERT INTO `client` SET 
				`fio` = '".mysql_real_escape_string($_POST['fio'])."',
				`phone` = '".mysql_real_escape_string($_POST['phone'])."',
				`id_region` = '".intVal($_POST['id_region'])."',
				`id_city` = '".intVal($_POST['id_city'])."',
				`address` = '".mysql_real_escape_string($_POST['addres'])."',
				`family` = '".mysql_real_escape_string($_POST['family'])."',
				`id_service` = '".intVal($_POST['id_service'])."',
				`id_type` = '".intVal($_POST['id_type'])."',
				`id_partner` = '".intVal($_POST['id_partner'])."',
				`batalion` = '".mysql_real_escape_string($_POST['batalion'])."',
				`patron` = '".intVal($_POST['patron'])."',
				`id_parent` = '".intVal($_POST['id_parent'])."',
				`description` = '".mysql_real_escape_string($_POST['description'])."',
				`request` = '".mysql_real_escape_string($_POST['request'])."',
				`date_add` = NOW(),
				`date_in` = '".$date_in."',
				`date_birth` = '".$date_birth."',
				`status` = 1
			")->insertId();
			Log::add("add", "client", $id);
			if(isset($_POST['id_aftermath']) AND count($_POST['id_aftermath']))
				foreach($_POST['id_aftermath'] as $aftermath){
					Db::instance()->query("INSERT INTO `client_aftermath_list` SET `id_client` = ".$id.", `id_aftermath` = ".intVal($aftermath));
				}
			$_POST['request'] = trim($_POST['request']);
			if(!empty($_POST['request'])){
				$requests = explode(",", $_POST['request']);
				foreach($requests as $request){
					Db::instance()->query("INSERT IGNORE INTO `client_requests` SET `title` = '".$request."'");
				}
			}
			$_POST['bataion'] = trim($_POST['batalion']);
			if(!empty($_POST['batalion'])){
				$batalions = explode(",", $_POST['batalion']);
				foreach($batalions as $batalion){
					Db::instance()->query("INSERT IGNORE INTO `client_batalions` SET `title` = '".$batalion."'");
				}
			}
			header("Location: /?page=clients");
			die();
		}
		$_POST['regions'] = Db::instance()->query("SELECT * FROM `region` WHERE `country_id` = 9908")->getManyArray('region_id');
		$_POST['users'] = Db::instance()->query("SELECT * FROM `user`")->getManyArray();
		$_POST['types'] = Db::instance()->query("SELECT * FROM `client_type` ORDER BY `id`")->getManyArray();
		$_POST['services'] = Db::instance()->query("SELECT * FROM `client_service`")->getManyArray();
		$_POST['aftermaths'] = Db::instance()->query("SELECT * FROM `client_aftermath`")->getManyArray();
		$_POST['clients'] = Db::instance()->query("SELECT * FROM `client` WHERE `status` = 1")->getManyArray();
		$_POST['partners'] = Db::instance()->query("SELECT * FROM `partner` WHERE `status` = 1")->getManyArray();

		Page::instance()->parse("client_add", $_POST)->show();
	break;	
	case "client_edit":
		if(count($_POST)){
			Log::add("edit", "client", $_GET['id']);
			Db::instance()->query("DELETE FROM `client_aftermath_list` WHERE `id_client` = ".intVal($_GET['id']));
			if(isset($_POST['id_aftermath']) AND count($_POST['id_aftermath']))
				foreach($_POST['id_aftermath'] as $aftermath){
					Db::instance()->query("INSERT INTO `client_aftermath_list` SET `id_client` = ".intVal($_GET['id']).", `id_aftermath` = ".intVal($aftermath));
				}
			list($day, $month, $year) = explode(".", $_POST['date_in']);
			$date_in = $year."-".$month."-".$day." 00:00:00";
			list($day, $month, $year) = explode(".", $_POST['date_birth']);
			$date_birth = $year."-".$month."-".$day." 00:00:00";
			Db::instance()->query("UPDATE `client` SET 
				`fio` = '".mysql_real_escape_string($_POST['fio'])."',
				`phone` = '".mysql_real_escape_string($_POST['phone'])."',
				`id_region` = '".intVal($_POST['id_region'])."',
				`id_city` = '".intVal($_POST['id_city'])."',
				`address` = '".mysql_real_escape_string($_POST['addres'])."',
				`family` = '".mysql_real_escape_string($_POST['family'])."',
				`id_service` = '".intVal($_POST['id_service'])."',
				`id_type` = '".intVal($_POST['id_type'])."',
				`id_partner` = '".intVal($_POST['id_partner'])."',
				`batalion` = '".mysql_real_escape_string($_POST['batalion'])."',
				`patron` = '".intVal($_POST['patron'])."',
				`id_parent` = '".intVal($_POST['id_parent'])."',
				`description` = '".mysql_real_escape_string($_POST['description'])."',
				`request` = '".mysql_real_escape_string($_POST['request'])."',
				`date_in` = '".$date_in."',
				`date_birth` = '".$date_birth."',
				`date_edit` = NOW()
			WHERE `id` = '".intVal($_POST['id'])."'");
			$_POST['request'] = trim($_POST['request']);
			if(!empty($_POST['request'])){
				$requests = explode(",", $_POST['request']);
				foreach($requests as $request){
					Db::instance()->query("INSERT IGNORE INTO `client_requests` SET `title` = '".$request."'");
				}
			}
			$_POST['bataion'] = trim($_POST['batalion']);
			if(!empty($_POST['batalion'])){
				$batalions = explode(",", $_POST['batalion']);
				foreach($batalions as $batalion){
					Db::instance()->query("INSERT IGNORE INTO `client_batalions` SET `title` = '".$batalion."'");
				}
			}
			header("Location: /?page=clients");
			die();
		}else{
			$_POST = Db::instance()->query("SELECT * FROM `client` WHERE `id` = ".intVal($_GET['id']))->getOneArray();
		}
		$_POST['cities'] = Db::instance()->query("SELECT * FROM `city` WHERE `region_id` = ".$_POST['id_region'])->getManyArray('city_id');
		$_POST['regions'] = Db::instance()->query("SELECT * FROM `region` WHERE `country_id` = 9908")->getManyArray('region_id');
		$_POST['users'] = Db::instance()->query("SELECT * FROM `user`")->getManyArray();
		$_POST['types'] = Db::instance()->query("SELECT * FROM `client_type`")->getManyArray();
		$_POST['services'] = Db::instance()->query("SELECT * FROM `client_service`")->getManyArray();
		$_POST['aftermaths'] = Db::instance()->query("SELECT * FROM `client_aftermath`")->getManyArray();
		$_POST['clients'] = Db::instance()->query("SELECT * FROM `client` WHERE `status` = 1 AND`id` != ".intVal($_GET['id']))->getManyArray();
		$_POST['aftermath'] = Db::instance()->query("SELECT `id`, `id_aftermath` FROM `client_aftermath_list` WHERE `id_client` = ".intVal($_GET['id']))->getFieldArray("id_aftermath");
		$_POST['partners'] = Db::instance()->query("SELECT * FROM `partner` WHERE `status` = 1")->getManyArray();

		Page::instance()->parse("client_add", $_POST)->show();
	break;	
	case "user":
		$id = intVal($_GET['id']);
		Log::add("view", "user", $id);
		$user = Db::instance()->query("SELECT
			`u`.*,
			`g`.`name` as `group`
		FROM `user` `u`
		LEFT JOIN `group` `g` ON `g`.`id` = `u`.`id_group`
		WHERE `u`.`id` = '".$id."' AND `status` = 1")->getOneArray();
		if(!$user){
			Page::instance()->parse("user_none")->show();
			die();
		}
		$user['events'] = Db::instance()->query("SELECT
			`e`.*,
			`c`.`fio` as `client`
			FROM `event` `e`
			LEFT JOIN `client` `c` ON `c`.`id` = `e`.`id_client`
			WHERE (`e`.`id_user` = ".$id." OR `e`.`id` IN (
				SELECT `id_event` FROM `event_add_user` WHERE `id_user` = '".$id."' AND type = 'u'
			)) AND `e`.`status` != 3")->getManyArray();
		$user['links'] = Db::instance()->query("SELECT `l`.*, `c`.`fio` as `client` FROM `link` `l` LEFT JOIN `client` `c` ON `c`.`id` = `l`.`id_client` WHERE `l`.`type` = 'u' AND `l`.`id_partner` = ".$id." AND `l`.`status` != 2 AND `c`.`status` = 1")->getManyArray();
		$user['patrons'] = Db::instance()->query("SELECT
			`id`, `fio`
			FROM `client`
			WHERE `patron` = '".$user['id']."' AND `status` = 1")->getManyArray();
		Page::instance()->parse("user", $user)->show();
	break;
	case "users":
		Log::add("view", "user", 0);
		Page::instance()->parse("users")->show();
	break;
	case "user_add":
		if(count($_POST)){
			$id = Db::instance()->query("INSERT INTO `user` SET 
				`fio` = '".mysql_real_escape_string($_POST['fio'])."',
				`email` = '".mysql_real_escape_string($_POST['email'])."',
				`phone` = '".mysql_real_escape_string($_POST['phone'])."',
				`id_group` = '".mysql_real_escape_string($_POST['group'])."',
				`password` = '".User::_hash($_POST['pass'])."'
			")->insertId();
			Log::add("add", "user", $id);
			header("Location: /?page=users");
			die();
		}
		$_POST['groups'] = Db::instance()->query("SELECT * FROM `group`")->getManyArray();
		Page::instance()->parse("user_add", $_POST)->show();
	break;
	case "user_edit":
		if(count($_POST)){
			Db::instance()->query("UPDATE `user` SET 
				`fio` = '".mysql_real_escape_string($_POST['fio'])."',
				`email` = '".mysql_real_escape_string($_POST['email'])."',
				`phone` = '".mysql_real_escape_string($_POST['phone'])."',
				`id_group` = '".mysql_real_escape_string($_POST['group'])."'
			WHERE `id` = '".intVal($_POST['id'])."'");
			Log::add("edit", "user", $_POST['id']);
			if(!empty($_POST['pass'])){
				Db::instance()->query("UPDATE `user` SET 
					`password` = '".User::_hash($_POST['pass'])."'
				WHERE `id` = '".intVal($_POST['id'])."'");
			}
			header("Location: /?page=users");
			die();
		}else{
			$_POST = Db::instance()->query("SELECT * FROM `user` WHERE `id` = ".intVal($_GET['id']))->getOneArray();
		}
		$_POST['groups'] = Db::instance()->query("SELECT * FROM `group`")->getManyArray();
		Page::instance()->parse("user_add", $_POST)->show();
	break;
	case "group_add":
		if(count($_POST)){
			$group_id = Db::instance()->query("INSERT INTO `group` SET `name` = '".mysql_real_escape_string($_POST['name'])."'")->insertId();
			Log::add("add", "group", $group_id);
			foreach ($_POST['permission'] as $perm) {
				Db::instance()->query("INSERT INTO `group_permission` SET `id_group` = '".$group_id."', `id_permission` = '".$perm."'");
			}
			header("Location: /?page=groups");
			die();
		}
		$_POST['perm_groups'] = Db::instance()->query("SELECT * FROM `permission_group`")->getManyArray();
		foreach($_POST['perm_groups'] as $k => $group){
			$_POST['perm_groups'][$k]['permissions'] = Db::instance()->query("SELECT * FROM `permission` WHERE `id_group` = ".$group['id'])->getManyArray();
		}
		Page::instance()->parse("group_add", $_POST)->show();
	break;
	case "partner_group_add":
		if(count($_POST)){
			$id = Db::instance()->query("INSERT INTO `partner_group` SET `title` = '".mysql_real_escape_string($_POST['name'])."'")->insertId();
			Log::add("add", "partner_group", $id);
			header("Location: /?page=partner_groups");
			die();
		}
		Page::instance()->parse("partner_group_add", $_POST)->show();
	break;
	case "group":
		$group_id = intVal($_GET['id']);
		Log::add("view", "partner_group", $group_id);
		if(count($_POST)){
			Db::instance()->query("UPDATE `group` SET `name` = '".mysql_real_escape_string($_POST['name'])."' WHERE `id` = '".$group_id."'");
			Db::instance()->query("DELETE FROM `group_permission` WHERE `id_group` = '".$group_id."'");
			foreach ($_POST['permission'] as $perm) {
				Db::instance()->query("INSERT INTO `group_permission` SET `id_group` = '".$group_id."', `id_permission` = '".$perm."'");
			}
			header("Location: /?page=groups");
			die();
		}else{
			$_POST = Db::instance()->query("SELECT * FROM `group` WHERE `id` = ".$group_id)->getOneArray();
		}
		$_POST['permissions_group'] = Db::instance()->query("SELECT * FROM `group_permission` WHERE `id_group` = ".$group_id)->getFieldArray("id_permission");
		$_POST['perm_groups'] = Db::instance()->query("SELECT * FROM `permission_group`")->getManyArray();
		foreach($_POST['perm_groups'] as $k => $group){
			$_POST['perm_groups'][$k]['permissions'] = Db::instance()->query("SELECT * FROM `permission` WHERE `id_group` = ".$group['id'])->getManyArray();
		}
		Page::instance()->parse("group_add", $_POST)->show();
	break;
	case "past_events":
		$result = Array();
		$result['past_events'] = Db::instance()->query("SELECT * FROM `event` WHERE `id_user` = '".User::getId()."' AND `status` = 0 AND DATE(NOW()) >= DATE(`start_date`)")->getManyArray();
		Page::instance()->parse("past_events", $result)->show();
	break;
	default:
		Page::instance()->parse("404")->show();
	break;
}
?>