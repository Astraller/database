<?
	$matches = Db::instance()->query("SELECT `id`, `title` FROM `client_batalions`")->getManyArray();
	$result = Array();
	foreach($matches as $match){
		$result[] = $match['title'];
	}
	Page::JSON($result);
?>