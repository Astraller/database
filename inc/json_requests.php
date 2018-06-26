<?
	$matches = Db::instance()->query("SELECT `id`, `title` FROM `client_requests`")->getManyArray();
	$result = Array();
	foreach($matches as $match){
		$result[] = $match['title'];
	}
	Page::JSON($result);
?>