<div class="container-fluid mb-5 pb-5">
    <div class="row justify-content-evenly">
        <div class="col-lg-6">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
            <?= $validation_error ?>
            <div class="h4 text-biru"><?= ($this->uri->segment(3) == 'create') ? 'Tambah' : 'Update' ?> Paket Ujian</div>
        </div>
    </div>

    <div class="row justify-content-evenly">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-body">
                    <?php
                    if ($this->uri->segment(3) == 'create') {
                        echo form_open('manage_school/examtime/create');
                    } else {
                        echo form_open('manage_school/examtime/update/' . $post['id']);
                    }
                    ?>
                    <div class="form-group">
                        <small>Paket Ujian</small>
                        <select class="custom-select" name="tryout_group" id="tryout_group">
                            <option>Pilih Group Paket Ujian</option>
                            <?php if (!empty($group_paket_ujian)) :
                                foreach ($group_paket_ujian as $i) : ?>
                                    <option <?= ($i['id'] == ((!empty($post)) ? $post['tryout_group_id'] : 0)) ? 'selected' : '' ?> value="<?= $i['id'] ?>"><?= $i['name']?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <small>Sesi Ujian</small>
                        <select class="custom-select" name="tryout" id="tryout">
                            <option selected>Pilih Sesi Ujian</option>
                            <?php if ($this->uri->segment(3) == 'update') :
                                foreach ($sesi_ujian as $i) :
                                    $category = '';
                                    switch ($i['type']) {
                                        case '1':
                                            $category = 'saintek';
                                            break;
                                        case '2':
                                            $category = 'soshum';
                                            break;
                                        case '3':
                                            $category = 'campuran';
                                            break;
                                        case '4':
                                            $category = 'tps';
                                            break;
                                    }
                            ?>
                                    <option <?= ($i['id'] == ((!empty($post)) ? $post['tryout_id'] : 0)) ? 'selected' : '' ?> value="<?= $i['id'] ?>"><?= 'Sesi ujian: ' . $i['name'] . ', kategori: '.$category ?></option>
                            <?php endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <small>Tanggal mulai</small>
                            <?= form_input($start_date) ?>
                        </div>
                        <div class="col">
                            <small>Tanggal berakhir</small>
                            <?= form_input($end_date) ?>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <small>Dari Jam</small>
                            <?= form_input($start_time) ?>
                        </div>
                        <div class="col">
                            <small>Sampai Jam</small>
                            <?= form_input($end_time) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status" class="form-label">Status:</label>
                        <select class="custom-select" name="status" id="status">
                            <option>Pilih Status</option>
                            <option <?= (!empty($post)) ? (($post['status'] == 1) ? 'selected' : '') : '' ?> value="1">Aktif</option>
                            <option <?= (!empty($post)) ? (($post['status'] == 0) ? 'selected' : '') : '' ?> value="0">Non-aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">SIMPAN JADWAL</button>
                    <!-- <?= form_close() ?> -->
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#tryout_group').change(function() {
            var tryout_group_id = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>' + 'manage_school/examtime/get_tryout',
                method: "POST",
                data: {
                    tryout_group_id: tryout_group_id
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            var category = '';
                            switch (value.type) {
                                case '1':
                                    category = 'saintek';
                                    break;
                                case '2':
                                    category = 'soshum';
                                    break;
                                case '3':
                                    category = 'campuran';
                                    break;
                                case '4':
                                    category = 'tps';
                                    break;
                            }
                            html += '<option value="' + value.id + '">Sesi ujian: ' + value.name + ', kategori: ' + category + '</option>';
                        });

                        $('#tryout').html('<option selected>Pilih Sesi Ujian</option>' + html);
                    }
                }
            });
            return false;
        });
    });
</script>