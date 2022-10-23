<div class="container-fluid mb-4">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('message') ?>
            </p>
        </div>
        <div class="col-12 mb-4">
            <div class="h3 text-biru ml-2"><strong>Tracking Pengerjaan Siswa</strong></div>
        </div>
    </div>

    <div class="row">
        <div class="col-9">
            <div class="card shadow mb-4" style="border-radius: 1em;">
                <div class="card-body">
                    <div class="table-responsive p-2">
                        <table class="table table-bordered table-striped table-hover text-center nowrap" id='data_table' width="100%">
                            <thead>
                                <tr class="rounded border bg-orange text-putih">
                                    <th>No</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Batch</th>
                                    <th>Tes TPS</th>
                                    <th>Tes TKA</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pengerjaan as $i) : ?>
                                    <tr>
                                        <td class="text-hitam"><?= $no; ?></td>
                                        <td class="text-hitam"><?= $i['username']; ?></td>
                                        <td class="text-hitam"><?= $i['first_name']; ?></td>
                                        <td class="text-hitam"><?= $i['name']; ?></td>

                                        <?php if ($i['tps'] == 1) : ?>
                                            <td>
                                                <!-- <span class="btn btn-danger btn-sm">Belum Mengerjakan</span> -->
                                                <!-- <span class="btn btn-warning btn-sm text-hitam">Sedang Mengerjakan</span> -->
                                                <span class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="10 September 2021">Sudah Mengerjakan</span>
                                            </td>
                                        <?php elseif ($i['tps'] == 0 && $i['status'] == 4) : ?>
                                            <td>
                                                <!-- <span class="btn btn-danger btn-sm">Belum Mengerjakan</span> -->
                                                <span class="btn btn-warning btn-sm text-hitam">Sedang Mengerjakan</span>
                                                <!-- <span class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="10 September 2021">Sudah Mengerjakan</span> -->
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <span class="btn btn-danger btn-sm">Belum Mengerjakan</span>
                                                <!-- <span class="btn btn-warning btn-sm text-hitam">Sedang Mengerjakan</span> -->
                                                <!-- <span class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="10 September 2021">Sudah Mengerjakan</span> -->
                                            </td>

                                        <?php endif; ?>

                                        <?php if ($i['tka'] == 1) : ?>
                                            <td>
                                                <!-- <span class="btn btn-danger btn-sm">Belum Mengerjakan</span> -->
                                                <!-- <span class="btn btn-warning btn-sm text-hitam">Sedang Mengerjakan</span> -->
                                                <span class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="10 September 2021">Sudah Mengerjakan</span>
                                            </td>
                                        <?php elseif ($i['tka'] == 0 && ($i['status'] == 1 || $i['status'] == 2 || $i['status'] == 3)) : ?>
                                            <td>
                                                <!-- <span class="btn btn-danger btn-sm">Belum Mengerjakan</span> -->
                                                <span class="btn btn-warning btn-sm text-hitam">Sedang Mengerjakan</span>
                                                <!-- <span class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="10 September 2021">Sudah Mengerjakan</span> -->
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <span class="btn btn-danger btn-sm">Belum Mengerjakan</span>
                                                <!-- <span class="btn btn-warning btn-sm text-hitam">Sedang Mengerjakan</span> -->
                                                <!-- <span class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="10 September 2021">Sudah Mengerjakan</span> -->
                                            </td>

                                        <?php endif; ?>
                                        <?php if ($i['tps'] == 1 && $i['tka'] == 1) : ?>
                                            <td>
                                                <span class="btn btn-success btn-sm">Selesai</span>
                                                <!-- <span class="btn btn-danger btn-sm">Belum Selesai</span> -->
                                            </td>
                                        <?php else : ?>
                                            <td>
                                                <!-- <span class="btn btn-success btn-sm">Selesai</span> -->
                                                <span class="btn btn-danger btn-sm">Belum Selesai</span>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-3">
            <div class="card shadow mb-4" style="border-radius: 1em;">
                <div class="card-body">
                    <div class="h3 text-orange ml-2"><i class="fa fa-history text-orange" aria-hidden="true"></i> <strong>Reset Ujian</strong></div>
                    <div>
                        <form action="<?= base_url('manage_school/tracking/reset') ?>" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="formResetNisn" class="form-label text-hitam">NISN Siswa</label>
                                <input type="text" class="form-control" name="nisn" id="nisn" placeholder="0001234567" required>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" aria-label="Sesi Tryout" name="sesi" id="sesi" required>
                                    <option selected disabled>Pilih Sesi Ujian</option>
                                    <?php foreach ($sesi_ujian as $su) : ?>
                                        <option value="<?= $su['id']; ?>"><?= $su['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-control" aria-label="Jenis Ujian" name="tipe" onchange="myFungsi(this.value)" id="tipe" required>
                                    <option selected disabled>Pilih Jenis Ujian</option>
                                    <?php foreach ($tipe as $t) : ?>
                                        <option value="<?= $t['category']; ?>"><?= $t['category']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3" id="subjek">
                            </div>
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3" style="width: 100%;">RESET</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Enable Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>

<script type="text/javascript">
    function myFungsi(tipe) {
        var subjek = "";
        if (tipe == "saintek") {
            subjek = "<div class='form-check'>" + "<input class='form-check-input' name='mapel1' type='checkbox' value='matematika saintek' id='mapel1'>" + "<label class='form-check-label'>Matematika Saintek</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel2' type='checkbox' value='fisika' id='mapel2'>" + "<label class='form-check-label'>Fisika</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel3' type='checkbox' value='kimia' id='mapel3'>" + "<label class='form-check-label'>Kimia</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel4' type='checkbox' value='biologi' id='mapel4'>" + "<label class='form-check-label'>Biologi</label></div>";
        } else if (tipe == "soshum") {
            subjek = "<div class='form-check'>" + "<input class='form-check-input' name='mapel5' type='checkbox' value='sejarah' id='mapel5'>" + "<label class='form-check-label'>Sejarah</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel6' type='checkbox' value='geografi' id='mapel6'>" + "<label class='form-check-label'>Geografi</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel7' type='checkbox' value='sosiologi' id='mapel7'>" + "<label class='form-check-label'>Sosiologi</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel8' type='checkbox' value='ekonomi' id='mapel8'>" + "<label class='form-check-label'>Ekonomi</label></div>";
        } else {
            subjek = "<div class='form-check'>" + "<input class='form-check-input' name='mapel9' type='checkbox' value='kemampuan memahami bacaan dan menulis' id='mapel9'>" + "<label class='form-check-label'>Kemampuan memahami bacaan dan menulis</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel10' type='checkbox' value='pengetahuan dan pemahaman umum' id='mapel10'>" + "<label class='form-check-label'>Pengetahuan dan pemahaman umum</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel11' type='checkbox' value='pengetahuan kuantitatif' id='mapel11'>" + "<label class='form-check-label'>Pengetahuan kuantitatif</label></div>" +
                "<div class='form-check'>" + "<input class='form-check-input' name='mapel12' type='checkbox' value='kemampuan penalaran umum' id='mapel12'>" + "<label class='form-check-label'>Kemampuan penalaran umum</label></div>";
        }
        document.getElementById('subjek').innerHTML = subjek;
    }
</script>