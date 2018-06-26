<?php
class Log{

	public static function add($type, $target, $target_id){
		$type_id = Db::instance()->query("SELECT `id` FROM `log_type` WHERE `title` = '".$type."'")->getField("id");
		Db::instance()->query("
			INSERT INTO `log` SET 
				`id_type` = '".$type_id."',
				`target_type` = '".$target."',
				`target_id` = '".$target_id."',
				`id_user` = '".User::getId()."',
				`datetime` = NOW()
		");
	}

}