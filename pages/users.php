        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Список сотрудников</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Все сотрудники
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                            <?if(User::getRight("USER_ADD")):?>
                            <a href="/?page=user_add" class="btn btn-success">Добавить сотрудника</a><br /><br />
                            <?endif;?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ФИО</th>
                                            <th>Email</th>
                                            <th>Телефон</th>
                                            <th>Группа</th>
                                            <th>Редактировать</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <?if(User::getRight("USER_ADD")):?>
                            <a href="/?page=user_add" class="btn btn-success">Добавить сотрудника</a>
                            <?endif;?>
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
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                "serverSide": true,
                "ajax": "/data.php?type=users",
                "order": [[ 0, "desc" ]],
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 2,3,5 ] }
                ],
                "columnDefs": [
                    { "width": "20%", "targets": 0 }
                ],
                "iDisplayLength": 100,
                "language": {
                    "lengthMenu": "Отображать _MENU_ записей на страницу",
                    "zeroRecords": "Ничего не найдено",
                    "info": "Страница _PAGE_ из _PAGES_",
                    "infoEmpty": "Нет доступных записей",
                    "infoFiltered": "(выбрано из _MAX_ записей)",
                    "search": "Поиск: ",
                    "paginate": {        
                        "first": "Первая",        
                        "last": "Последняя",        
                        "next": "След",        
                        "previous": "Пред"    
                    },
                }
        });
    });
    </script>
