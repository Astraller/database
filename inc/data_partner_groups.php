<?php

    if($_GET['search']['value']){
        $where = "`title` LIKE '%".$_GET['search']['value']."%'";
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
                $order[$key] = "`title`";
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

    $sql = "SELECT `g`.* FROM `partner_group` `g` WHERE ".$where." ORDER BY ".$order." LIMIT ".intVal($_GET['start']).",".intVal($_GET['length']);

    $groups = Db::instance()->query($sql)->getManyArray();

    $result = Array();
    $result['draw'] = $_GET['draw'];
    $result['recordsTotal'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `partner_group`")->getField('cnt');
    $result['recordsFiltered'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `partner_group` WHERE ".$where)->getField('cnt');
    $result['data'] = Array();
    foreach($groups as $group){
        $cnt = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `partner` WHERE `id_group` = ".$group['id'])->getField("cnt");
        $result['data'][] = Array(
            $group['id'],
            $group['title'],
            $cnt,
            '<a href="?page=partner_group&id='.$group['id'].'" class="btn btn-primary">Редактировать</a>'.($cnt==0?
            '<a href="?page=partner_group_delete&id='.$group['id'].'" onclick="return confirm(\'Вы уверены что хотите удалить эту группу?\');" title="Удалить" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>':'')
        );
    }
    Page::JSON($result);
?>