        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Прошедшие события без отметки</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-warning fa-fw"></i> Все прошедшие события
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?foreach($this->past_events as $event):?>
                    <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="overflow:hidden">
                            <b><?=$event['title']?></b>
                            <span class="pull-right">
                                <?=date("d.m.Y H:i", strtotime($event['start_date']))?>-<?=date("H:i", strtotime($event['end_date']))?>
                            </span>
                        </div>
                        <a href="/?page=event&id=<?=$event['id']?>">
                            <div class="panel-footer">
                                <span class="pull-left">Перейти</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                    </div>
                    <?endforeach;?>
                </div>
                <!-- /.panel-body -->
            </div>
    </div>
    <!-- /#wrapper -->
 