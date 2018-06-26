        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Редактирование события</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form role="form" method="post">
                        <input type="hidden" name="id" value="<?php echo $this->id; ?>" />
                        <div class="form-group loops" id="loop_0">
                            <label for="title">Название события</label>
                            <input type="text" class='form-control' name="title" id="title" value='<?=$this->title?>' />
                        </div>
                        <div class="form-group">
                            <label for="type">Тип события</label>
                            <select name="id_type" id="type" class="form-control">
                                <?php foreach($this->types as $type): ?>
                                    <option value="<?php echo $type['id']; ?>" <?=($this->id_type == $type['id']?"selected='selected'":"")?>><?php echo $type['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Город</label>
                            <select name="id_city" id="city" class="form-control">
                                <?php foreach($this->cities as $city): ?>
                                    <option value="<?php echo $city['id']; ?>" <?=($this->id_city == $city['id']?"selected='selected'":"")?>><?php echo $city['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Локация</label>
                            <select name="id_location" id="location" class="form-control">
                                <option value="0">Другая</option>
                                <?php foreach($this->locations as $location): ?>
                                    <option value="<?php echo $location['id']; ?>" <?=($this->id_location == $location['id']?"selected='selected'":"")?>><?php echo $location['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="client">Реабилитант</label>
                            <select name="client" id="client" class="form-control">
                                <option value="0">Нет</option>
                                <?php foreach($this->clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>" <?=($this->id_client == $client['id']?"selected='selected'":"")?>><?php echo $client['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <?if(User::getRight("CALENDAR_ADD")):?>
                            <label for="user">Исполнители</label><br />
                            <select name="users[]" id="users" class="form-control" multiple='multiple'>
                                <optgroup label="Сотрудники">
                                <?php foreach($this->users as $user): ?>
                                    <option value="u_<?php echo $user['id']; ?>" <?php echo (isset($this->is_users) AND ($user['id'] == $this->id_user OR in_array($user['id'], $this->is_users)))?"selected='selected'":""; ?>><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Партнеры">
                                <?php foreach($this->partners as $partner): ?>
                                    <option value="p_<?php echo $partner['id']; ?>" <?php echo (isset($this->is_partners) AND ($partner['id'] == $this->id_partner OR in_array($partner['id'], $this->is_partners)))?"selected='selected'":""; ?>><?php echo $partner['title']; ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                            </select>
                            <?else:?>
                            <label for="user">Исполнитель</label>
                            <input type="hidden" name="users[]" value="u_<?=User::getId();?>" />
                            <p class="form-control-static"><?=User::getFio();?></p>
                             <?endif;?>
                        </div>
                        <!--<div class="form-group">
                            <label for="loop">Событие повторяется</label>
                            <select name="loop" id="loop" class='form-control'>
                                <option value="0">Не повторяется</option>
                                <option value="1">Каждую неделю</option>
                                <option value="2">Каждый месяц</option>
                            </select>
                        </div>-->
                        <div class="form-group loops" id="loop_0">
                            <label for="one_date">Дата события</label>
                            <input type="text" class='form-control datepicker' name="one_date" id="one_date" value="<?=date("d.m.Y", strtotime($this->start_date))?>" />
                        </div>
                        <!--<div class="form-group loops" id="loop_1" style="display:none;">
                            <label for="day_of_week">День недели</label>
                            <select name="day_of_week" id="day_of_week" class='form-control'>
                                <option value="1">Понедельник</option>
                                <option value="2">Вторник</option>
                                <option value="3">Среда</option>
                                <option value="4">Четверг</option>
                                <option value="5">Пятница</option>
                                <option value="6">Суббота</option>
                                <option value="7">Воскресенье</option>
                            </select>
                        </div>
                        <div class="form-group loops" id="loop_2" style="display:none;">
                            <label for="day_of_month">Чило месяца</label>
                            <input type="text" class='form-control' name="day_of_month" id="day_of_month" />
                        </div>-->
                        <div class="form-group loops" id="loop_0">
                            <label>Время события</label><br />
                            <input type="number" class='form-control' style='width:80px;display:inline-block;' value="<?=date("H", strtotime($this->start_date));?>" name="start_h" max="23" min="0" />:<input type="number" min="0" max="59" class='form-control' style='width:80px;display:inline-block;' name="start_m" value="value="<?=date("i", strtotime($this->start_date));?>"" /> -
                            <input type="number" class='form-control' style='width:80px;display:inline-block;' name="end_h" max="23" min="0" value="<?=date("H", strtotime($this->end_date));?>" />:<input type="number" class='form-control' style='width:80px;display:inline-block;' name="end_m" max="59" min="0" value="value="<?=date("i", strtotime($this->end_date));?>"" />
                        </div>
                        <div class="form-group">
                            <label for="color">Цвет события</label>
                            <select name="color" id="color" class="form-control">
                                <option value="success" <?=($this->color == "success"?"selected='selected'":"")?>>Зеленый</option>
                                <option value="important" <?=($this->color == "important"?"selected='selected'":"")?>>Красный</option>
                                <option value="info" <?=($this->color == "info"?"selected='selected'":"")?>>Синий</option>
                                <option value="warning" <?=($this->color == "warning"?"selected='selected'":"")?>>Желтый</option>
                                <option value="inverse" <?=($this->color == "inverse"?"selected='selected'":"")?>>Черный</option>
                                <option value="special" <?=($this->color == "special"?"selected='selected'":"")?>>Сиреневый</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Сохранить</button>
                        </div>
                </div>
                <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="comment">Описание</label>
                            <textarea name="comment" id="comment" class="form-control" rows="20"><?=$this->comment?></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/language/bootstrap-datepicker.ru.min.js"></script>
    <script>
    $(function(){
        $('#users').multiselect({
            "nonSelectedText": "Не выбрано",
            "maxHeight": 200
        });
        $('.datepicker').datepicker({
            todayBtn: "linked",
            language: "ru",
            autoclose: true
        });
        $("#loop").change(function(){
            var loop = $(this).find("option:selected").val();
            $(".loops").hide().removeClass("loaded");
            $("#loop_"+loop).show().addClass("loaded");
        });
    });
    </script>