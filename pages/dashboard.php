        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Главная</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $this->clients; ?></div>
                                    <div>Реабилитантов</div>
                                </div>
                            </div>
                        </div>
                        <a href="/?page=clients">
                            <div class="panel-footer">
                                <span class="pull-left">Подробнее</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $this->events; ?></div>
                                    <div>Задач на сегодня</div>
                                </div>
                            </div>
                        </div>
                        <a href="/?page=calendar">
                            <div class="panel-footer">
                                <span class="pull-left">Подробнее</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-male fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $this->users; ?></div>
                                    <div>Сотрудников</div>
                                </div>
                            </div>
                        </div>
                        <a href="/?page=users">
                            <div class="panel-footer">
                                <span class="pull-left">Подробнее</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-<?=$this->pastEvents==0?"gray":"red";?>">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3 <?=$this->pastEvents==0?"":"blink";?>">
                                    <i class="fa fa-warning fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo $this->pastEvents; ?></div>
                                    <div>Незакрытых задач</div>
                                </div>
                            </div>
                        </div>
                        <?if($this->pastEvents):?>
                        <a href="/?page=past_events">
                            <div class="panel-footer">
                                <span class="pull-left">Просмотреть</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <?endif;?>
                    </div>
                </div>
            </div>
             <div class="page-header">

        <div class="pull-right form-inline">
            <a href="/?page=calendar" class="btn btn-success">Перейти к календарю</a>
            <div class="btn-group">
                <?foreach($this->cities as $city):?>
                    <a class="btn btn-info <?=($city['id'] == $this->id_city?'active':'')?>" href="/?city=<?=$city['id']?>" data-calendar-city="<?=$city['id']?>"><?=$city['title']?></a>
                <?endforeach;?>
            </div>
            <div class="btn-group">
                <button class="btn btn-primary" data-calendar-nav="prev"><< Пред</button>
                <button class="btn btn-default" data-calendar-nav="today">Сегодня</button>
                <button class="btn btn-primary" data-calendar-nav="next">След >></button>
            </div>
            <div class="btn-group">
                <button class="btn btn-warning" data-calendar-view="week">Неделя</button>
                <button class="btn btn-warning active" data-calendar-view="day">День</button>
            </div>
        </div>

        <h3></h3>
    </div>

    <div class="row">
        <div class="span12">
            <div id="calendar"></div>
        </div>
    </div>

    </div>
    <!-- /#wrapper -->
 <link rel="stylesheet" href="css/calendar.css">

    <style type="text/css">
        .btn-twitter {
            padding-left: 30px;
            background: rgba(0, 0, 0, 0) url(https://platform.twitter.com/widgets/images/btn.27237bab4db188ca749164efd38861b0.png) -20px 6px no-repeat;
            background-position: -20px 11px !important;
        }
        .btn-twitter:hover {
            background-position:  -20px -18px !important;
        }
    </style>
    <script type="text/javascript" src="bower_components/underscore/underscore-min.js"></script>
    <script type="text/javascript" src="bower_components/jstimezonedetect/jstz.min.js"></script>
    <script type="text/javascript" src="js/language/ru-RU.js"></script>
    <script type="text/javascript" src="js/calendar.js"></script>
    <script type="text/javascript" src="js/app_main.js"></script>
