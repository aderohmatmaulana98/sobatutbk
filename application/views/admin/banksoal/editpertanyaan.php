<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <?= validation_errors() ?>
        <div class="col-12">
            <a href="<?= base_url('manage/bank_soal/update/' . $bank_soal['id']) ?>">
                <i class="fa fa-arrow-left mb-3" aria-hidden="true"></i> Kembali ke daftar soal
            </a>
            <div class="h3 text-biru"><?= ucwords($bank_soal['name']) ?></div>
        </div>
        <div class="col-12">
            <div class="card" style="background-color: #f5f5f5;">
                <div class="card-body">
                    <?php echo form_open('manage/bank_soal/update_soal/' . $bank_soal['id'] . '/' . $soal['id']) ?>
                    <div class="form-group">
                        <label for="" class="text-biru h5">Materi</label>
                        <select class="custom-select" name="materi">
                            <option>Pilih materi</option>
                            <?php if (!empty($materi)) :
                                foreach ($materi as $i) : ?>
                                    <option <?= ($i['id'] == $soal['materi_id']) ? 'selected' : '' ?> value="<?= $i['id'] ?>"><?= ucfirst($i['name']) ?></option>
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
                                    <option <?= ($i['id'] == $soal['indikator_id']) ? 'selected' : '' ?> value="<?= $i['id'] ?>"><?= ucfirst($i['name']) ?></option>
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
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="1" <?= ($soal['answer'] == 1) ? 'checked' : '' ?>> Opsi 1 benar
                                </label>
                            </div>
                            <?= form_textarea($opt1) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="2" <?= ($soal['answer'] == 2) ? 'checked' : '' ?>> Opsi 2 benar
                                </label>
                            </div>
                            <?= form_textarea($opt2) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="3" <?= ($soal['answer'] == 3) ? 'checked' : '' ?>> Opsi 3 benar
                                </label>
                            </div>
                            <?= form_textarea($opt3) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="4" <?= ($soal['answer'] == 4) ? 'checked' : '' ?>> Opsi 4 benar
                                </label>
                            </div>
                            <?= form_textarea($opt4) ?>

                        </div>
                        <div class="form-group">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="answer" id="answer" value="5" <?= ($soal['answer'] == 5) ? 'checked' : '' ?>> Opsi 5 benar
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