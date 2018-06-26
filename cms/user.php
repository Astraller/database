<?php
class User{

	protected static $page2rights = Array(
		"users" => "USER_VIEW",
		"user" => "USER_VIEW",
		"user_add" => "USER_ADD",
		"user_edit" => "USER_EDIT",
		"groups" => "USER_VIEW",
		"group_add" => "USER_ADD",
		"group" => "USER_EDIT",
		"user_delete" => "USER_DELETE",
		"group_delete" => "USER_DELETE",

		"clients" => "CLIENT_VIEW",
		"client_add" => "CLIENT_ADD",
		"client" => "CLIENT_VIEW",
		"client_edit" => "CLIENT_EDIT",
		"create_link" => "CLIENT_LINK",
		"client_delete" => "CLIENT_DELETE",
		"link_delete" => "CLIENT_LINK",
		"link_approve" => "CLIENT_LINK",

		"partners" => "PARTNER_VIEW",
		"partner_add" => "PARTNER_ADD",
		"partner" => "PARTNER_VIEW",
		"partner_edit" => "PARTNER_EDIT",
		"partner_delete" => "PARTNER_DELETE",
		"partner_groups" => "PARTNER_VIEW",
		"partner_group_add" => "PARTNER_ADD",
		"partner_group" => "PARTNER_EDIT",
		"partner_group_delete" => "PARTNER_DELETE",

		"calendar" => "CALENDAR_OWNER",
		"add_event" => "CALENDAR_OWNER",
		"event" => "CALENDAR_OWNER",
		"event_edit" => "CALENDAR_OWNER",
		"event_delete" => "CALENDAR_DELETE",
		"past_events" => "CALENDAR_OWNER",

		"raport" => "REPORT_VIEW",
		"settings" => "SETTINGS_CANGE",
	);

	protected static $excludedPages = Array(
		"",
		"login",
		"logout",
		"profile",
		"settings"
	);

	const _salt = "54j56K57";

	public static function isLogged(){
		if(isset($_SESSION['user'])){
			return true;
		}else{
			return false;
		}
	}

	public static function checkRigths($page){
		if(self::isLogged() AND !self::getStatus()){
			Page::instance()->parse("auth_block")->showClear();
			die();
		}
		if(in_array($page, self::$excludedPages))
			return true;
		if(($page == "user_edit" OR $page == "user_delete") AND 
			 (self::getId() != 6 AND $_GET['id'] == 6))
			return false;

		return self::getRight(self::$page2rights[$page]);
	}

	public static function getRight($right){
		return Db::instance()->query("SELECT COUNT(`gr`.`id`) as `cnt` 
			FROM 
				`group_permission` `gr` 
			LEFT JOIN `permission` `p` ON `p`.`id` = `gr`.`id_permission`
			WHERE `p`.`code` = '".$right."' AND `gr`.`id_group` = ".self::getGroup())->getField("cnt");
	}

	public static function logout(){
		session_destroy();
		setcookie("autologin", null, time()-1);
		header("Location: /");
	}

	public static function login($email, $password){
		$email_fixed = self::_fix_email($email);
		$password_fixed = self::_hash($password);
		$result = Db::instance()->query("SELECT id FROM user WHERE `email` = '".$email_fixed."' AND `password` = '".$password_fixed."' AND `status` = 1")->getField("id");
		if($result){
			$_SESSION['user'] = $result;
			setcookie("autologin", $result, time()+60*60*24);
			return true;
		}else{
			return false;
		}
	}

	private static function _fix_email($email){
		return preg_replace("#[^a-z0-9-_.@]#iu", "", $email);
	}

	public static function _hash($password){
		return sha1($password.self::_salt);
	}

	public static function checkAutoLogin(){
		if(isset($_COOKIE['autologin'])){
			$_SESSION['user'] = $_COOKIE['autologin'];
		}
	}

	public static function checkLogin(){
		if(!self::isLogged()){
			header("Location: /?page=login");
			die();
		}
		return true;
	}

	public static function getId(){
		return $_SESSION['user'];
	}

	public static function getGroup(){
		return Db::instance()->query("SELECT `id_group` FROM `user` WHERE `id` = ".self::getId())->getField("id_group");
	}

	public static function getFio(){
		return Db::instance()->query("SELECT `fio` FROM `user` WHERE `id` = ".self::getId())->getField("fio");
	}

	public static function getPartnerId(){
		return intVal(Db::instance()->query("SELECT `id` FROM `partner` WHERE `id_user` = ".self::getId())->getField("id"));
	}

	public static function getStatus(){
		return intVal(Db::instance()->query("SELECT `status` FROM `user` WHERE `id` = ".self::getId())->getField("status"));
	}
}
?>