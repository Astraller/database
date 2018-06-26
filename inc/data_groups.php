<?php

    if($_GET['search']['value']){
        $where = "`name` LIKE '%".$_GET['search']['value']."%'";
    }else{
        $where = "1=1";
    }
    $order = Array();
    foreach($_GET['order'] as $key => $ordert){
        switch($ordert['column']){
            case 0:
                $order[$key] = "`id`";
            break;
            case 1:
                $order[$key] = "`name`";
            break;
        }
        switch($ordert['dir']){
            case "asc":
                $order[$key] .= " ASC";
            break;
            case "desc":
                $order[$key] .= " DESC";
            break;
        }
    }
    
    $order = implode(", ", $order);

    $sql = "SELECT `g`.* FROM `group` `g` WHERE `status` = 1 AND ".$where." ORDER BY ".$order." LIMIT ".intVal($_GET['start']).",".intVal($_GET['length']);

    $groups = Db::instance()->query($sql)->getManyArray();

    $result = Array();
    $result['draw'] = $_GET['draw'];
    $result['recordsTotal'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `group`")->getField('cnt');
    $result['recordsFiltered'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `group` WHERE ".$where)->getField('cnt');
    $result['data'] = Array();
    foreach($groups as $group){
        $cnt = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `user` WHERE `id_group` = ".$group['id'])->getField("cnt");
        $result['data'][] = Array(
            $group['id'],
            $group['name'],
            $cnt,
            '<a href="?page=group&id='.$group['id'].'" class="btn btn-primary">Редактировать</a>'.($cnt==0?
            ' <a href="?page=group_delete&id='.$group['id'].'" onclick="return confirm(\'Вы уверены что хотите удалить эту группу?\');" title="Удалить" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>':'')
        );
    }
    Page::JSON($result);
?>