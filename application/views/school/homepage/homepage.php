<div class="container-fluid mb-4">
    <div class="row menu-dashboard">
        <div class="col-12 mb-4">
            <div class="h3 text-biru ml-2"><strong>Dashboard</strong></div>
            <?php
                if ($this->session->flashdata('message') != null) { ?>
                <script>
                    Swal.fire({
                    title: '',
                    html: '<?= $this->session->flashdata('message') ?>'
                    })
                </script>
                <?php }
            ?>
            <?= form_open('manage_school/homepage', ['class' => 'form-inline']) ?>
            <div class="form-group">
                <select name="tryout_group" class="form-control mb-2 mr-sm-2">
                    <option>Pilih sesi tryout</option>
                    <?php
                    if (!empty($tryout)) {
                        foreach ($tryout as $v) {
                    ?>
                            <option value="<?= $v['id'] ?>" <?= $v['id'] == $output['tryout_group_id'] ? 'selected' : '' ?>><?= $v['name'] ?></option>
                    <?php }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn mb-2" style="background-color: #EF8521; color: white;">Tampilkan</button>

            <?= form_close() ?>
        </div>
        <div class="col-lg-12">
            <button id="information" class="text-hitam mr-3 btn menu-dashboard-active">Informasi Sekolah</button>
            <button id="input" class="text-hitam btn mr-3">Input Siswa</button>
            <?php if ($output['tryout_group_id'] > 0) : ?>
                <a href="<?= $tryout_link['description']; ?>" class="btn btn-success text-white" style="background-color: #16a362;">
                    <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" />
                        <path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4" />
                        <line x1="12" y1="13" x2="12" y2="22" />
                        <polyline points="9 19 12 22 15 19" />
                    </svg> Download Pembahasan
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="row my-3 information">
        <div class="col-lg-3 col-12 my-1">
            <div class="card shadow border-0" style="border-radius: 1em;">
                <div class="card-body">
                    <img src="<?= base_url('asset/user/') ?>img/tiket-kuning.png" class="img-fluid float-left mr-2">
                    <div class="text-hitam">
                        <div class="mb-0">Rata-Rata Nilai TKA Sekolah</div>
                        <div>
                            <?= !is_null($avg_tka_category['score']) ? round($avg_tka_category['score'], 2) : '0' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-12 my-1">
            <div class="card shadow border-0" style="border-radius: 1em;">
                <div class="card-body">
                    <img src="<?= base_url('asset/user/') ?>img/tiketmerah.png" class="img-fluid float-left mr-2">
                    <div class="text-hitam">
                        <div class="mb-0">Rata-Rata Nilai TPS Sekolah</div>
                        <div>
                            <?= !is_null($avg_tps_category['score']) ? round($avg_tps_category['score'], 2) : '0' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3 information">
        <div class="col-12 my-1">
            <div class="card shadow border-0" style="border-radius: 1em;">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td class="h5 text-hitam">Statistik Nilai TKA Sekolah</td>
                            <td class="form-group text-right">
                                <?= form_open('manage_school/homepage', ['class' => 'form-inline', 'style' => "display:block;"]) ?>
                                <select name="filter_tka" class="form-control mb-2 mr-sm-2">
                                    <option value="3">Semua</option>
                                    <option value="2" <?= $output['tka_category'] == 2 ? 'selected' : '' ?>>Berdasarkan Provinsi</option>
                                    <option value="1" <?= $output['tka_category'] == 1 ? 'selected' : '' ?>>Berdasarkan Kabupaten</option>
                                </select>
                                <input type="hidden" name="tryout_group" value="<?= $output['tryout_group_id'] ?>">
                                <input type="hidden" name="filter_tps" value="<?= $output['tps_category'] ?>">
                                <button type="submit" class="btn mb-2" style="background-color: #EF8521; color: white;">Tampilkan</button>
                                <?= form_close() ?>
                            </td>
                        </tr>
                    </table>

                    <div class="table-responsive p-2">
                        <table class="table table-bordered table-striped table-hover text-center" id='TABLE_1'>
                            <thead>
                                <tr class="rounded border bg-orange text-putih">
                                    <th>Sekolah</th>
                                    <th>Provinsi</th>
                                    <th>Rerata</th>
                                    <th>Tertinggi</th>
                                    <th>Terendah</th>
                                </tr>
                            </thead>
                            <tbody class="text-hitam">
                                <?php
                                if (!empty($avg_tka_sekolah)) {
                                    foreach ($avg_tka_sekolah as $v) {
                                        if ($output['tka_category'] == 1) {
                                            if (strtolower($v['kabupaten']) == strtolower($school_data['kabupaten'])) { ?>
                                                <tr>
                                                    <td><?= $v['user_company'] ?></td>
                                                    <td><?= $v['provinsi'] ?></td>
                                                    <td><?= round($v['score'], 2) ?></td>
                                                    <td><?= round($v['max_score'], 2) ?></td>
                                                    <td><?= round($v['min_score'], 2) ?></td>
                                                </tr>
                                            <?php }
                                        } elseif ($output['tka_category'] == 2) {
                                            if (strtolower($v['provinsi']) == strtolower($school_data['provinsi'])) { ?>
                                                <tr>
                                                    <td><?= $v['user_company'] ?></td>
                                                    <td><?= $v['provinsi'] ?></td>
                                                    <td><?= round($v['score'], 2) ?></td>
                                                    <td><?= round($v['max_score'], 2) ?></td>
                                                    <td><?= round($v['min_score'], 2) ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td><?= $v['user_company'] ?></td>
                                                <td><?= $v['provinsi'] ?></td>
                                                <td><?= round($v['score'], 2) ?></td>
                                                <td><?= round($v['max_score'], 2) ?></td>
                                                <td><?= round($v['min_score'], 2) ?></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3 information">
        <div class="col-12 my-1">
            <div class="card shadow border-0" style="border-radius: 1em;">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td class="h5 text-hitam">Statistik Nilai TPS Sekolah</td>
                            <td class="form-group text-right">
                                <?= form_open('manage_school/homepage', ['class' => 'form-inline', 'style' => "display:block;"]) ?>
                                <select name="filter_tps" class="form-control mb-2 mr-sm-2">
                                    <option value="3">Semua</option>
                                    <option value="2" <?= $output['tps_category'] == 2 ? 'selected' : '' ?>>Berdasarkan Provinsi</option>
                                    <option value="1" <?= $output['tps_category'] == 1 ? 'selected' : '' ?>>Berdasarkan Kabupaten</option>
                                </select>
                                <input type="hidden" name="tryout_group" value="<?= $output['tryout_group_id'] ?>">
                                <input type="hidden" name="filter_tka" value="<?= $output['tka_category'] ?>">
                                <button type="submit" class="btn mb-2" style="background-color: #EF8521; color: white;">Tampilkan</button>
                                <?= form_close() ?>
                            </td>
                        </tr>
                    </table>

                    <div class="table-responsive p-2">
                        <table class="table table-bordered table-striped table-hover text-center" id='TABLE_2'>
                            <thead>
                                <tr class="rounded border bg-orange text-putih">
                                    <th>Sekolah</th>
                                    <th>Provinsi</th>
                                    <th>Rerata</th>
                                    <th>Tertinggi</th>
                                    <th>Terendah</th>
                                </tr>
                            </thead>
                            <tbody class="text-hitam">
                                <?php
                                if (!empty($avg_tps_sekolah)) {
                                    foreach ($avg_tps_sekolah as $v) {
                                        if ($output['tps_category'] == 1) {
                                            if (strtolower($v['kabupaten']) == strtolower($school_data['kabupaten'])) { ?>
                                                <tr>
                                                    <td><?= $v['user_company'] ?></td>
                                                    <td><?= $v['provinsi'] ?></td>
                                                    <td><?= round($v['score'], 2) ?></td>
                                                    <td><?= round($v['max_score'], 2) ?></td>
                                                    <td><?= round($v['min_score'], 2) ?></td>
                                                </tr>
                                            <?php }
                                        } elseif ($output['tps_category'] == 2) {
                                            if (strtolower($v['provinsi']) == strtolower($school_data['provinsi'])) { ?>
                                                <tr>
                                                    <td><?= $v['user_company'] ?></td>
                                                    <td><?= $v['provinsi'] ?></td>
                                                    <td><?= round($v['score'], 2) ?></td>
                                                    <td><?= round($v['max_score'], 2) ?></td>
                                                    <td><?= round($v['min_score'], 2) ?></td>
                                                </tr>
                                            <?php
                                            }
                                        } else { ?>
                                            <tr>
                                                <td><?= $v['user_company'] ?></td>
                                                <td><?= $v['provinsi'] ?></td>
                                                <td><?= round($v['score'], 2) ?></td>
                                                <td><?= round($v['max_score'], 2) ?></td>
                                                <td><?= round($v['min_score'], 2) ?></td>
                                            </tr>
                                <?php
                                        }
                                    }
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row my-3 input hide-content">
        <div class="col-lg-9 col-md-12 my-1">
            <div class="card shadow border-0" style="border-radius: 1em;">
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td class="h5 text-hitam">Data Siswa</td>
                            <td class="form-group text-right">
                                <button type="button" data-toggle="modal" data-target="#addSiswa" class="btn bg-biru-muda text-light">+ Tambah Siswa</button>
                            </td>
                        </tr>
                    </table>

                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped table-hover text-center text-hitam" id='TABLE_3'>
                            <thead>
                                <tr class="rounded border bg-orange text-putih">
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Laporan</th>
                                    <th colspan="2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data_siswa as $ds) : ?>
                                    <tr>
                                        <td><?= $ds['username'] ?></td>
                                        <td><?= $ds['first_name'] ?></td>
                                        <td><?= $ds['kelas'] ?></td>
                                        <td><?= $ds['email'] ?></td>
                                        <td><?= $ds['active'] ?></td>
                                        <td>
                                            <a target="_blank" href="<?= base_url('manage_school/report?user=') ?><?= $ds['username'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Download" class="btn btn-primary py-1 px-2">
                                                Download
                                            </a>
                                        </td>
                                        <td width="1">
                                            <a href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                                    <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                                                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                                                    <path fill-rule="evenodd" d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                    <path d="M8 12c4 0 5 1.755 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12z" />
                                                </svg>
                                            </a>
                                        </td>

                                        <td width="1">
                                            <a href="#" class="btn-hapus" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus">
                                                <svg width="16" height="16" viewBox="0 0 16 16" class="bi bi-trash-fill text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-12 my-1">
            <div class="card shadow border-0" style="background-color: #3D56B2; border-radius: 1em;">
                <div class="card-body">
                    <img src="<?= base_url('asset/user/') ?>img/paper-plane.png" alt="">
                    <div class="h3 text-putih mt-2"><strong>Kirim Data Siswa</strong></div>
                    <p class="text-putih">Bila data yang anda input telah cukup silahkan tekan tombol kirim.</p>
                    <button type="button" class="btn btn-primary" style="width: 100%;">KIRIM</button>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 my-1">
            <div class="card shadow border-0" style="border-radius: 1em;">
                <div class="card-body">
                    <div class="h3 text-hitam mt-2">Upload dengan Excel</div>
                    <p>Untuk dapat menginput data secara bersamaan kami menyediakan upload file dengan excel.</p>
                    <a type="button" href="<?= base_url('manage_school/userdata/import_user_format') ?>" class="btn btn-secondary">Download Format</a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importSiswa">Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL: Tambah Siswa -->
<div class="modal fade" id="addSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('manage_school/homepage/create_user') ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nisn" class="form-label">NISN/Username</label>
                        <input type="number" class="form-control" id="nisn" name="nisn" aria-describedby="nisn" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="sekolah" class="form-label">Sekolah</label>
                        <input type="text" class="form-control" id="sekolah" name="sekolah" required>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas" name="kelas" required>
                    </div>
                    <div class="mb-3">
                        <label for="kabupaten" class="form-label">Kabupaten</label>
                        <input type="text" class="form-control" id="kabupaten" name="kabupaten" required>
                    </div>
                    <div class="mb-3">
                        <label for="provinsi" class="form-label">Provinsi</label>
                        <input type="text" class="form-control" id="provinsi" name="provinsi" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label">NO. WA</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    </div>
                    <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select form-control" id="jk" name="jk" aria-label="jk" required>
                            <option selected disabled value="">Pilih jenis kelamin</option>
                            <option value="1">Laki - Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: Import Excel -->
<div class="modal fade" id="importSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload dengan Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open_multipart('manage_school/homepage/import_user') ?>
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="user_file" class="custom-file-input" id="user_file">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <p>Import file sesuai format.</p>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>

<script type="text/javascript" defer="defer">
    // Multiple Data Table
    $(document).ready(function() {
        $("table[id^='TABLE']").DataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
            "searching": true,
            "paging": true
        });
    });

    // Enable Tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>

<script>
    // Top Tab
    $(document).ready(function() {

        $("#information").click(function() {
            $(".input").addClass("hide-content");
            $(".information").removeClass("hide-content");

            $("#information").addClass("menu-dashboard-active");
            $("#input").removeClass("menu-dashboard-active");
        });

        $("#input").click(function() {
            $(".input").removeClass("hide-content");
            $(".information").addClass("hide-content");

            $("#input").addClass("menu-dashboard-active");
            $("#information").removeClass("menu-dashboard-active");
        });
    });
</script>