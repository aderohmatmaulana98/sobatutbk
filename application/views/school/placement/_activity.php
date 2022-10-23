<?php
$labelChartPTN = '[]';
$dataSaintek = '[]';
$dataSoshum = '[]';
if (!empty($result_statistik_ptn)) {
    $value_ptn = '';
    $value_saintek = '';
    $value_soshum = '';
    foreach ($result_statistik_ptn as $v) {
        $value_ptn .= '"' . $v['nama'] . '",';
        $value_saintek .= $v['saintek'] . ',';
        $value_soshum .= $v['soshum'] . ',';
    }
    $labelChartPTN = '[' . $value_ptn . ']';
    $dataSaintek = '[' . $value_saintek . ']';
    $dataSoshum = '[' . $value_soshum . ']';
}

$labelChartSaintek = '[]';
$dataPilihanSaintek = '[]';
if (!empty($result_statistik_saintek)) {
    $value_jurusan = '';
    $value_total = '';
    foreach ($result_statistik_saintek as $v) {
        $value_jurusan .= '"' . $v['jurusan'] . '",';
        $value_total .= $v['total'] . ',';
    }
    $labelChartSaintek = '[' . $value_jurusan . ']';
    $dataPilihanSaintek = '[' . $value_total . ']';
}

$labelChartSoshum = '[]';
$dataPilihanSoshum = '[]';
if (!empty($result_statistik_soshum)) {
    $value_jurusan = '';
    $value_total = '';
    foreach ($result_statistik_soshum as $v) {
        $value_jurusan .= '"' . $v['jurusan'] . '",';
        $value_total .= $v['total'] . ',';
    }
    $labelChartSoshum = '[' . $value_jurusan . ']';
    $dataPilihanSoshum = '[' . $value_total . ']';
}
?>

