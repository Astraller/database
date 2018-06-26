        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Партнер: <?=$this->title?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Контакты
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?=nl2br($this->contacts)?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-medkit fa-fw"></i> Услуги
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?=nl2br($this->services)?>
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
                    <?if(count($this->links)):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> Реабилитанты
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <?foreach($this->links as $link):?>
                                <div class="list-group-item" <?=$link['status']==0?'style="opacity:0.5" title="Связь не подтверждена"':''?>>
                                    <a href="/?page=client&id=<?=$link['id_client']?>"><?=$link['client']?></a>
                                    <span class="pull-right">
                                        <?if(strtotime($link['start_date']) != 0):?>
                                        <em class="muted">
                                            <?=date("d.m.Y", strtotime($link['start_date']))?>
                                        </em>
                                        <?endif;?>
                                        <?if((($link['id_partner'] == User::getPartnerId() AND $link['type'] == "p") OR User::getGroup() == 1) AND $link['status'] == 0):?>
                                            <a style="font-size:50%;" title="Подтвердить связь" href="/?page=link_approve&id=<?=$link['id']; ?>" onclick="return confirm('Подтвердить связь?');" class="btn btn-success"><span class="fa fa-check"></span></a>
                                        <?endif;?>
                                        <a style="font-size:50%;" title="Удалить связь" href="/?page=link_delete&id=<?=$link['id']; ?>" onclick="return confirm('Вы действительно хотите отменить эту связь?');" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                    </span>
                                </div>
                                <?endforeach;?>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?endif;?>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-link fa-fw"></i> Связи
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    Группа:
                                    <span class="pull-right text-muted">
                                        <?if(empty($this->group)):?>
                                            Вне групп
                                        <?else:?>
                                            <?=$this->group?>
                                        <?endif;?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    Координатор:
                                    <span class="pull-right text-muted">
                                        <?if(empty($this->user)):?>
                                            Не указан
                                        <?else:?>
                                            <a href="/?page=user&id=<?=$this->id_user?>"><?=$this->user?></a>
                                        <?endif;?>
                                    </span>
                                </div>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?if(!empty($this->image)):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-image fa-fw"></i> Логотип
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <center>
                                <img src="/uploads/<?=$this->image?>" style="max-width:100%;" />
                            </center>
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
                            <a href="/?page=partner_edit&id=<?=$this->id; ?>" class="btn btn-primary">Редактировать</a>
                            <a href="/?page=partner_delete&id=<?=$this->id; ?>" onclick="return confirm('Вы действительно хотите удалить этого партнера?');" class="btn btn-danger">Удалить</a>
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
                                <?=$event['user']?>
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