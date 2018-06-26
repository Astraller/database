        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Событие: <?=$this->title?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Участники
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item" style="overflow:hidden">
                                    <i class="fa fa-star fa-fw"></i> <b>Сотрудник:</b>
                                    <span class="pull-right text-muted">
                                        <a href="/?page=user&id=<?=$this->id_user?>"><?=$this->user?></a>
                                        <?foreach($this->add_users as $user):?>, <a href="/?page=user&id=<?=$user['id']?>"><?=$user['fio']?></a><?endforeach;?>
                                        <?foreach($this->add_partners as $partner):?>, <a href="/?page=partner&id=<?=$partner['id_user']?>"><?=$partner['title']?></a><?endforeach;?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-inbox fa-fw"></i> <b>Тип события:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->type?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-flag fa-fw"></i> <b>Локация:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->id_location!=0?$this->location:"Другая"?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-home fa-fw"></i> <b>Город:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->id_city!=0?$this->city:"Другой"?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-user fa-fw"></i> <b>Реабилитант:</b>
                                    <span class="pull-right text-muted">
                                        <?=$this->id_client!=0?"<a href='/?page=client&id=".$this->id_client."'>".$this->client."</a>":"Нет"?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?if(!empty($this->comment)):?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-info fa-fw"></i> Описание
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?=$this->comment?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <?endif;?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Выполнение события
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?if($this->status == 0):?>
                            <form method="POST" role="form">
                            <div class="list-group">
                                <label class="list-group-item list-group-item-success">
                                    <input type="radio" name="status" value="1" /> Выполнено
                                </label>
                                <label class="list-group-item list-group-item-danger">
                                    <input type="radio" name="status" value="2" /> Не выполнено
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                            </form>
                        <?elseif($this->status == 1):?>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-success">
                                    <b>Выполнено</b>
                                </div>
                            </div>
                        <?else:?>
                            <div class="list-group">
                                <div class="list-group-item list-group-item-danger">
                                    <b>Не выполнено</b>
                                </div>
                            </div>
                        <?endif;?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Дата и время проведения
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <i class="fa fa-calendar fa-fw"></i> Дата события
                                    <span class="pull-right text-muted">
                                        <?=explode(" ", $this->start_date)[0]?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-clock-o fa-fw"></i> Начало
                                    <span class="pull-right text-muted">
                                        <?=explode(" ", $this->start_date)[1]?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-clock-o fa-fw"></i> Завершение
                                    <span class="pull-right text-muted">
                                        <?=explode(" ", $this->end_date)[1]?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <i class="fa fa-check fa-fw"></i> Статус
                                    <span class="pull-right text-muted">
                                        <?if(strtotime($this->start_date) > time()):?>
                                        Еще не началось
                                        <?elseif(strtotime($this->end_date) > time()):?>
                                        В процессе
                                        <?else:?>
                                        Прошло
                                        <?endif;?>
                                    </span>
                                </div>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel .chat-panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Управление
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <a href="/?page=event_edit&id=<?=$this->id; ?>" class="btn btn-primary">Редактировать</a>
                            <a href="/?page=event_delete&id=<?=$this->id; ?>" onclick="return confirm('Вы действительно хотите удалить это событие?');" class="btn btn-danger">Удалить</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>