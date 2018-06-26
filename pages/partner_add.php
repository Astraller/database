        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Новый партнер</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
                        <div class="form-group loops" id="loop_0">
                            <label for="title">Организация</label>
                            <input type="text" class='form-control' name="title" id="title" />
                        </div>
                        <div class="form-group">
                            <label for="contacts">Контакты</label>
                            <textarea name="contacts" id="contacts" class='form-control'></textarea>
                        </div>
                        <div class="form-group">
                            <label for="services">Услуги</label>
                            <textarea name="services" id="services" class='form-control'></textarea>
                        </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="id_user">Координатор</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <option value="0">Нет</option>
                                <?php foreach($this->users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Примечения</label>
                            <textarea name="description" id="description" class='form-control'></textarea>
                        </div>
                        <div class="form-group">
                            <label for="id_user">Группа</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <?php foreach($this->groups as $group): ?>
                                    <option value="<?php echo $group['id']; ?>"><?php echo $group['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="logotype">Логотип</label>
                            <input type="file" name="logotype"  class="form-control" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>