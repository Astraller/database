        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Добавка/редактирование группы</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
                        <div class="form-group">
                            <label for="name">Название</label>
                            <input type="text" class='form-control' name="name" id="name" value="<?php echo $this->name; ?>" />
                        </div>
                        <div class="form-group">
                            <label>Права членов</label><br />
                                <?foreach($this->perm_groups as $group):?>
                                <div class="col-lg-6 col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <?=$group['title']?>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body ">
                                    <?foreach($group['permissions'] as $permission):?>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="permission[]" value="<?=$permission['id']?>" 
                                                <?=($this->permissions_group AND in_array($permission['id'], $this->permissions_group))?"checked='checked'":""?>><?=$permission['name']?>
                                            </label>
                                        </div>
                                    <?endforeach;?>
                                    </div>
                                </div>
                                </div>
                                <?endforeach;?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Добавить/Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
