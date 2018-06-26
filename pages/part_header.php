<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $this->title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Multiselect CSS -->
    <link href="bower_components/multiselect/bootstrap.multiselect.css" rel="stylesheet">

    <!-- Multiselect JavaScript -->
    <script src="bower_components/multiselect/bootstrap.multiselect.js"></script>

    <style>
        .logotype{
            width: 100px;
            height: 100px;
            border: 1px solid gray;
            background: white;
            overflow: hidden;
            text-align: center;
        }

        .logotype img{
            height:100%;
        }
        #cal-day-box .day-highlight{
            height: auto !important;
        }
        .navbar-brand{
            padding: 0;
        }
        .navbar-brand img{
            height: 50px;
        }
        .blink{
            animation: blink 1s steps(5, start) infinite;
            -webkit-animation: blink 1s steps(5, start) infinite;
        }
        @keyframes blink {
            to {
                visibility: hidden;
            }
        }
        @-webkit-keyframes blink {
            to {
                visibility: hidden;
            }
        }
        .label.notify{
            font-size: 50%;
            position: absolute;
            top: 50%;
            left: 20%;
        }
        .popover-content{
            overflow:auto;
            max-height: 400px;
        }
        .clients-clickable{
            cursor: pointer;
        }
    </style>

    <script>
        $(function(){
          $('a.btn,div').tooltip({
            container: 'body'
          });
        })
    </script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Скрыть</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="/img/logo.jpg" alt="Форпост" />
                </a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <?if(count($this->_now_events) OR count($this->_new_links)):?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="label label-warning notify"><?=(count($this->_now_events)+count($this->_new_links))?></span>
                        <i class="fa fa-tasks fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <?if(count($this->_now_events)):?>
                        <li>
                            <div class="text-center">
                                <strong>События на сегодня:</strong>
                            </div>
                        </li>
                        <?foreach($this->_now_events as $event):?>
                        <li>
                            <a href="/?page=event&id=<?=$event['id']?>">
                                <div>
                                    <p>
                                        <strong><?=$event['title']?></strong>
                                        <span class="pull-right text-muted">
                                            <em><?=date("H:i", strtotime($event['start_date']))?></em>
                                        </span>
                                    </p>
                                    <div>
                                        <?if($event['id_client'] != 0):?>
                                            Клиент: <b><?=$event['client']?></b><br />
                                        <?endif;?>
                                        Сотрудник: <b><?=$event['user']?></b>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?endforeach;?>
                        <li>
                            <a class="text-center" href="/?page=calendar">
                                <strong>В календарь</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <?endif;?>
                        <?if(count($this->_new_links)):?>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center">
                                <strong>Неподтвержденные ссылки:</strong>
                            </div>
                        </li>
                        <?foreach($this->_new_links as $link):?>
                        <li style='list-style: disc'>
                            <a>
                            <div>
                                <p>
                                    <strong><?=$link['client']?></strong>
                                </p>
                            </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <?endforeach;?>
                        <li>
                            <a class="text-center" href="/?page=user&id=<?=User::getId()?>">
                                <strong>К своей странице</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                        <?endif;?>
                    </ul>
                </li>
                <?endif;?>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="/?page=profile"><i class="fa fa-gear fa-fw"></i> Настройки</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/?page=logout"><i class="fa fa-sign-out fa-fw"></i> Выход</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Поиск...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="/"><i class="fa fa-dashboard fa-fw"></i> Главная</a>
                        </li>
                        <?if(User::getRight("CLIENT_VIEW")):?>
                        <li>
                            <a href="/?page=clients"><i class="fa fa-male fa-fw"></i> Реабилитанты</a>
                        </li>
                        <?endif;?>
                        <?if(User::getRight("PARTNER_VIEW")):?>
                        <li>
                            <a href="/?page=partners"><i class="fa fa-briefcase fa-fw"></i> Партнеры</a>
                        </li>
                        <?endif;?>
                        <?if(User::getRight("USER_VIEW")):?>
                        <li>
                            <a href="/?page=users"><i class="fa fa-user fa-fw"></i> Сотрудники</a>
                        </li>
                        <?endif;?>
                        <?if(User::getRight("USER_VIEW")):?>
                        <li>
                            <a href="/?page=groups"><i class="fa fa-group fa-fw"></i> Группы сотрудников</a>
                        </li>
                        <?endif;?>
                        <?if(User::getRight("PARTNER_VIEW")):?>
                        <li>
                            <a href="/?page=partner_groups"><i class="fa fa-group fa-fw"></i> Группы партнеров</a>
                        </li>
                        <?endif;?>
                        <?if(User::getRight("CALENDAR_VIEW") OR User::getRight("CALENDAR_OWNER")):?>
                        <li>
                            <a href="/?page=calendar&city=1"><i class="fa fa-calendar fa-fw"></i> Календарь</a>
                        </li>
                        <?endif;?>
                        <?if(User::getRight("REPORT_VIEW")):?>
                        <li>
                            <a href="#"><i class="fa fa-check-square fa-fw"></i> Отчеты<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/?page=raport&type=clients">По реабилитантам</a>
                                </li>
                                <li>
                                    <a href="/?page=raport&type=users">По специалистам</a>
                                </li>
                                <li>
                                    <a href="/?page=raport&type=partners">По партнерам</a>
                                </li>
                                <li>
                                    <a href="/?page=raport&type=all">Сводный</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?endif;?>
                        <?if(User::getRight("SETTINGS_CHANGE")):?>
                        <li>
                            <a href="#"><i class="fa fa-gear fa-fw"></i> Настройки<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="/?page=settings&type=locations">Локации</a>
                                </li>
                                <li>
                                    <a href="/?page=settings&type=cities">Города</a>
                                </li>
                                <li>
                                    <a href="/?page=settings&type=types">Типы событий</a>
                                </li>
                                <li>
                                    <a href="/?page=settings&type=requests">Запросы</a>
                                </li>
                                <?if(User::getRight("REPORT_VIEW")):?>
                                <li>
                                    <a href="/?page=settings&type=log">Лог действий</a>
                                </li>
                                <?endif;?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?endif;?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
