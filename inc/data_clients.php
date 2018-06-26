<?php

    if($_GET['search']['value']){
        $where = "`cl`.`fio` LIKE '%".$_GET['search']['value']."%'";
    }else{
        $where = "`cl`.`status` = 1";
    }
    $order = Array();
    foreach($_GET['order'] as $key => $ordert){
        switch($ordert['column']){
            case 0:
                $order[$key] = "`id`";
            break;
            case 1:
                $order[$key] = "`fio`";
            break;
            case 3:
                $order[$key] = "`date_in`";
            break;
            case 4:
                $order[$key] = "`id_type`";
            break;
            case 5:
                $order[$key] = "`cl`.`patron`";
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

    $sql = "SELECT 
            `cl`.*, 
            `ci`.`name` as `city`,
            `ct`.`title` as `type`,
            `u`.`fio` as `patron`
        FROM `client` `cl` 
        LEFT JOIN `city` `ci` ON `ci`.`city_id` = `cl`.`id_city` 
        LEFT JOIN `region` `ri` ON `ri`.`region_id` = `cl`.`id_region` 
        LEFT JOIN `client_type` `ct` ON `ct`.`id` = `cl`.`id_type`
        LEFT JOIN `user` `u` ON `u`.`id` = `cl`.`patron`
        WHERE ".$where." ORDER BY ".$order." LIMIT ".intVal($_GET['start']).",".intVal($_GET['length']);

    $users = Db::instance()->query($sql)->getManyArray();

    $result = Array();
    $result['draw'] = $_GET['draw'];
    $result['recordsTotal'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `client` WHERE `status` = 1")->getField('cnt');
    $result['recordsFiltered'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `client` `cl` WHERE ".$where)->getField('cnt');
    $result['data'] = Array();
    foreach($users as $user){
        $result['data'][] = Array(
            $user['id'],
            $user['fio'],
            $user['phone'],
            date("d.m.Y", strtotime($user['date_in'])),
            $user['type'],
            $user['patron'],
            (User::getRight("CLIENT_VIEW")?'<a href="?page=client&id='.$user['id'].'" class="btn btn-success" title="Подробная информация"><span class="fa fa-eye"></span></a>':'').
            (User::getRight("CLIENT_LINK")?'<a href="?page=create_link&client='.$user['id'].'" class="btn btn-warning" title="Направить к партнеру"><span class="fa fa-external-link"></span></a><br />':'').
            (User::getRight("CLIENT_EDIT")?'<a href="?page=client_edit&id='.$user['id'].'" class="btn btn-primary" title="Редактировать"><span class="fa fa-pencil"></span></a>':'').
            (User::getRight("CLIENT_DELETE")?'<a href="?page=client_delete&id='.$user['id'].'" class="btn btn-danger" title="Удалить"><span class="fa fa-remove"></span></a>':'')
        );
    }
    Page::JSON($result);
?>