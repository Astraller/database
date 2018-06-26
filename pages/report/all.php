        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Отчет по сотрудникам</h1>
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
                            <label for="type">Тип:</label><br />
                            <select  class="form-control" name="type" id="type">
                                <option value="0">Все типы</option>
                                <?php foreach($this->types as $type): ?>
                                    <option value="<?php echo $type['id']; ?>" <?php echo (isset($_POST['type']) AND $type['id'] == $_POST['type'])?"selected='selected'":""; ?>><?php echo $type['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group  col-lg-6">
                            <label for="location">Локация:</label><br />
                            <select  class="form-control" name="location" id="location">
                                <option value="0">Все локации</option>
                                <?php foreach($this->locations as $location): ?>
                                    <option value="<?php echo $location['id']; ?>" <?php echo (isset($_POST['location']) AND $location['id'] == $_POST['location'])?"selected='selected'":""; ?>><?php echo $location['title']; ?></option>
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
                    <i class="fa fa-user fa-fw"></i> Сотрудники (Найдено: <?=count($this->users_list)?>)
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?if(!count($this->users_list)):?>
                    <div class="alert alert-warning">Выберите фильтры и нажмите кнопку "Найти"</div>
                    <?endif;?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Сотрудник</th>
                                <th>Тип события</th>
                                <th class='text-center'>Клиенты</th>
                                <th class='text-right'>Отработанные часы</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?$aCount = 0;$aTime = 0;foreach($this->users_list as $user):
                        ?>
                        <tr>
                            <td rowspan="<?=count($user['event_types'])?>"><a href="/?page=user&id=<?=$user['id']?>"><?=$user['fio']?></a></td>
                            <?$i=0;foreach($user['event_types'] as $type):
                            $aCount += $type['cnt'];
                            $aTime += $type['time'];
                            $i++;
                            ?>
                            <?if($i>1 AND $i <= count($user['event_types'])):?>
                        </tr><tr>
                            <?endif;?>
                            <td><?=$type['type']?></td>
                            <td class="text-center clients-clickable" data-toggle="popover" data-content="
                            <?foreach($type['clients'] as $client):?>
                                <?if($client['id'] == 0):?>
                                    Без реабилитанта <b><?=round($client['time']/(60*60),1)?></b> ч<br />
                                <?else:?>
                                    <a href='/?page=client&id=<?=$client['id']?>'><?=str_replace('"', '&quot;',$client['fio'])?></a> <b><?=round($client['time']/(60*60),1)?></b> ч<br />
                                <?endif;?>
                            <?endforeach;?>
                            ">
                                <?=$type['cnt']?>
                            </td>
                            <td class="text-right">
                                <b><?=round($type['time']/(60*60),1)?></b> ч
                            </td>
                            <?endforeach;?>
                        </tr>
                    <?endforeach;?>
                        <tr>
                            <th colspan="2">
                                Всего
                            </th>
                            <th class="text-center">
                                <?=$aCount?>
                            </th>
                            <th class="text-right">
                                <b><?=round($aTime/(60*60),1)?></b> ч
                            </th>
                        </tr>
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
            $('#user').multiselect({
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