        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Новое событие</h1>
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
                            <input type="text" class='form-control' name="title" id="title" />
                        </div>
                        <div class="form-group">
                            <label for="type">Тип события</label>
                            <select name="id_type" id="type" class="form-control">
                                <?php foreach($this->types as $type): ?>
                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Город</label>
                            <select name="id_city" id="city" class="form-control">
                                <?php foreach($this->cities as $city): ?>
                                    <option value="<?php echo $city['id']; ?>"><?php echo $city['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="location">Локация</label>
                            <select name="id_location" id="location" class="form-control">
                                <option value="0">Другая</option>
                                <?php foreach($this->locations as $location): ?>
                                    <option value="<?php echo $location['id']; ?>"><?php echo $location['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="client">Реабилитант</label>
                            <select name="client" id="client" class="form-control">
                                <option value="0">Нет</option>
                                <?php foreach($this->clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>"><?php echo $client['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <?if(User::getRight("CALENDAR_ADD")):?>
                            <label for="user">Исполнители</label><br />
                            <select name="users[]" id="users" class="form-control" multiple='multiple'>
                                <optgroup label="Сотрудники">
                                <?php foreach($this->users as $user): ?>
                                    <option value="u_<?php echo $user['id']; ?>"><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Партнеры">
                                <?php foreach($this->partners as $partner): ?>
                                    <option value="p_<?php echo $partner['id']; ?>"><?php echo $partner['title']; ?></option>
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
                            <input type="text" class='form-control datepicker' value="<?=date('d.m.Y',!empty($_GET['date'])?strtotime($_GET['date']):time())?>" name="one_date" id="one_date" />
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
                            <input type="number" class='form-control' style='width:80px;display:inline-block;' name="start_h" max="23" min="0" value="<?=date("H");?>" />:<input type="number" min="0" max="59" class='form-control' style='width:80px;display:inline-block;' name="start_m" value="00" /> -
                            <input type="number" class='form-control' style='width:80px;display:inline-block;' name="end_h" max="23" min="0" value="<?=date("H");?>" />:<input type="number" class='form-control' style='width:80px;display:inline-block;' name="end_m" max="59" min="0" value="00" />
                        </div>
                        <div class="form-group">
                            <label for="color">Цвет события</label>
                            <select name="color" id="color" class="form-control">
                                <option value="success">Зеленый</option>
                                <option value="important">Красный</option>
                                <option value="info">Синий</option>
                                <option value="warning">Желтый</option>
                                <option value="inverse">Черный</option>
                                <option value="special">Сиреневый</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Добавить</button>
                        </div>
                </div>
                <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            <label for="comment">Описание</label>
                            <textarea name="comment" id="comment" class="form-control" rows="20"></textarea>
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