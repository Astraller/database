        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Города событий</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Все города
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Название</th>
                                        <th>Урпавление</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?foreach($this->cities as $city):?>
                                    <tr>
                                        <td><?=$city['id']?></td>
                                        <td><?=$city['title']?></td>
                                        <td>
                                            <a href="/?page=settings&type=cities&dee=delete&id=<?=$city['id']?>" onclick="return confirm('Вы действительно хотите удалить этот адрес?');" class="btn btn-danger">Удалить</a>
                                            <a href="/?page=settings&type=cities&dee=edit&id=<?=$city['id']?>" class="btn btn-primary">Редактировать</a>
                                        </td>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                            </table>                              
                            <fieldset><legend>Добавить новый</legend>
                            <form role="form" method="post" action="/?page=settings&type=cities&dee=add">
                                <input type="text" class="form-control" name="title" placeholder="Город..." /><br />
                                <button type="submit" class="btn btn-success">Добавить</button>
                            </form>
                            </fieldset>                          
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
    <!-- DataTables JavaScript -->