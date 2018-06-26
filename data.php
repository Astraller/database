<?php
session_start();
include "cms/config.php";
include "cms/db.php";
include "cms/user.php";
include "cms/page.php";
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("Europe/Kiev");

if(!User::isLogged())die("No permissions found!");

switch($_GET['type']){
	case "partners":
		include "inc/data_partners.php";
	break;
	case "groups":
		include "inc/data_groups.php";
	break;
	case "partner.groups":
		include "inc/data_partner_groups.php";
	break;
	case "users":
		include "inc/data_users.php";
	break;
	case "clients":
		include "inc/data_clients.php";
	break;
	case "requests":
		include "inc/json_requests.php";
	break;
	case "batalions":
		include "inc/json_batalions.php";
	break;
	case "city":
		$cities = Db::instance()->query("SELECT * FROM `city` WHERE `region_id` = ".intVal($_GET['region']))->getManyArray("city_id");
		foreach($cities as $city){
			echo "<option value='".$city['city_id']."'>".$city['name']."</option>";
		}
	break;
	case "calendar":
		include "inc/data_calendar.php";
	break;
}
?>