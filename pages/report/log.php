        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Лог дейтсвий</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-filter fa-fw"></i> Условия
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <input type="hidden" name="template" value="view" id="form_type" />
                        <div class="form-group  col-lg-6">
                            <label for="user">Сотрудник:</label><br />
                            <select  class="form-control" name="user[]" id="user" multiple="multiple">
                                <?php foreach($this->users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>" <?php echo (isset($_POST['user']) AND in_array($user['id'], $_POST['user']))?"selected='selected'":""; ?>><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6">
                            <label>Дата:</label><br />
                            <div class="input-group">
                                <input type="text" class='form-control datepicker' name="start_date" id="start_date" value="<?=strtotime($_POST['start_date'])<=0?"":date("d.m.Y", strtotime($_POST['start_date']))?>" />
                                <span class="input-group-addon">-</span>
                                <input type="text" class='form-control datepicker' name="end_date" id="end_date" value="<?=strtotime($_POST['end_date'])<=0?"":date("d.m.Y", strtotime($_POST['end_date']))?>" />
                            </div>
                        </div>
                        <div class="form-group  col-lg-6">
                            <label for="type">Действие:</label><br />
                            <select  class="form-control" name="types[]" id="type" multiple="multiple">
                                <?php foreach($this->types as $type): ?>
                                    <option value="<?php echo $type['id']; ?>" <?php echo (isset($_POST['types']) AND in_array($type['id'], $_POST['types']))?"selected='selected'":""; ?>><?php echo $type['title_ru']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group  col-lg-6">
                            <label for="targets">Цель:</label><br />
                            <select  class="form-control" name="targets[]" id="targets" multiple="multiple">
                                <?php foreach($this->target_types as $target => $title): ?>
                                    <option value="<?php echo $target; ?>" <?php echo (isset($_POST['targets']) AND in_array($target, $_POST['targets']))?"selected='selected'":""; ?>><?php echo $title; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <center>
                            <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Найти</button>
                            <a href="javascript:void(null)" class="btn btn-default" onclick="$('#form_type').val('print').parent().submit();"><span class="fa fa-print"></span> Печать</a>
                        </center>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Дейтсвия (Найдено: <?=count($this->log_list)?>)
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?if(!count($this->log_list)):?>
                    <div class="alert alert-warning">Выберите фильтры и нажмите кнопку "Найти"</div>
                    <?endif;?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Сотрудник</th>
                                <th class='text-center'>Дейстиве</th>
                                <th class='text-center'>Цeль</th>
                                <th class='text-center'>Дата и время</th>
                                <th class="text-right">Просмотр</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?$aCount = 0;$aTime = 0;foreach($this->log_list as $log):
                        ?>
                        <tr>
                            <td><a href="/?page=user&id=<?=$log['id_user']?>"><?=$log['fio']?></a></td>
                            <td class="text-center">
                                <?=$log['title']?>
                            </td>
                            <td class="text-center">
                                <?=$this->target_types[$log['target_type']]?>
                            </td>
                            <td class="text-center">
                                <?=date("d.m.Y H:i", strtotime($log['datetime']))?>
                            </td>
                            <td class="text-right">
                                <?if($log['target_id'] != 0):?>
                                    <a href="/?page=<?=$log['target_type']?>&id=<?=$log['target_id']?>" class="btn btn-primary">Просмотреть</a>
                                <?else:?>
                                    <a href="/?page=<?=$log['target_type']?>s">Список</a>
                                <?endif;?>
                            </td>
                        </tr>
                    <?endforeach;?>
                        </tbody>
                    </table>
                    <!-- /.list-group -->
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/language/bootstrap-datepicker.ru.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.clients-clickable').popover({
                html: true,
                container: "body",
                placement: "top",
                title: "Список клиентов"
            });
            $('#user,#type,#targets').multiselect({
                "nonSelectedText": "Не выбрано",
                includeSelectAllOption: true,
                selectAllText: 'Все',
                allSelectedText: 'Выбраны все',
                buttonWidth: "100%"
            });
            $('.datepicker').datepicker({
                todayBtn: "linked",
                language: "ru",
                autoclose: true
            });
        });
    </script>