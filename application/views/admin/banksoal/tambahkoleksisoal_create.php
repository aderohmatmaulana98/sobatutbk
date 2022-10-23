<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="h2 text-biru">Tambah Koleksi Soal</div>
        </div>
        <div class="col-lg-6">
            <?= form_open('manage/bank_soal/create') ?>
            <div class="form-group">
                <select class="custom-select" name="" id="category">
                    <option selected>Pilih kategori soal</option>
                    <?php if (!empty($item)) :
                        foreach ($item as $i) : ?>
                            <option value="<?= $i['category'] ?>"><?= ucfirst($i['category']) ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
            <div class="form-group">
                <select class="custom-select" name="subject" id="subject">
                    <option selected>Pilih subject soal</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Soal">
            </div>
            <button type="submit" class="btn bg-orange text-light py-1" style="border-radius: 2em;">Upload Soal</button>
            <?= form_close() ?>
        </div>
    </div>