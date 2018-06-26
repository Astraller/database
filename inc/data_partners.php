<?php

    if($_GET['search']['value']){
        $where = "`p`.`status` = 1 AND `p`.`title` LIKE '%".$_GET['search']['value']."%'";
    }else{
        $where = "`p`.`status` = 1";
    }
    $order = Array();
    foreach($_GET['order'] as $key => $ordert){
        switch($ordert['column']){
            case 0:
                $order[$key] = "`p`.`id`";
            break;
            case 5:
                $order[$key] = "`p`.`id_user`";
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

    $sql = "SELECT `p`.*, `u`.`fio` as `user` FROM `partner` `p` LEFT JOIN `user` `u` ON `u`.`id` = `p`.`id_user` WHERE ".$where." ORDER BY ".$order." LIMIT ".intVal($_GET['start']).",".intVal($_GET['length']);

    $partners = Db::instance()->query($sql)->getManyArray();

    $result = Array();
    $result['draw'] = $_GET['draw'];
    $result['recordsTotal'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `partner` `p`")->getField('cnt');
    $result['recordsFiltered'] = Db::instance()->query("SELECT COUNT(*) as `cnt` FROM `partner` `p` WHERE ".$where)->getField('cnt');
    $result['data'] = Array();
    foreach($partners as $partner){
        if(!empty($partner['image']) AND is_readable("./uploads/".$partner['image'])){
            $image = "<img src='./uploads/".$partner['image']."?".mt_rand(1,1000)."' />";
        }else{
            $image = "Нет изображения";
        }
        $group = Db::instance()->query("SELECT `title` FROM `partner_group` WHERE `id` = '".$partner['id_group']."'")->getField("title");
        $result['data'][] = Array(
            $partner['id'],
            "<div class='logotype'>".$image."</div>",
            $partner['title'],
            nl2br($partner['contacts']),
            nl2br($partner['services']),
            empty($partner['user'])?"Нет":$partner['user'],
            $group,
            (User::getRight("PARTNER_EDIT")?'<a href="?page=partner_edit&id='.$partner['id'].'" class="btn btn-primary" title="Редактировать"><span class="fa fa-pencil"></span></a> ':'').
            (User::getRight("PARTNER_VIEW")?'<a href="?page=partner&id='.$partner['id'].'" class="btn btn-success" title="Подробнее"><span class="fa fa-eye"></span></a> ':'').
            (User::getRight("PARTNER_DELETE")?'<a href="?page=partner_delete&id='.$partner['id'].'" onclick="return confirm(\'Вы уверены что хотите удалить этого партнера?\');" title="Удалить" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>':'')
        );
    }
    Page::JSON($result);
?>