        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Направление к партнеру</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="id_client">Реабилитант</label>
                            <select name="id_client" id="id_client" class="form-control">
                                <?php foreach($this->clients as $client): ?>
                                    <option value="<?php echo $client['id']; ?>" <?=(!empty($_GET['client']) AND $_GET['client']==$client['id'])?"selected='selected'":""?>><?php echo $client['fio']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_partner">Партнеры</label><br />
                            <select name="id_partner[]" id="id_partner" class="form-control" multiple="multiple">
                                <optgroup label="Партнеры">
                                <?php foreach($this->partners as $partner): ?>
                                    <option value="p_<?php echo $partner['id']; ?>" <?=in_array($partner['id'], $this->partnersList)?"selected=''selected":""?>><?php echo $partner['title']; ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Сотрудники">
                                <?php foreach($this->users as $user): ?>
                                    <option value="u_<?php echo $user['id']; ?>" <?=in_array($user['id'], $this->usersList)?"selected=''selected":""?>><?php echo $user['fio']; ?></option>
                                <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Направить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <script>
    $(function(){
        $('#id_partner').multiselect({
            "nonSelectedText": "Не выбрано",
            maxHeight: 300
        });
    });
    </script>