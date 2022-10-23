<!-- Begin Page Content -->
<div class="col-lg-12">
    <?= form_open('usr/statistik', ['class' => 'form-inline']) ?>
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
<br>
<?php
if (!empty($utbk_score)) { ?>
    <div class="container-fluid mb-4">
        <div class="row mb-4 menu-statistik">
            <div class="col-lg-12 ">
                <button id="activity" class="text-hitam mr-3 btn menu-statistik-active">Activity Progress</button>
                <button id="recommendation" class="text-hitam btn">Rekomendasi</button>
                <button id="history" class="text-hitam btn">History</button>
            </div>
        </div>

        <?php if ($user_dashboard[4]['is_active'] == 1) : ?>

            <div class="row activity d-none">
                <div class="col text-center">
                    <div class="text-biru h4 mb-5"> <?= $user_dashboard[4]['isi'] ?> </div>
                    <img src="<?= base_url('asset/user/img/') . $img[8]['isi'] ?>" width="45%" class="img-fluid" alt="">
                </div>
            </div>

        <?php endif; ?>

        <!-- Begin: Activity -->
        <div class="row mb-5 activity">
            <div class="col-lg-9">
                <div class="card shadow welcome border-0 mb-3" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Tryout Performance</div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <!-- Begin: Total Score -->
                <div class="mb-3">
                    <div class="card shadow border-0" style="border-radius: 1em;">
                        <div class="card-body">
                            <img src="<?= base_url('asset/user/') ?>img/tiket-kuning.png" class="img-fluid float-left mr-2">
                            <div class="text-hitam">
                                <div class="mb-0">Total Score</div>
                                <div>
                                    <?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Total Score -->

                <!-- Begin: Pilihan Prodi -->
                <div class="mb-3">
                    <!-- BEGIN: Pilihan PTN -->
                    <div class="card shadow text-light mb-2" style="background-color: #182F64; border-radius: 1em;">
                        <div class="card-body">
                            <h4 class="text-lg"><strong>Pilihan 1</strong></h4>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless text-light" width="100%">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-lg"><?= $ptn1['nama'] ?></th>
                                            <td class="text-right">
                                                <a href="#" class="text-dark">
                                                    <img src="<?= base_url('asset/user/') ?>img/menu-3-putih.png" class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= $ptn1['jurusan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b><?= $ptn1['point'] < $avg_score['score'] ? 'Minimal Score Terpenuhi' : 'Minimal Score Tidak Terpenuhi' ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow text-light mb-2" style="background-color: #182F64; border-radius: 1em;">
                        <div class="card-body">
                            <h4 class="text-lg"><strong>Pilihan 2</strong></h4>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless text-light" width="100%">
                                    <tbody>
                                        <tr>
                                            <th scope="row" class="text-lg"><?= $ptn2['nama'] ?></th>
                                            <td class="text-right">
                                                <a href="#" class="text-dark">
                                                    <img src="<?= base_url('asset/user/') ?>img/menu-3-putih.png" class="img-fluid">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?= $ptn2['jurusan'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><b><?= $ptn2['point'] < $avg_score['score'] ? 'Minimal Score Terpenuhi' : 'Minimal Score Tidak Terpenuhi' ?></b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END: Pilihan PTN -->
                </div>
            </div>
        </div>

        <div class="row mb-5 activity mt-2">
            <div class="col-lg-6">
                <div class="card shadow mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">
                            <table width="100%">
                                <tr>
                                    <td>Nilai permapel TKA</td>
                                    <td class="text-right">
                                        <a href="" class="text-dark">
                                            <img src="<?= base_url('asset/user/') ?>img/menu-3.png" class="img-fluid">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <?php
                        $subject_tka = 0;
                        if (!empty($utbk_score)) :
                            $subject_tka = 1;
                            $score_tka = 0;
                            foreach ($utbk_score as $v) :
                                $current_score_tka = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                                $score_tka += $current_score_tka;
                                $subject_tka++;
                                if ($v['category'] == 'saintek' || $v['category'] == 'soshum') :
                        ?>
                                    <div class="range-mk">
                                        <table width="100%">
                                            <tr>
                                                <td class="text-hitam"><?= ucwords($v['subject']) ?></td>
                                                <td class="text-right pr-3"><small><?= $v['score'] ?></small></td>
                                            </tr>
                                        </table>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: <?= $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0 ?>%" aria-valuenow="<?= $v['score'] ?>" aria-valuemin="<?= $score_limit[$v['kategori_soal_id']]['min'] ?>" aria-valuemax="<?= $score_limit[$v['kategori_soal_id']]['max'] ?>"></div>
                                        </div>
                                    </div>

                        <?php
                                endif;
                            endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">
                            <table width="100%">
                                <tr>
                                    <td>Nilai permapel TPS</td>
                                    <td class="text-right">
                                        <a href="" class="text-dark">
                                            <img src="<?= base_url('asset/user/') ?>img/menu-3.png" class="img-fluid">
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <hr>

                        <?php
                        $subject_tps = 0;
                        if (!empty($utbk_score)) :
                            $subject_tps = 1;
                            $score_tps = 0;
                            foreach ($utbk_score as $v) :
                                $current_score_tps = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                                $score_tps += $current_score_tps;
                                $subject_tps++;
                                if ($v['category'] == 'tps') :
                        ?>
                                    <div class="range-mk">
                                        <table width="100%">
                                            <tr>
                                                <td class="text-hitam"><?= ucwords($v['subject']) ?></td>
                                                <td class="text-right pr-3"><small><?= $v['score'] ?></small></td>
                                            </tr>
                                        </table>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: <?= $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0 ?>%" aria-valuenow="<?= $v['score'] ?>" aria-valuemin="<?= $score_limit[$v['kategori_soal_id']]['min'] ?>" aria-valuemax="<?= $score_limit[$v['kategori_soal_id']]['max'] ?>"></div>
                                        </div>
                                    </div>

                        <?php
                                endif;
                            endforeach;
                        endif; ?>
                    </div>
                </div>
            </div>

        </div>
        <!-- End: Activity -->

        <!-- Begin: Recommendation -->
        <div class="row recommendation hide-content">
            <div class="col-lg-12">
                <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Pilihan Prodi Berdasarkan Minat Siswa</div>
                    </div>
                    <div class="table-responsive px-4">
                        <table class="table table-bordered table-striped table-hover text-center" width="100%">
                            <thead>
                                <tr class="text-light" style="background-color: #EF8521;">
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">PTN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">DT</th>
                                    <th scope="col">IK (%)</th>
                                    <th scope="col">Point Prodi</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Peluang</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                if (!empty($choosen_university)) :
                                    foreach ($choosen_university as $v) :
                                ?>
                                        <tr>
                                            <th scope="row"><?= $v['provinsi'] ?></th>
                                            <td><?= $v['nama'] ?></td>
                                            <td><?= $v['jurusan'] ?></td>
                                            <td><?= $v['kategori'] ?></td>
                                            <td><?= $v['daya_tampung'] ?></td>
                                            <td><?= round($v['daya_tampung'] / $v['peminat'] * 100, 2) ?></td>
                                            <td><?= $v['point'] ?></td>
                                            <td><?= round($avg_score['score'], 2) ?></td>
                                            <td><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></td>
                                        </tr>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row recommendation hide-content">
            <div class="col-lg-12">
                <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Rekomendasi Pilihan Prodi yang Sama Sesuai Pilihan Siswa Di Provinsi yang Dipilih</div>
                    </div>
                    <div class="table-responsive px-4">
                        <table class="table table-bordered table-striped table-hover text-center" width="100%">
                            <thead>
                                <tr class="text-light" style="background-color: #EF8521;">
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">PTN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">DT</th>
                                    <th scope="col">IK (%)</th>
                                    <th scope="col">Point Prodi</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Peluang</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                if (!empty($output2)) :
                                    foreach ($output2 as $output) :
                                        foreach ($output as $key => $v) :
                                ?>
                                            <tr>
                                                <th scope="row"><?= $v['provinsi'] ?></th>
                                                <td><?= $v['nama'] ?></td>
                                                <td><?= $v['jurusan'] ?></td>
                                                <td><?= $v['kategori'] ?></td>
                                                <td><?= $v['daya_tampung'] ?></td>
                                                <td><?= round($v['daya_tampung'] / $v['peminat'] * 100, 2) ?></td>
                                                <td><?= $v['point'] ?></td>
                                                <td><?= round($avg_score['score'], 2) ?></td>
                                                <td><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></td>
                                            </tr>
                                <?php
                                        endforeach;
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row recommendation hide-content">
            <div class="col-lg-12">
                <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Rekomendasi Pilihan Prodi yang Sama Sesuai Pilihan Siswa Di Wilayah (Regional) PTN</div>
                    </div>
                    <div class="table-responsive px-4">
                        <table class="table table-bordered table-striped table-hover text-center" width="100%">
                            <thead>
                                <tr class="text-light" style="background-color: #EF8521;">
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">PTN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">DT</th>
                                    <th scope="col">IK (%)</th>
                                    <th scope="col">Point Prodi</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Peluang</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                if (!empty($output3)) :
                                    foreach ($output3 as $output) :
                                        foreach ($output as $key => $v) :
                                ?>
                                            <tr>
                                                <th scope="row"><?= $v['provinsi'] ?></th>
                                                <td><?= $v['nama'] ?></td>
                                                <td><?= $v['jurusan'] ?></td>
                                                <td><?= $v['kategori'] ?></td>
                                                <td><?= $v['daya_tampung'] ?></td>
                                                <td><?= round($v['daya_tampung'] / $v['peminat'] * 100, 2) ?></td>
                                                <td><?= $v['point'] ?></td>
                                                <td><?= round($avg_score['score'], 2) ?></td>
                                                <td><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></td>
                                            </tr>
                                <?php
                                        endforeach;
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row recommendation hide-content">
            <div class="col-lg-12">
                <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Rekomendasi Pilihan Prodi Sesuai PTN Pilihan Siswa</div>
                    </div>
                    <div class="table-responsive px-4">
                        <table class="table table-bordered table-striped table-hover text-center" width="100%">
                            <thead>
                                <tr class="text-light" style="background-color: #EF8521;">
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">PTN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">DT</th>
                                    <th scope="col">IK (%)</th>
                                    <th scope="col">Point Prodi</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Peluang</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                if (!empty($output4)) :
                                    foreach ($output4 as $output) :
                                        foreach ($output as $key => $v) :
                                ?>
                                            <tr>
                                                <th scope="row"><?= $v['provinsi'] ?></th>
                                                <td><?= $v['nama'] ?></td>
                                                <td><?= $v['jurusan'] ?></td>
                                                <td><?= $v['kategori'] ?></td>
                                                <td><?= $v['daya_tampung'] ?></td>
                                                <td><?= round($v['daya_tampung'] / $v['peminat'] * 100, 2) ?></td>
                                                <td><?= $v['point'] ?></td>
                                                <td><?= round($avg_score['score'], 2) ?></td>
                                                <td><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></td>
                                            </tr>
                                <?php
                                        endforeach;
                                    endforeach;
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row recommendation hide-content">
            <div class="col-lg-12">
                <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Rekomendasi Pilihan Prodi Sesuai Kompetensi Siswa di PTN yang Dipilih</div>
                    </div>
                    <div class="table-responsive px-4">
                        <table class="table table-bordered table-striped table-hover text-center" width="100%">
                            <thead>
                                <tr class="text-light" style="background-color: #EF8521;">
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">PTN</th>
                                    <th scope="col">Program Studi</th>
                                    <th scope="col">Kelompok</th>
                                    <th scope="col">DT</th>
                                    <th scope="col">IK (%)</th>
                                    <th scope="col">Point Prodi</th>
                                    <th scope="col">Nilai</th>
                                    <th scope="col">Peluang</th>
                                </tr>
                            </thead>
                            <tbody class="text-dark">
                                <?php
                                if (!empty($output5) && count($output5[0]) > 0 && count($output5[1]) > 0) {
                                    foreach ($output5 as $output) :
                                        foreach ($output as $key => $v) :
                                ?>
                                            <tr>
                                                <th scope="row"><?= $v['provinsi'] ?></th>
                                                <td><?= $v['nama'] ?></td>
                                                <td><?= $v['jurusan'] ?></td>
                                                <td><?= $v['kategori'] ?></td>
                                                <td><?= $v['daya_tampung'] ?></td>
                                                <td><?= round($v['daya_tampung'] / $v['peminat'] * 100, 2) ?></td>
                                                <td><?= $v['point'] ?></td>
                                                <td><?= round($avg_score['score'], 2) ?></td>
                                                <td><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></td>
                                            </tr>
                                <?php
                                        endforeach;
                                    endforeach;
                                } else {
                                    
                                };
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Recommendation -->

        <!-- Begin: HISTORY -->
        <div class="row mb-5 history hide-content">
            <div class="col-lg-8">
                <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam mb-4">History Tryout</div>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr class="text-hitam">
                                        <th>ID Tryout</th>
                                        <th>Nama Tryout</th>
                                        <th>Tanggal Sesi</th>
                                        <th>Jam Sesi</th>
                                        <th>Mengikuti Tryout Pada</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($exam_history)) :
                                        $no = 0;
                                        foreach ($exam_history as $i) :
                                    ?>
                                            <tr>
                                                <td><?= $i['id'] ?></td>
                                                <td><?= $i['name'] ?></td>
                                                <td><?= date('d', strtotime($i['start_date'])) . ' - ' . date('d', strtotime($i['end_date'])) . ' ' . get_month(date('n', strtotime($i['end_date']))) . ' ' . date('Y', strtotime($i['end_date'])) ?></td>
                                                <td><?= date('H:i', strtotime($i['start_time'])) . ' - ' . date('H:i', strtotime($i['end_time'])) ?></td>
                                                <td><?= date('d', strtotime($i['date'])) . ' ' . get_month(date('n', strtotime($i['date']))) . ' ' . date('Y', strtotime($i['date'])) . ' - ' . date('H:i', strtotime($i['date'])) ?></td>
                                                <td><a href="<?= site_url('usr/pembahasan/' . $i['exam_id'] . '/' . $i['category']) ?>">Pembahasan</a></td>
                                            </tr>
                                    <?php $no++;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- <div class="card shadow welcome border-0" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Orders</div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr class="text-hitam">
                                        <th>ID Order</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($orders)) :
                                        foreach ($orders as $i) :
                                    ?>
                                            <tr>
                                                <td><?= $i['id'] ?></td>
                                                <td><?= $i['quantity'] . ' Tiket ' . $i['product_name'] ?></td>
                                                <td><?= date('d', strtotime($i['created'])) . ' ' . get_month(date('n', strtotime($i['created']))) . ' ' . date('Y', strtotime($i['created'])) ?></td>
                                                <td><?= number_format($i['price'], 0, '', '.') ?></td>
                                                <td><?= $i['status'] == 0 ? 'Diproses' : 'Complete' ?></td>
                                                <td><a href="<?= site_url('usr/transaction/' . $i['id']) ?>">Detail</a></td>
                                            </tr>
                                    <?php endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-2 col-xl-3 d-none">
                <div class="card shadow" style="background-color: #2D62ED; border-radius: 2em;">
                    <div class="card-body text-light border-0">
                        <img src="<?= base_url('asset/user/') ?>img/file.png" alt="">
                        <div class="h1 mb-0">Disc 15%</div>
                        <div class="mb-4">6x tryout</div>
                        <div class="text-right">
                            <a href="#" class="text-light">
                                <b>Beli sekarang</b>
                                <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-up-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="background-color: rgba(216, 216, 216, 0.514); padding: 10px; border-radius: 50%">
                                    <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: HISTORY -->

    </div>
<?php } else {
    include 'statistik/notavailable.php';
} ?>