<!-- Jumlah Siswa -->
<div class="row my-3 activity <?= null === $output['filter'] && null === $output['filter-nilai'] ? '' : 'hide-content' ?>">
    <div class="col-lg-3 col-12 my-1">
        <div class="card shadow border-0" style="border-radius: 1em;">
            <div class="card-body">
                <img src="<?= base_url('asset/user/') ?>img/tiket-kuning.png" class="img-fluid float-left mr-2">
                <div class="text-hitam">
                    <div class="mb-0">Total Jumlah Siswa</div>
                    <div>
                        <?= $all_student['total'] ?>
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
                    <div class="mb-0">Peserta Saintek</div>
                    <div>
                        <?= $saintek_student['total'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-12 my-1">
        <div class="card shadow border-0" style="border-radius: 1em;">
            <div class="card-body">
                <img src="<?= base_url('asset/user/') ?>img/tiket-hijau.png" class="img-fluid float-left mr-2">
                <div class="text-hitam">
                    <div class="mb-0">Peserta Soshum</div>
                    <div>
                        <?= $soshum_student['total'] ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rata-rata Permapel -->
<div class="row my-3 activity <?= null === $output['filter'] && null === $output['filter-nilai'] ? '' : 'hide-content' ?>">
    <div class="col-lg-4">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Rata-rata Nilai Permapel TPS</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <?php
                // $subject_tka = 0;
                // if (!empty($utbk_score)) :
                //     $subject_tka = 1;
                //     $score_tka = 0;
                //     foreach ($utbk_score as $v) :
                //         $current_score_tka = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                //         $score_tka += $current_score_tka;
                //         $subject_tka++;
                //         if ($v['category'] == 'saintek' || $v['category'] == 'soshum') :
                ?>
                <?php if (!empty($avg_subject)) {
                    foreach ($avg_subject as $v) {
                        if ($v['category'] == 'tps') {
                ?>
                            <div class="range-mk">
                                <table width="100%">
                                    <tr>
                                        <!-- <td class="text-hitam"><?= ucwords($v['subject']) ?></td>
                                            <td class="text-right pr-3"><small><?= $v['score'] ?></small></td> -->


                                        <td class="text-hitam"><?= $v['subject'] ?></td>
                                        <td class="text-right pr-3"><small><?= round($v['score'], 2) ?></small></td>

                                    </tr>
                                </table>
                                <div class="progress">
                                    <!-- <div class="progress-bar" role="progressbar" style="width: <?= $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0 ?>%" aria-valuenow="<?= $v['score'] ?>" aria-valuemin="<?= $score_limit[$v['kategori_soal_id']]['min'] ?>" aria-valuemax="<?= $score_limit[$v['kategori_soal_id']]['max'] ?>"></div> -->

                                    <div class="progress-bar" role="progressbar" style="width: <?= $v['score'] / 10 ?>%" aria-valuenow="<?= $v['score'] / 10 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                <?php }
                    }
                } ?>

                <?php
                //         endif;
                //     endforeach;
                // endif;
                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Rata-rata Nilai Permapel TKA Saintek</td>
                        </tr>
                    </table>
                </div>
                <hr>

                <?php
                // $subject_tka = 0;
                // if (!empty($utbk_score)) :
                //     $subject_tka = 1;
                //     $score_tka = 0;
                //     foreach ($utbk_score as $v) :
                //         $current_score_tka = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                //         $score_tka += $current_score_tka;
                //         $subject_tka++;
                //         if ($v['category'] == 'saintek' || $v['category'] == 'soshum') :
                ?>
                <?php if (!empty($avg_subject)) {
                    foreach ($avg_subject as $v) {
                        if ($v['category'] == 'saintek') {
                ?>
                            <div class="range-mk">
                                <table width="100%">
                                    <tr>
                                        <!-- <td class="text-hitam"><?= ucwords($v['subject']) ?></td>
                                            <td class="text-right pr-3"><small><?= $v['score'] ?></small></td> -->

                                        <td class="text-hitam"><?= $v['subject'] ?></td>
                                        <td class="text-right pr-3"><small><?= round($v['score'], 2) ?></small></td>
                                    </tr>
                                </table>
                                <div class="progress">
                                    <!-- <div class="progress-bar" role="progressbar" style="width: <?= $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0 ?>%" aria-valuenow="<?= $v['score'] ?>" aria-valuemin="<?= $score_limit[$v['kategori_soal_id']]['min'] ?>" aria-valuemax="<?= $score_limit[$v['kategori_soal_id']]['max'] ?>"></div> -->

                                    <div class="progress-bar" role="progressbar" style="width: <?= $v['score'] / 10 ?>%" aria-valuenow="<?= $v['score'] / 10 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                <?php }
                    }
                } ?>
                <?php
                //         endif;
                //     endforeach;
                // endif;
                ?>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Rata-rata Nilai Permapel TKA Soshum</td>
                        </tr>
                    </table>
                </div>
                <hr>

                <?php
                // $subject_tka = 0;
                // if (!empty($utbk_score)) :
                //     $subject_tka = 1;
                //     $score_tka = 0;
                //     foreach ($utbk_score as $v) :
                //         $current_score_tka = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                //         $score_tka += $current_score_tka;
                //         $subject_tka++;
                //         if ($v['category'] == 'saintek' || $v['category'] == 'soshum') :
                ?>
                <?php if (!empty($avg_subject)) {
                    foreach ($avg_subject as $v) {
                        if ($v['category'] == 'soshum') {
                ?>
                            <div class="range-mk">
                                <table width="100%">
                                    <tr>
                                        <!-- <td class="text-hitam"><?= ucwords($v['subject']) ?></td>
                                            <td class="text-right pr-3"><small><?= $v['score'] ?></small></td> -->

                                        <td class="text-hitam"><?= $v['subject'] ?></td>
                                        <td class="text-right pr-3"><small><?= round($v['score'], 2) ?></small></td>
                                    </tr>
                                </table>
                                <div class="progress">
                                    <!-- <div class="progress-bar" role="progressbar" style="width: <?= $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0 ?>%" aria-valuenow="<?= $v['score'] ?>" aria-valuemin="<?= $score_limit[$v['kategori_soal_id']]['min'] ?>" aria-valuemax="<?= $score_limit[$v['kategori_soal_id']]['max'] ?>"></div> -->

                                    <div class="progress-bar" role="progressbar" style="width: <?= $v['score'] / 10 ?>%" aria-valuenow="<?= $v['score'] / 10 ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                <?php }
                    }
                } ?>
                <?php
                //         endif;
                //     endforeach;
                // endif;
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Pilihan PTN -->
<div class="row my-3 activity <?= null === $output['filter'] && null === $output['filter-nilai'] ? '' : 'hide-content' ?>">
    <div class="col-lg-6">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Statistik Pilihan PTN</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table mb-0 table-hover text-center" id="data_table">
                        <thead>
                            <tr class="rounded border">
                                <th>Nama PTN</th>
                                <th>Jumlah Siswa Saintek</th>
                                <th>Jumlah Siswa Soshum</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($result_statistik_ptn)) {
                                foreach ($result_statistik_ptn as $v) { ?>
                                    <tr>
                                        <td><?= $v['nama'] ?></td>
                                        <td><?= $v['saintek'] ?></td>
                                        <td><?= $v['soshum'] ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Grafik</td>
                        </tr>
                    </table>
                </div>
                <hr>
                <div class="table-responsive">
                    <canvas id="chartPTN"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Pilihan Saintek -->
<div class="row my-3 activity <?= null === $output['filter'] && null === $output['filter-nilai'] ? '' : 'hide-content' ?>">
    <div class="col-12">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Statistik Pilihan Saintek</td>
                        </tr>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover text-center" id="data_table">
                                <thead>
                                    <tr class="rounded border">
                                        <th>Program Studi</th>
                                        <th>Jumlah Siswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($result_statistik_saintek)) {
                                        foreach ($result_statistik_saintek as $v) { ?>
                                            <tr>
                                                <td><?= $v['jurusan'] ?></td>
                                                <td><?= $v['total'] ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-8 mt-4 mt-lg-0">
                        <div class="h5 text-hitam">
                            <table width="100%">
                                <tr>
                                    <td>Grafik Pilihan Siswa</td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <canvas id="chartSaintek"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Pilihan Soshum -->
<div class="row my-3 activity <?= null === $output['filter'] && null === $output['filter-nilai'] ? '' : 'hide-content' ?>">
    <div class="col-12">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">
                    <table width="100%">
                        <tr>
                            <td>Statistik Pilihan Soshum</td>
                        </tr>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <div class="table-responsive">
                            <table class="table mb-0 table-hover text-center" id="data_table">
                                <thead>
                                    <tr class="rounded border">
                                        <th>Program Studi</th>
                                        <th>Jumlah Siswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($result_statistik_soshum)) {
                                        foreach ($result_statistik_soshum as $v) { ?>
                                            <tr>
                                                <td><?= $v['jurusan'] ?></td>
                                                <td><?= $v['total'] ?></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-lg-8 mt-4 mt-lg-0">
                        <div class="h5 text-hitam">
                            <table width="100%">
                                <tr>
                                    <td>Grafik Pilihan Siswa</td>
                                </tr>
                            </table>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <canvas id="chartSoshum"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Top Tab
    $(document).ready(function() {

        $("#activity").click(function() {
            $(".recap").addClass("hide-content");
            $(".activity").removeClass("hide-content");

            $("#activity").addClass("menu-placement-active");
            $("#recap").removeClass("menu-placement-active");
        });

        $("#recap").click(function() {
            $(".recap").removeClass("hide-content");
            $(".activity").addClass("hide-content");

            $("#recap").addClass("menu-placement-active");
            $("#activity").removeClass("menu-placement-active");
        });
    });

    var ctxChartPTN = document.getElementById("chartPTN");
    var chartPTNsetup = new Chart(ctxChartPTN, {
        type: 'bar',
        data: {
            labels: <?= $labelChartPTN ?>,
            datasets: [{
                    label: 'Saintek',
                    data: <?= $dataSaintek ?>,
                    backgroundColor: ['rgba(38, 85, 214, 0.1)'],
                    borderColor: ['rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)'],
                    borderWidth: 1
                },
                {
                    label: 'Soshum',
                    data: <?= $dataSoshum ?>,
                    backgroundColor: ['rgba(240, 133, 33, 0.1)'],
                    borderColor: ['rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)'],
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctxChartSaintek = document.getElementById("chartSaintek");
    var chartSainteksetup = new Chart(ctxChartSaintek, {
        type: 'bar',
        data: {
            labels: <?= $labelChartSaintek ?>,
            datasets: [{
                label: 'Jumlah',
                data: <?= $dataPilihanSaintek ?>,
                backgroundColor: ['rgba(38, 85, 214, 0.1)'],
                borderColor: ['rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)', 'rgba(38, 85, 214,1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    var ctxChartSoshum = document.getElementById("chartSoshum");
    var chartSoshumsetup = new Chart(ctxChartSoshum, {
        type: 'bar',
        data: {
            labels: <?= $labelChartSoshum ?>,
            datasets: [{
                label: 'Jumlah',
                data: <?= $dataPilihanSoshum ?>,
                backgroundColor: ['rgba(240, 133, 33, 0.1)'],
                borderColor: ['rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)', 'rgba(240, 133, 33,1)'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>