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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Вам запрещен доступ</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <i class="fa fa-user fa-fw"></i> Доступ запрещен
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <center>
                        Вы были заблокированны на этом ресурсе
                    </center>
                </div>
                <!-- /.panel-body -->
            </div>
    </div>
    <!-- /#wrapper -->
 
    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="bower_components/raphael/raphael-min.js"></script>
    <script src="bower_components/morrisjs/morris.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>