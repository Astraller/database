        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Редактировать партнера</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
                        <div class="form-group loops">
                            <label for="title">Организация</label>
                            <input type="text" class='form-control' name="title" id="title" value="<?=$this->title?>" />
                        </div>
                        <div class="form-group">
                            <label for="contacts">Контакты</label>
                            <textarea name="contacts" id="contacts" class='form-control'><?=$this->contacts?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="services">Услуги</label>
                            <textarea name="services" id="services" class='form-control'><?=$this->services?></textarea>
                        </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="id_user">Координатор</label>
                            <select name="id_user" id="id_user" class="form-control">
                                <option value="0" <?=0==$this->id_user?"selected='selected'":""?>>Нет</option>
                                <?php foreach($this->users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>" <?=$user['id']==$this->id_user?"selected='selected'":""?>><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Примечения</label>
                            <textarea name="description" id="description" class='form-control'><?=$this->description?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="id_group">Группа</label>
                            <select name="id_group" id="id_group" class="form-control">
                                <?php foreach($this->groups as $group): ?>
                                    <option value="<?php echo $group['id']; ?>" <?=$group['id']==$this->id_group?"selected='selected'":""?>><?php echo $group['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="logotype">Логотип</label>
                            <input type="file" name="logotype"  class="form-control" />
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>