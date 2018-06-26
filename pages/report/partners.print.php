<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Отчет по партнерам - Форпост</title>

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
                    <h2>Отчет по партнерам</h2>
                    <?if(!empty($_POST['start_date']) OR !empty($_POST['end_date'])):?>
                    <h3>За период c <b><?=!empty($_POST['start_date'])?$_POST['start_date']:"начала работы"?></b> по <b><?=!empty($_POST['end_date'])?$_POST['end_date']:"сегодняшний день"?></b></h3>
                    <?endif;?>
                    <?if(!count($this->partners_list)):?>
                    <div class="alert alert-warning">Выберите фильтры и нажмите кнопку "Найти"</div>
                    <?endif;?>                    <table class="table">
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
                            <td><?=$partner['title']?></td>
                            <td class="text-center">
                                <?=count($partner['in'])?>
                            </td>
                            <td class="text-center">
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
        </div>
        <script>
        window.print();
        </script>
</body>

</html>
