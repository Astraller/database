        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Профиль пользователя <?=$this->fio?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <form method="post" role="form">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-lock fa-fw"></i> Email и пароль
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                <div class="list-group-item">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" id="email" value="<?=$this->email?>" class="form-control" />
                                </div>
                                <div class="list-group-item">
                                    <label for="password">Пароль:</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Заполняйте только если хотите изменить пароль" />
                                </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Личные данные
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                                <div class="list-group-item">
                                    <label for="fio">ФИО:</label>
                                    <input type="fio" name="fio" id="fio" value="<?=$this->fio?>" class="form-control" />
                                </div>
                                <div class="list-group-item">
                                    <label for="phone">Телефон:</label>
                                    <input type="tel" name="phone" id="phone" value="<?=$this->phone?>" class="form-control" />
                                </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-4 -->
                <center><button type="submit" class="btn btn-success">Сохранить</button></center>
            </div>
            <!-- /.row -->
            </form>
        </div>
        <!-- /#page-wrapper -->

    </div>