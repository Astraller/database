<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Сводный отчет - Форпост</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="container">
                    <h2>Сводный отчет</h2>
                    <?if(!empty($_POST['start_date']) OR !empty($_POST['end_date'])):?>
                    <h3>За период c <b><?=!empty($_POST['start_date'])?$_POST['start_date']:"начала работы"?></b> по <b><?=!empty($_POST['end_date'])?$_POST['end_date']:"сегодняшний день"?></b></h3>
                    <?endif;?>
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
                            <td rowspan="<?=count($user['event_types'])?>"><?=$user['fio']?></td>
                            <?$i=0;foreach($user['event_types'] as $type):
                            $aCount += $type['cnt'];
                            $aTime += $type['time'];
                            $i++;
                            ?>
                            <?if($i>1 AND $i <= count($user['event_types'])):?>
                        </tr><tr>
                            <?endif;?>
                            <td><?=$type['type']?></td>
                            <td class="text-center">
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
        </div>
        <script>
        window.print();
        </script>
</body>

</html>
