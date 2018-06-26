        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Сотрудник: <?=$this->fio?></h1>
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
                                <div class="list-group-item">
                                    <b>Телефон:</b>
                                    <span class="pull-right text-muted">
                                        <?=empty($this->phone)?"Не указан":$this->phone?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>E-mail:</b>
                                    <span class="pull-right text-muted">
                                        <?=empty($this->email)?"Не указан":$this->email?>
                                    </span>
                                </div>
                                <div class="list-group-item">
                                    <b>Группа:</b>
                                    <span class="pull-right text-muted">
                                        <?=empty($this->group)?"Вне групп":$this->group?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
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
                                        <?if((($link['id_partner'] == User::getId() AND $link['type'] == "u") OR User::getGroup() == 1) AND $link['status'] == 0):?>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-pencil fa-fw"></i> Управление
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?if(User::getRight("USER_EDIT") AND (User::getId()==6 OR $this->id != 6)):?>
                                <a href="/?page=user_edit&id=<?=$this->id; ?>" class="btn btn-primary">Редактировать</a>
                            <?endif;?>
                            <?if(User::getRight("USER_DELETE") AND (User::getId()==6 OR $this->id != 6)):?>
                                <a href="/?page=user_delete&id=<?=$this->id; ?>" onclick="return confirm('Вы действительно хотите удалить этого сотрудника?');" class="btn btn-danger">Удалить</a>
                            <?endif;?>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <?if(count($this->patrons)):?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-users fa-fw"></i> В патронаже
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?foreach($this->patrons as $patron):?>
                        <div class="list-group-item col-lg-6">
                            <a href="/?page=client&id=<?=$patron['id']?>"><?=$patron['fio']?></a>
                        </div>
                        <?endforeach;?>
                    </div>
                    <!-- /.list-group -->
                </div>
                <!-- /.panel-body -->
            </div>
            <?endif;?>
            <?if(count($this->events)):?>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-calendar fa-fw"></i> События
                    <span class="pull-right">
                        <div class="btn-group" id="status-selector">
                            <button class="btn btn-warning btn-xs active" id="all">Все</button>
                            <button class="btn btn-warning btn-xs" id="0">Не отмеченные</button>
                            <button class="btn btn-warning btn-xs" id="1">Прошедшие</button>
                            <button class="btn btn-warning btn-xs" id="2">Не прошедшие</button>
                        </div>
                        <div class="btn-group" id="time-selector">
                            <button class="btn btn-info btn-xs active" id="all">Все</button>
                            <button class="btn btn-info btn-xs" id="past">Прошедшие</button>
                            <button class="btn btn-info btn-xs" id="next">Будущие</button>
                        </div>
                    </span>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?foreach($this->events as $event):?>
                    <div class="list-group col-lg-6 event-box" data-status="<?=$event['status']?>" data-time="<?
                    if(strtotime($event['start_date']) > time()){
                        echo "next";
                    }elseif(strtotime($event['start_date']) <= time()){
                        echo "past";
                    }
                    ?>">
                        <div class="list-group-item list-group-item-info" style="overflow: hidden;">
                            Название
                            <span class="pull-right text-muted">
                                <a href="/?page=event&id=<?=$event['id']?>"><?=$event['title']?></a>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Реабилитант
                            <span class="pull-right text-muted">
                                <?if(!empty($event['client'])):?>
                                <a href="/?page=client&id=<?=$event['id_client']?>"><?=$event['client']?></a>
                                <?else:?>
                                Нет
                                <?endif;?>
                            </span>
                        </div>
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
<script type="text/javascript">
$(function(){
    $("#status-selector>button").click(function(){
        $("#status-selector>button").removeClass("active");
        $(this).addClass("active");
        var val = $(this).attr("id");
        $(".event-box").each(function(i, obj){
            if($(obj).attr("data-status") == val || val == "all"){
                $(obj).show();
            }else{
                $(obj).hide();
            }
        });
    });
    $("#time-selector>button").click(function(){
        $("#time-selector>button").removeClass("active");
        $(this).addClass("active");
        var val = $(this).attr("id");
        $(".event-box").each(function(i, obj){
            if($(obj).attr("data-time") == val || val == "all"){
                $(obj).show();
            }else{
                $(obj).hide();
            }
        });
    });
});
</script>