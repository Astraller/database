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
                    <i class="fa fa-filter fa-fw"></i> Дата
                </div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <div class="form-group  col-lg-6">
                            <label>Начиная с:</label><br />
                            <input type="text" class='form-control datepicker' name="start_date" id="start_date" value="<?=strtotime($_POST['start_date'])<=0?"":date("d.m.Y", strtotime($_POST['start_date']))?>" />
                        </div>
                        <div class="form-group  col-lg-6">
                            <label>Заканчивая на:</label><br />
                            <input type="text" class='form-control datepicker' name="end_date" id="end_date" value="<?=strtotime($_POST['end_date'])<=0?"":date("d.m.Y", strtotime($_POST['end_date']))?>" />
                        </div>
                        <center>
                            <button type="submit" class="btn btn-success">Найти</button>
                        </center>
                    </form>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Данные с группировкой по дням
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?if(!count($_POST)):?>
                    <div class="alert alert-warning">Выберите даты и нажмите кнопку "Найти"</div>
                    <?endif;?>
                    <?for($time = $this->start_date;$time <= $this->end_date;$time += 60*60*24):?>
                    <?if(
                        isset($this->clients[date("Y-m-d", $time)]) OR
                        isset($this->events[date("Y-m-d", $time)]) OR
                        isset($this->links[date("Y-m-d", $time)])
                    ):?>
                    <div class="list-group col-lg-6">
                        <div class="list-group-item list-group-item-info">
                            <?=date("d.m.Y", $time)?>
                        </div>
                        <?if(isset($this->clients[date("Y-m-d", $time)])):?>
                            <div class="list-group-item">
                                Прибыло клиентов
                                <span class="pull-right">
                                    <b><?=$this->clients[date("Y-m-d", $time)]?></b>
                                </span>
                            </div>
                        <?endif;?>
                        <?if(isset($this->events[date("Y-m-d", $time)])):?>
                            <div class="list-group-item">
                                Событий в календаре
                                <span class="pull-right">
                                    <b><?=$this->events[date("Y-m-d", $time)]?></b>
                                </span>
                            </div>
                        <?endif;?>
                        <?if(isset($this->links[date("Y-m-d", $time)])):?>
                            <div class="list-group-item">
                                Отправлено к партнерам
                                <span class="pull-right">
                                    <b><?=$this->links[date("Y-m-d", $time)]?></b>
                                </span>
                            </div>
                        <?endif;?>
                    </div>
                    <?endif;?>
                    <?endfor;?>
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
            $('.datepicker').datepicker({
                todayBtn: "linked",
                language: "ru",
                autoclose: true
            });
        });
    </script>