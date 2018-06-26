<table>
<?
include "cms/config.php";
include "cms/db.php";

		$partners = Db::instance()->query("SELECT 
			`p`.*,
			`u`.`fio` as `user`,
			`pg`.`title` as `group`
		FROM `partner` `p` 
		LEFT JOIN `user` `u` ON `u`.`id` = `p`.`id_user`
		LEFT JOIN `partner_group` `pg` ON `pg`.`id` = `p`.`id_group` WHERE `p`.`status` = 1")->getManyArray();
foreach($partners as $client){
	echo "<tr><td>".$client['title']."</td>".
		 "<td>".$client['contacts']."</td>".
		 "<td>".$client['services']."</td>".
		 "<td>".$client['description']."</td>".
		 "<td>".$client['user']."</td>".
		 "<td>".$client['contacts']."</td>".
		 "<td>".$client['group']."</td></tr>";
}
?>
</table>