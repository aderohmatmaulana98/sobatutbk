<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <?= validation_errors()?>
        <div class="col-12">
            <a href="<?= base_url('manage/bank_soal/update/' . $bank_soal['id']) ?>">
                <i class="fa fa-arrow-left mb-3" aria-hidden="true"></i> Kembali ke daftar soal
            </a>
            <div class="h3 text-biru"><?= ucwords($bank_soal['name']) ?></div>
        </div>
        <div class="col-12">
            <div class="card" style="background-color: #f5f5f5;">
                <div class="card-body">
                    <?= form_open('manage/bank_soal/create_soal/' . $bank_soal['id']) ?>
                    <div class="form-group">
                        <label for="" class="text-biru h5">Materi</label>
                        <select class="custom-select" name="materi">
                            <option>Pilih materi</option>
                            <?php if (!empty($materi)) :
                                foreach ($materi as $i) : ?>
                                    <option value="<?= $i['id'] ?>"><?= ucfirst($i['name']) ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-biru h5">Indikator</label>
                        <select class="custom-select" name="indikator">
                            <option>Pilih indikator</option>
                            <?php if (!empty($indikator)) :
                                foreach ($indikator as $i) : ?>
                                    <option value="<?= $i['id'] ?>"><?= ucfirst($i['name']) ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-biru h5">Soal</label>
                        <?= form_textarea($description) ?>
                    </div>
                    <label for="" class="text-biru h5">Jawaban</label>
                    <div class="mb-3">


                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="1"> Opsi 1 benar
                                </label>
                            </div>
                            <?= form_textarea($opt1) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="2"> Opsi 2 benar
                                </label>
                            </div>
                            <?= form_textarea($opt2) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="3"> Opsi 3 benar
                                </label>
                            </div>
                            <?= form_textarea($opt3) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="4"> Opsi 4 benar
                                </label>
                            </div>
                            <?= form_textarea($opt4) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="5"> Opsi 5 benar
                                </label>
                            </div>
                            <?= form_textarea($opt5) ?>

                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="text-biru h5">Pembahasan</label>
                        <?= form_textarea($explanation) ?>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    <?= form_hidden('kategori_soal_id', $bank_soal['kategori_id']) ?>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>