        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Отчет по реабилитантам</h1>
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
                        <div class="form-group  col-lg-6">
                            <label for="type">Тип:</label><br />
                            <select  class="form-control" name="type[]" id="type" multiple="multiple">
                                <?php foreach($this->type as $type): ?>
                                    <option value="<?php echo $type['id']; ?>" <?php echo (!isset($_POST['type']) OR in_array($type['id'], $_POST['type']))?"selected='selected'":""; ?>><?php echo $type['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group  col-lg-6">
                            <label for="status">Статус:</label><br />
                            <select  class="form-control" name="status[]" id="status" multiple="multiple">
                                <?php foreach($this->status as $status): ?>
                                    <option value="<?php echo $status['id']; ?>"  <?php echo (!isset($_POST['status']) OR in_array($status['id'], $_POST['status']))?"selected='selected'":""; ?>><?php echo $status['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group  col-lg-6">
                            <label for="aftermath">Последствия:</label><br />
                            <select  class="form-control" name="aftermath[]" id="aftermath" multiple="multiple">
                                <option value="0" <?php echo (!isset($_POST['aftermath']) OR in_array(0, $_POST['aftermath']))?"selected='selected'":""; ?>>Нет</option>
                                <?php foreach($this->aftermath as $aftermath): ?>
                                    <option value="<?php echo $aftermath['id']; ?>" <?php echo (!isset($_POST['aftermath']) OR in_array($aftermath['id'], $_POST['aftermath']))?"selected='selected'":""; ?>><?php echo $aftermath['title']; ?></option>
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
                        <center>
                            <button type="submit" class="btn btn-success">Найти</button>
                        </center>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Реабилитанты (Найдено: <?=count($this->clients)?>)
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?if(!count($this->clients)):?>
                    <div class="alert alert-warning">Выберите фильтры и нажмите кнопку "Найти"</div>
                    <?endif;?>
                    <?foreach($this->clients as $client):?>
                    <div class="list-group col-lg-6">
                        <div class="list-group-item list-group-item-info">
                            <a href="/?page=client&id=<?=$client['id']?>"><?=$client['fio']?></a>
                        </div>
                        <div class="list-group-item">
                            Патронаж
                            <span class="pull-right text-muted">
                                <a href="/?page=user&id=<?=$client['patron']?>"><?=$client['patron_name']?></a>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Дата рождения
                            <span class="pull-right text-muted">
                                <?=strtotime($client['date_birth'])<=0?"Не указана":date("d.m.Y", strtotime($client['date_birth']))?>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Дата обращения
                            <span class="pull-right text-muted">
                                <?=strtotime($client['date_in'])<=0?"Не указана":date("d.m.Y", strtotime($client['date_in']))?>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Статус службы
                            <span class="pull-right text-muted">
                                <?=$client['service']?>
                            </span>
                        </div>
                        <div class="list-group-item">
                            Последствия
                            <span class="pull-right">
                                <?=count($client['aftermaths'])?implode(", ", $client['aftermaths']):"Нет"?>
                            </span>
                        </div>
                    </div>
                    <?endforeach;?>
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
            $('#type,#status,#aftermath').multiselect({
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