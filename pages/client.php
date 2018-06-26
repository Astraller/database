        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Реабилитант: <?=$this->fio?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Личные данные
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <b>ФИО:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->fio?>
                                    </span>
                                </div>
                                <div class="list-group-item" style="overflow:hidden">
                                    <b>Адрес:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->region?>, <?=$this->city?>, <?=$this->address?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Телефон:</b>
                                    <span class="pull-right text-muted">
                                        <?=empty($this->phone)?"Не указан":$this->phone?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Семья:</b>
                                    <span class="pull-right text-muted">
                                        <?=empty($this->family)?"Не указано":$this->family?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Дата рождения:</b>
                                    <span class="pull-right text-muted">
                                        <?=strtotime($this->date_birth)<=0?"Не указана":date("d.m.Y", strtotime($this->date_birth))?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-medkit fa-fw"></i> Реабилитация
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <b>Направлен к нам:</b>
                                    <span class="pull-right text-muted">
                                        <?if($this->id_partner == 0):?>
                                            Нашел нас сам
                                        <?else:?>
                                            <a href="/?page=partner&id=<?=$this->id_partner?>"><?=$this->partner?></a>
                                        <?endif;?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Патронаж:</b>
                                    <span class="pull-right text-muted">
                                        <a href="/?page=user&id=<?=$this->patron?>"><?=$this->patron_name?></a>
                                    </span>
                                </div>
                                <div class="list-group-item" style="overflow:hidden">
                                    <b>Запрос:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->request?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>В работе с:</b>
                                    <span class="pull-right text-muted">
                                        <?=date("d.m.Y", strtotime($this->date_in))?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Добавлен в систему:</b>
                                    <span class="pull-right text-muted">
                                        <?=date("d.m.Y", strtotime($this->date_add))?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Последнее редактирование:</b>
                                    <span class="pull-right text-muted">
                                        <?=strtotime($this->date_edit)==0?"Никогда":date("d.m.Y", strtotime($this->date_edit))?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?if(!empty($this->description)):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-info fa-fw"></i> Комментарий
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?=$this->description?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?endif;?>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-star fa-fw"></i> Служба
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    Тип:
                                    <span class="pull-right text-muted">
                                        <?=$this->type?>
                                    </span>
                                </div>
                                <?if($this->id_type == 1):?>
                                    <div class="list-group-item">
                                        Статус:
                                        <span class="pull-right text-muted">
                                            <?=empty($this->service)?"Нет":$this->service?>
                                        </span>
                                    </div>
                                    <div class="list-group-item">
                                        Последствия:
                                        <span class="pull-right text-muted">
                                            <?=!count($this->aftermaths)?"Нет":implode(", ", $this->aftermaths)?>
                                        </span>
                                    </div>
                                    <div class="list-group-item">
                                        Батальон/ВЧ:
                                        <span class="pull-right text-muted">
                                            <?=$this->batalion?>
                                        </span>
                                    </div>
                                <?elseif($this->id_type == 6):?>
                                <?else:?>
                                    <div class="list-group-item">
                                        Относится к:
                                        <span class="pull-right text-muted">
                                            <?if(empty($this->parent)):?>
                                                Не прикреплен
                                            <?else:?>
                                                <a href="/?page=client&id=<?=$this->id_parent?>"><?=$this->parent?></a>
                                            <?endif;?>
                                        </span>
                                    </div>
                                <?endif;?>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?if(count($this->childs)):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-link fa-fw"></i> Родственники
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?foreach($this->childs as $child):?>
                                <div class="list-group-item">
                                    <?=$child['type']?>
                                    <span class="pull-right text-muted">
                                        <a href="/?page=client&id=<?=$child['id']?>"><?=$child['fio']?></a>
                                    </span>
                                </div>
                                <?endforeach;?>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?endif;?>
                    <?if(count($this->links)):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-inbox fa-fw"></i> Передан
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?foreach($this->links as $link):?>
                                <div class="list-group-item" <?=$link['status']==0?'style="opacity:0.5" title="Связь не подтверждена"':''?>>
                                    <?if($link['type'] == "p"):?>
                                    Партнеру: <a href="/?page=partner&id=<?=$link['id_partner']?>"><?=$link['partner']?></a>
                                    <span class="pull-right">
                                        <?if(strtotime($link['start_date']) != 0):?>
                                        <em class="muted">
                                            <?=date("d.m.Y", strtotime($link['start_date']))?>
                                        </em>
                                        <?endif;?>
                                        <a style="font-size:50%;" title="Удалить связь" href="/?page=link_delete&id=<?=$link['id']; ?>" onclick="return confirm('Вы действительно хотите отменить эту связь?');" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                    </span>
                                    <?else:?>
                                    Сотруднику: <a href="/?page=user&id=<?=$link['id_partner']?>"><?=$link['upartner']?></a>
                                    <span class="pull-right">
                                        <?if(strtotime($link['start_date']) != 0):?>
                                        <em class="muted">
                                            <?=date("d.m.Y", strtotime($link['start_date']))?>
                                        </em>
                                        <?endif;?>
                                        <a style="font-size:50%;" title="Удалить связь" href="/?page=link_delete&id=<?=$link['id']; ?>" onclick="return confirm('Вы действительно хотите отменить эту связь?');" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                    </span>
                                    <?endif;?>
                                </div>
                                <?endforeach;?>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?endif;?>
                    <!-- /.panel .chat-panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Управление
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?if(User::getRight("CLIENT_LINK")):?>
                                <a href="/?page=create_link&client=<?=$this->id; ?>" class="btn btn-warning">Направить</a>
                            <?endif;?>
                            <?if(User::getRight("CLIENT_EDIT")):?>
                                <a href="/?page=client_edit&id=<?=$this->id; ?>" class="btn btn-primary">Редактировать</a>
                            <?endif;?>
                            <?if(User::getRight("CLIENT_DELETE")):?>
                                <a href="/?page=client_delete&id=<?=$this->id; ?>" onclick="return confirm('Вы действительно хотите удалить этого реабилитанта?');" class="btn btn-danger">Удалить</a>
                            <?endif;?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <?if(count($this->events)):?>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-calendar fa-fw"></i> События
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?foreach($this->events as $event):?>
                    <div class="list-group col-lg-6">
                        <div class="list-group-item list-group-item-info">
                            Название
                            <span class="pull-right text-muted">
                                <a href="/?page=event&id=<?=$event['id']?>"><?=$event['title']?></a>
                            </span>
                        </div>
                        <?if(!empty($event['id_partner'])):?>
                        <div class="list-group-item">
                            Партнер
                            <span class="pull-right text-muted">
                                <a href="/?page=partner&id=<?=$event['id_partner']?>"><?=$event['partner']?></a>
                            </span>
                        </div>
                        <?else:?>
                        <div class="list-group-item">
                            Сотрудник
                            <span class="pull-right text-muted">
                                <a href="/?page=partner&id=<?=$event['id_user']?>"><?=$event['user']?></a>
                            </span>
                        </div>
                        <?endif;?>
                        <div class="list-group-item">
                            Дата
                            <span class="pull-right text-muted">
                                <?=date("d.m.Y", strtotime($event['start_date']))?>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Время
                            <span class="pull-right text-muted">
                                <?=date("H:i", strtotime($event['start_date']))?>-<?=date("H:i", strtotime($event['end_date']))?>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Статус
                            <?if($event['status'] == 1):?>
                            <span class="pull-right text-success">
                                <b>Прошло</b>
                            </span>
                            <?elseif($event['status'] == 2):?>
                            <span class="pull-right text-danger">
                                <b>Не прошло</b>
                            </span>
                            <?else:?>
                            <span class="pull-right text-muted">
                                Не установлен
                            </span>
                            <?endif;?>
                        </div>
                    </div>
                    <?endforeach;?>
                    <!-- /.list-group -->
                </div>
            </div>
            <?endif;?>
        </div>
        <!-- /#page-wrapper -->

    </div>