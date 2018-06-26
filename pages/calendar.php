    <div id="page-wrapper">

        <div class="page-header">

        <div class="pull-right form-inline">
            <div class="btn-group">
                <?foreach($this->cities as $city):?>
                    <a class="btn btn-info <?=($city['id'] == $this->id_city?'active':'')?>" href="/?page=calendar&city=<?=$city['id']?>" data-calendar-city="<?=$city['id']?>"><?=$city['title']?></a>
                <?endforeach;?>
            </div>
            <div class="btn-group">
                <button class="btn btn-primary" data-calendar-nav="prev"><< Пред</button>
                <button class="btn btn-default" data-calendar-nav="today">Сегодня</button>
                <button class="btn btn-primary" data-calendar-nav="next">След >></button>
            </div>
            <div class="btn-group">
                <button class="btn btn-warning" data-calendar-view="year">Год</button>
                <button class="btn btn-warning active" data-calendar-view="month">Месяц</button>
                <button class="btn btn-warning" data-calendar-view="week">Неделя</button>
                <button class="btn btn-warning" data-calendar-view="day">День</button>
            </div>
            <a href="/?page=add_event" class="btn btn-success">Добавить событие</a>
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
    <script type="text/javascript" src="js/app.js"></script>
