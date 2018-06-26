        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Добавка/редактирование сотрудника</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
                        <div class="form-group">
                            <label for="fio">ФИО</label>
                            <input type="text" class='form-control' name="fio" id="fio" value="<?php echo $this->fio; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="text" class='form-control' name="email" id="email" value="<?php echo $this->email; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" class='form-control' name="phone" id="phone" value="<?php echo $this->phone; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="pass">Пароль</label>
                            <input type="text" class='form-control' name="pass" id="pass" placeholder="Заполните если нужно сменить" />
                        </div>
                        <div class="form-group">
                            <label for="group">Группа</label>
                            <select name="group" class="form-control">
                                <?php foreach($this->groups as $group): ?>
                                    <option value="<?php echo $group['id']; ?>" <?php echo (isset($this->id_group) AND $this->id_group == $group['id'])?"selected='selected'":""; ?>><?php echo $group['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Добавить/Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
