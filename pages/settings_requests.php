        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Запросы реабилитантов</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Все запросы
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
                                    <?foreach($this->requests as $request):?>
                                    <tr>
                                        <td><?=$request['id']?></td>
                                        <td><?=$request['title']?></td>
                                        <td>
                                            <a href="/?page=settings&type=requests&dee=delete&id=<?=$request['id']?>" onclick="return confirm('Вы действительно хотите удалить этот запрос?');" class="btn btn-danger">Удалить</a>
                                            <a href="/?page=settings&type=requests&dee=edit&id=<?=$request['id']?>" class="btn btn-primary">Редактировать</a>
                                        </td>
                                    </tr>
                                    <?endforeach;?>
                                </tbody>
                            </table>                              
                            <fieldset><legend>Добавить новый</legend>
                            <form role="form" method="post" action="/?page=settings&type=requests&dee=add">
                                <input type="text" class="form-control" name="title" placeholder="Запрос..." /><br />
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