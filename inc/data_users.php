<?php

    if($_GET['search']['value']){
        $where = "`fio` LIKE '%".$_GET['search']['value']."%' OR `email` LIKE  '%".$_GET['search']['value']."%'";
    }else{
        $where = "`status` = 1";
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
            case 4:
                $order[$key] = "`id_group`";
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

    $sql = "SELECT * FROM `user` WHERE ".$where." ORDER BY ".$order." LIMIT ".intVal($_GET['start']).",".intVal($_GET['length']);

    $users = Db::instance()->query($sql)->getManyArray();

    $result = Array();
    $result['draw'] = $_GET['draw'];
    $result['recordsTotal'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `user`")->getField('cnt');
    $result['recordsFiltered'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `user` WHERE ".$where)->getField('cnt');
    $result['data'] = Array();
    foreach($users as $user){
        $result['data'][] = Array(
            $user['id'],
            $user['fio'],
            $user['email'],
            $user['phone'],
            Db::instance()->query("SELECT `name` FROM `group` WHERE `id` = ".$user['id_group'])->getField("name"),
                (User::getRight("USER_EDIT")?'<a href="?page=user_edit&id='.$user['id'].'" class="btn btn-primary" title="Редактировать"><span class="fa fa-pencil"></span></a>':'').
                (User::getRight("USER_VIEW")?' <a href="?page=user&id='.$user['id'].'" class="btn btn-success" title="Подробнее"><span class="fa fa-eye"></span></a> ':'').
                (User::getRight("USER_DELETE")?' <a href="?page=user_delete&id='.$user['id'].'" onclick="return confirm(\'Вы уверены что хотите удалить этого сотрудника?\');" title="Удалить" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>':'')
        );
    }
    Page::JSON($result);
?>