<!-- /.container-fluid -->

<script>
    $(document).ready(function() {

        $("#activity").click(function() {
            $(".history").addClass("hide-content");
            $(".recommendation").addClass("hide-content");
            $(".activity").removeClass("hide-content");

            $("#activity").addClass("menu-statistik-active");
            $("#history").removeClass("menu-statistik-active");
            $("#recommendation").removeClass("menu-statistik-active");
        });

        $("#recommendation").click(function() {
            $(".recommendation").removeClass("hide-content");
            $(".activity").addClass("hide-content");
            $(".history").addClass("hide-content");

            $("#recommendation").addClass("menu-statistik-active");
            $("#history").removeClass("menu-statistik-active");
            $("#activity").removeClass("menu-statistik-active");
        });

        $("#history").click(function() {
            $(".activity").addClass("hide-content");
            $(".recommendation").addClass("hide-content");
            $(".history").removeClass("hide-content");

            $("#history").addClass("menu-statistik-active");
            $("#activity").removeClass("menu-statistik-active");
            $("#recommendation").removeClass("menu-statistik-active");
        });
    });

    <?php
    $labelChartScore = '[]';
    $dataScore = '[]';
    if (!empty($chart_data_score)) {
        $value_label = '';
        $value_score = '';
        foreach ($chart_data_score as $v) {
            $value_label .= '"' . $v['name'] . '",';
            $value_score .= $v['score'] . ',';
        }
        $labelChartScore = '[' . $value_label . ']';
        $dataScore = '[' . $value_score . ']';
    } ?>

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= $labelChartScore ?>,
            datasets: [{
                label: 'Performance',
                data: <?= $dataScore ?>,
                backgroundColor: [
                    'rgba(38, 85, 214,0.1)'
                ],
                borderColor: [
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)',
                    'rgba(240, 133, 33,1)'

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var num1 = <?= ($subject_tka > 0) ? $score_tka / $subject_tka - (0.15 * $score_tka / $subject_tka) : 0 ?>;
    var num2 = <?= ($subject_tps > 0) ? $score_tps / $subject_tps : 0 ?>;
    var persen1 = num1.toFixed(0);
    var persen2 = num2.toFixed(0);

    var chartProgress = document.getElementById("chartProgress");
    if (chartProgress) {
        var myChartCircle = new Chart(chartProgress, {
            type: 'doughnut',
            data: {
                labels: ["", ""],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["rgba(240, 133, 33,1)", "rgba(255, 255, 255,1)"],
                    data: [persen1, 100 - persen1]
                }]
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 100).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.fillStyle = "rgba(255, 255, 255,1)";
                    ctx.textBaseline = "middle";

                    var text = persen1 + "%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                legend: {
                    display: false,
                },
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 80
            }
        });
    }

    var chartRekomendasi = document.getElementById("chartRekomendasi");
    if (chartRekomendasi) {
        var myChartCircle = new Chart(chartRekomendasi, {
            type: 'doughnut',
            data: {
                labels: ["", ""],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["rgba(240, 133, 33,1)", "rgba(255, 255, 255,1)"],
                    data: [persen1, 100 - persen1]
                }]
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 100).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.fillStyle = "rgba(255, 255, 255,1)";
                    ctx.textBaseline = "middle";

                    var text = persen1 + "%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                legend: {
                    display: false,
                },
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 80
            }
        });
    }

    var chartProgress = document.getElementById("chartProgress2");
    if (chartProgress) {
        var myChartCircle = new Chart(chartProgress, {
            type: 'doughnut',
            data: {
                labels: ["", ""],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["rgba(240, 133, 33,1)", "rgba(255, 255, 255,1)"],
                    data: [persen2, 100 - persen2]
                }]
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 100).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.fillStyle = "rgba(255, 255, 255,1)";
                    ctx.textBaseline = "middle";

                    var text = persen2 + "%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                legend: {
                    display: false,
                },
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 80
            }
        });
    }

    var chartRekomendasi2 = document.getElementById("chartRekomendasi2");
    if (chartRekomendasi2) {
        var myChartCircle = new Chart(chartRekomendasi2, {
            type: 'doughnut',
            data: {
                labels: ["", ""],
                datasets: [{
                    label: "Population (millions)",
                    backgroundColor: ["rgba(240, 133, 33,1)", "rgba(255, 255, 255,1)"],
                    data: [persen1, 100 - persen1]
                }]
            },
            plugins: [{
                beforeDraw: function(chart) {
                    var width = chart.chart.width,
                        height = chart.chart.height,
                        ctx = chart.chart.ctx;

                    ctx.restore();
                    var fontSize = (height / 100).toFixed(2);
                    ctx.font = fontSize + "em sans-serif";
                    ctx.fillStyle = "rgba(255, 255, 255,1)";
                    ctx.textBaseline = "middle";

                    var text = persen1 + "%",
                        textX = Math.round((width - ctx.measureText(text).width) / 2),
                        textY = height / 2;

                    ctx.fillText(text, textX, textY);
                    ctx.save();
                }
            }],
            options: {
                legend: {
                    display: false,
                },
                responsive: true,
                maintainAspectRatio: false,
                cutoutPercentage: 80
            }
        });
    }
</script>

<?php
function get_month($month)
{
    switch ($month) {
        case 1:
            return 'Januari';
        case 2:
            return 'Februari';
        case 3:
            return 'Maret';
        case 4:
            return 'April';
        case 5:
            return 'Mei';
        case 6:
            return 'Juni';
        case 7:
            return 'Juli';
        case 8:
            return 'Agustus';
        case 9:
            return 'September';
        case 10:
            return 'Oktober';
        case 11:
            return 'November';
        case 12:
            return 'Desember';
        default:
            return '';
    }
}
?>