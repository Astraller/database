<?
$vars = Array(
);
if(count($_POST) AND !empty($_POST['start_date']) AND !empty($_POST['end_date'])){
	list($day, $month, $year) = explode(".", $_POST['start_date']);
	$start_date = $year."-".$month."-".$day." 00:00:00";
	list($day, $month, $year) = explode(".", $_POST['end_date']);
	$end_date = $year."-".$month."-".$day." 00:00:00";

	$vars['clients'] = Db::instance()->query("SELECT DATE(`date_in`) as `date`, count(*) as `cnt` FROM `client` WHERE `status` = 1 AND `date_in` >= '".$start_date."' AND `date_in` <= '".$end_date."' GROUP BY `date`")->getFieldArray("cnt", "date");
	$vars['events'] = Db::instance()->query("SELECT DATE(`start_date`) as `date`, count(*) as `cnt` FROM `event` WHERE `status` != 3 AND `start_date` >= '".$start_date."' AND `start_date` <= '".$end_date."' GROUP BY `date`")->getFieldArray("cnt", "date");
	$vars['links'] = Db::instance()->query("SELECT DATE(`start_date`) as `date`, count(*) as `cnt` FROM `link` WHERE `status` = 1 AND `start_date` >= '".$start_date."' AND `start_date` <= '".$end_date."' GROUP BY `date`")->getFieldArray("cnt", "date");
	$vars['start_date'] = strtotime($start_date);
	$vars['end_date'] = strtotime($end_date);
}
Page::instance()->parse("report/incoming", $vars)->show();