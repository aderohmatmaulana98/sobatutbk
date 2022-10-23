<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $message ?>
            </p>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <?= form_open('manage/userdata/create_user') ?>
                    <div class="h5 text-biru">Tambah User Siswa</div>
                    <div class="form-group">
                        <?= form_input($identity) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($first_name) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($email) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($phone) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($company) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($password) ?>
                    </div>
                    <div class="text-right">
                        <button type="submot" class="btn btn-primary">Simpan</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>