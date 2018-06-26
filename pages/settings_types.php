        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Типы событий</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Все типы
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
                                    <?foreach($this->types as $type):?>
                                    <tr>
                                        <td><?=$type['id']?></td>
                                        <td><?=$type['title']?></td>
                                        <td>
                                            <a href="/?page=settings&type=types&dee=delete&id=<?=$type['id']?>" onclick="return confirm('Вы действительно хотите удалить этот тип события?');" class="btn btn-danger">Удалить</a>
                                            <a href="/?page=settings&type=types&dee=edit&id=<?=$type['id']?>" class="btn btn-primary">Редактировать</a>
                                        </td>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                            </table>                              
                            <fieldset><legend>Добавить новый</legend>
                            <form role="form" method="post" action="/?page=settings&type=types&dee=add">
                                <input type="text" class="form-control" name="title" placeholder="Название..." /><br />
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