        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Добавка/редактирование реабилитанта</h1>
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
                            <label for="birth_date">Дата рождения</label>
                            <input type="text" class='form-control datepicker' name="date_birth" id="birth_date" value="<?=strtotime($this->date_birth)?date("d.m.Y", strtotime($this->date_birth)):''?>" />
                        </div>
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" class='form-control' name="phone" id="phone" value="<?php echo $this->phone; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="type">Обращающийся</label>
                            <select name="id_type" id="type" class="form-control">
                                <?php foreach($this->types as $type): ?>
                                    <option value="<?php echo $type['id']; ?>" <?php echo (isset($this->id_type) AND $this->id_type == $type['id'])?"selected='selected'":""; ?>><?php echo $type['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="region">Регион</label>
                            <select name="id_region" id="region" class="form-control">
                                <option value="0">[Выбрать]</option>
                                <?php foreach($this->regions as $region): ?>
                                    <option value="<?php echo $region['region_id']; ?>" <?php echo (isset($this->id_region) AND $this->id_region == $region['region_id'])?"selected='selected'":""; ?>><?php echo $region['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="group">Город</label>
                            <?php if(isset($this->cities)): ?>
                                <p class="help-block" id="no_city" style="display:none;">Выберите регион...</p>
                                <p class="help-block" style="display:none;" id="load_city">Загрузка...</p>
                                <select name="id_city" id="city" class="form-control">
                                    <?php foreach($this->cities as $city): ?>
                                        <option value="<?php echo $city['city_id']; ?>" <?php echo (isset($this->id_city) AND $this->id_city == $city['city_id'])?"selected='selected'":""; ?>><?php echo $city['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            <?php else: ?>
                                <p class="help-block" id="no_city">Выберите регион...</p>
                                <p class="help-block" style="display:none;" id="load_city">Загрузка...</p>
                                <select name="id_city" id="city" class="form-control" style="display:none;">
                                </select>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="addres">Адрес</label>
                            <input type="text" class='form-control' name="addres" id="addres" value="<?php echo $this->address; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="request">Запрос</label><br />
                            <input type="text" class='form-control' name="request" id="request" value="<?php echo $this->request; ?>" />
                        </div>
                        <div class="form-group" style="display:none;" id="parent_box">
                            <label for="parent">Относится к военнослужащему</label>
                            <select name="id_parent" id="parent" class="form-control">
                                <option value="0">[Не прикреплен]</option>
                                <?php foreach($this->clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>" <?php echo (isset($this->id_parent) AND $this->id_parent == $client['id'])?"selected='selected'":""; ?>><?php echo $client['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parent">Направлен к нам</label>
                            <select name="id_parent" id="parent" class="form-control">
                                <option value="0">Нашел нас самостоятельно</option>
                                <?php foreach($this->partners as $partner):?>
                                    <option value="<?php echo $partner['id']; ?>" <?php echo (isset($this->id_partner) AND $this->id_partner == $partner['id'])?"selected='selected'":""; ?>><?php echo $partner['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                </div>
                <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="family">Состав семьи</label>
                            <input type="text" class='form-control' name="family" id="family" value="<?php echo $this->family; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="service">Статус службы</label>
                            <select name="id_service" id="service" class="form-control">
                                <option value="0">Нет</option>
                                <?php foreach($this->services as $service): ?>
                                    <option value="<?php echo $service['id']; ?>" <?php echo (isset($this->id_service) AND $this->id_service == $service['id'])?"selected='selected'":""; ?>><?php echo $service['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="aftermath">Последствия службы</label><br />
                            <select name="id_aftermath[]" id="aftermath" class="form-control" multiple="multiple">
                                <?php foreach($this->aftermaths as $aftermath): ?>
                                    <option value="<?php echo $aftermath['id']; ?>" <?php echo (isset($this->aftermath) AND in_array($aftermath['id'], $this->aftermath))?"selected='selected'":""; ?>><?php echo $aftermath['title']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="batalion">Батальон/ВЧ</label>
                            <input type="text" class='form-control' name="batalion" id="batalion" value="<?php echo $this->batalion; ?>" />
                        </div>
                        <div class="form-group">
                            <label for="patron">Патронаж</label>
                            <select name="patron" id="patron" class="form-control">
                                <?php foreach($this->users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>" <?php echo (isset($this->patron) AND $this->patron == $user['id'])?"selected='selected'":""; ?>><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="in_date">Дата обращения</label>
                            <input type="text" class='form-control datepicker' name="date_in" id="date_in" value="<?=strtotime($this->date_in)>0?date("d.m.Y", strtotime($this->date_in)):""?>" />
                        </div>
                        <div class="form-group">
                            <label for="description">Дополнительно</label>
                            <textarea class='form-control' name="description" id="description"><?php echo $this->description; ?></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Добавить/Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="js/language/bootstrap-datepicker.ru.min.js"></script>
    <script type="text/javascript" src="bower_components/tags/bootstrap-tagsinput.js"></script>
    <script type="text/javascript" src="bower_components/typeahead/bloodhound.js"></script>
    <script type="text/javascript" src="bower_components/typeahead/typeahead.jquery.js"></script>
    <link href="bower_components/tags/bootstrap-tagsinput.css" rel="stylesheet">
<script>
$(function(){
    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            matches = [];
            substrRegex = new RegExp(q, 'i');
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };

    $.ajax({
        url: "data.php?type=requests",
        dataType: "json",
        success: function(r){
            var requests = r;
            $("#request").tagsinput({
                typeaheadjs: {
                    name: "requests",
                    source: substringMatcher(requests)
                }
            })
        }
    });
    $.ajax({
        url: "data.php?type=batalions",
        dataType: "json",
        success: function(r){
            var batalions = r;
            $("#batalion").tagsinput({
                typeaheadjs: {
                    name: "batalions",
                    source: substringMatcher(batalions)
                }
            })
        }
    });

    $('#aftermath').multiselect({
        "nonSelectedText": "Не выбрано"
    });
    $('.datepicker').datepicker({
        todayBtn: "linked",
        language: "ru",
        autoclose: true
    });
    $("#region").change(function(){
        if($(this).find("option:selected").val() != 0){
            $("#no_city").hide();
            $("#load_city").show();
            $("#city").hide();
            $.ajax({
                url: "data.php?type=city&region="+$(this).find("option:selected").val(),
                dataType: "html",
                success: function(r){
                    $("#load_city").hide();
                    $("#city").html(r).show();
                }
            });
        }else{
            $("#no_city").show();
            $("#load_city").hide();
            $("#city").hide();
        }
    });
    $("#type").change(function(){
        if($(this).find("option:selected").val() != 1 && $(this).find("option:selected").val() != 6){
            $("#parent_box").show();
        }else{
            $("#parent_box").hide();
        }
    });

    $("#type").trigger("change");
});
</script>