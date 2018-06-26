        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Отчет по партнерам</h1>
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
                            <label for="partner">Партнер:</label><br />
                            <select  class="form-control" name="partner[]" id="partner" multiple="multiple">
                                <?php foreach($this->partners as $partner): ?>
                                    <option value="<?php echo $partner['id']; ?>" <?php echo (is_array($_POST['partner']) AND in_array($partner['id'], $_POST['partner']))?"selected='selected'":""; ?>><?php echo $partner['title']; ?></option>
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
                            <button type="submit" class="btn btn-success"><span class="fa fa-search"></span> Найти</button>
                            <a href="javascript:void(null)" class="btn btn-default" onclick="$('#form_type').val('print').parent().submit();"><span class="fa fa-print"></span> Печать</a>
                        </center>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Партнеры (Найдено: <?=count($this->partners_list)?>)
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?if(!count($this->partners_list)):?>
                    <div class="alert alert-warning">Выберите фильтры и нажмите кнопку "Найти"</div>
                    <?endif;?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Партнер</th>
                                <th class="text-center">Направил к нам</th>
                                <th class="text-center">Направлено от нас</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?$aIn=0;$aOut=0;foreach($this->partners_list as $partner):
                        $aIn += count($partner['in']);
                        $aOut += count($partner['out']);?>
                        <tr>
                            <td><a href="/?page=partner&id=<?=$partner['id']?>"><?=$partner['title']?></a></td>
                            <td class="text-center clients-clickable" data-toggle="popover" data-content="
                            <?foreach($partner['in'] as $client):?>
                                <a href='/?page=client&id=<?=$client['id']?>'><?=str_replace('"', '&quot;',$client['fio'])?></a><br />
                            <?endforeach;?>
                            ">
                                <?=count($partner['in'])?>
                            </td>
                            <td class="text-center clients-clickable" data-toggle="popover" data-content="
                            <?foreach($partner['out'] as $client):?>
                                <a href='/?page=client&id=<?=$client['id']?>'><?=str_replace('"', '&quot;',$client['fio'])?></a><br />
                            <?endforeach;?>
                            ">
                                <?=count($partner['out'])?>
                            </td>
                        </tr>
                    <?endforeach;?>
                        <tr>
                            <th>Всего</th>
                            <th class="text-center">
                                <?=$aIn?>
                            </th>
                            <th class="text-center">
                                <?=$aOut?>
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
            $('#partner').multiselect({
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