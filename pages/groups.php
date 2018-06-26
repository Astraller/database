        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Список групп</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Все группы
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <a href="/?page=group_add" class="btn btn-success">Добавить группу</a><br /><br />
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Название</th>
                                            <th>Участников</th>
                                            <th>Управление</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            <a href="/?page=group_add" class="btn btn-success">Добавить группу</a>
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
                "ajax": "/data.php?type=groups",
                "order": [[ 0, "desc" ]],
                "aoColumnDefs": [
                    { 'bSortable': false, 'aTargets': [ 2,3 ] }
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
