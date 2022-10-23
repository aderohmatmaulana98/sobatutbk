<?php
    $chart_colors = array("#ef8521", "#182f64", "#24C0F1", "#00be29");
?>

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

    <div class="col-lg-3 col-md-12">
        <div class="row">
            <!-- Begin: Total Score -->
            <div class="col-md-4 col-lg-12">
                <div class="mb-3">
                    <div class="card shadow border-0" style="border-radius: 1em;">
                        <div class="card-body">
                            <img src="<?= base_url('asset/user/') ?>img/tiket-kuning.png" class="img-fluid float-left mr-2">
                            <div class="text-hitam">
                                <div class="mb-0">Total Score</div>
                                <div>
                                    <b><?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End: Total Score -->

            <!-- Begin: Pilihan PTN 1 -->
            <div class="col-md-4 col-lg-12">
                <div class="mb-3">
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
                </div>
            </div>
            <!-- End: Pilihan PTN 1 -->

            <!-- Begin: Pilihan PTN 2 -->
            <div class="col-md-4 col-lg-12">
                <div class="mb-3">
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
                </div>
            </div>
            <!-- End: Pilihan PTN 2 -->
        </div>
    </div>
</div>

<div class="row mb-5 activity mt-2">
    <div class="col-12">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-lg-7 my-2">
                        <div class="h5 text-hitam mb-4">Tes Potensi Skolastik</div>
                        <div class="table-responsive">
                            <table class="table text-center table-gradient table-rounded table-v table-certificate" width="100%">
                                <thead class="text-light">
                                    <tr>
                                        <th class="bg-biru-muda" width="70%">Materi Uji</th>
                                        <th class="bg-biru" width="30%">Nilai TPS</th>
                                    </tr>
                                </thead>
                                <tbody class="text-light">
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
                                                <tr>
                                                    <td><?= ucwords($v['subject']) ?></td>
                                                    <td><b><?= $v['score'] ?></b></td>
                                                </tr>
                                    <?php
                                            endif;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 my-2">
                        <div class="h5 text-hitam mb-4">Nilai TPS</div>
                        <table class="charts-css column show-labels show-4-secondary-axes data-spacing-20" id="chart">
                            <tbody class="mb-5">
                                <?php
                                $subject_tps = 0;
                                if (!empty($utbk_score)) :
                                    $subject_tps = 1;
                                    $score_tps = 0;
                                    foreach ($utbk_score as $v) :
                                        $current_score_tps = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                                        $score_tps += $current_score_tps;
                                        if ($v['category'] == 'tps') :
                                            $words = explode(" ", ucwords($v['subject']));
                                            $acronym = "";

                                            foreach ($words as $w) {
                                                $acronym .= $w[0];
                                            }
                                ?>
                                            <tr>
                                                <th scope="row"><?= $acronym ?></th>
                                                <td class="text-light" style="--size: calc( 567 / <?= $score_limit[$v['kategori_soal_id']]['max'] ?> ); --color: <?= $chart_colors[$subject_tps - 1] ?>"><b><?= $v['score'] ?></b></td>
                                            </tr>
                                <?php
                                        $subject_tps++;
                                        endif;
                                    endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-5 activity mt-2">
    <div class="col-12">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-8 col-lg-7 my-2">
                        <div class="h5 text-hitam mb-4">Tes Kemampuan Akademik</div>
                        <div class="table-responsive">
                            <table class="table text-center table-gradient table-rounded table-v table-certificate" width="100%">
                                <thead class="text-light">
                                    <tr>
                                        <th class="bg-orange" width="70%">Materi Uji</th>
                                        <th class="bg-orange-tua" width="70%">Nilai TKA</th>
                                    </tr>
                                </thead>
                                <tbody class="text-light">
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
                                                <tr>
                                                    <td><?= ucwords($v['subject']) ?></td>
                                                    <td><b><?= $v['score'] ?></b></td>
                                                </tr>
                                    <?php
                                            endif;
                                        endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 my-2">
                        <div class="h5 text-hitam mb-4">Nilai TKA</div>
                        <table class="charts-css column show-labels show-4-secondary-axes data-spacing-20" id="chart">
                            <tbody class="mb-5">
                                <?php
                                $subject_tka = 0;
                                if (!empty($utbk_score)) :
                                    $subject_tka = 1;
                                    $score_tka = 0;
                                    foreach ($utbk_score as $v) :
                                        $current_score_tka = $score_limit[$v['kategori_soal_id']]['max'] > 0 ? $v['score'] / $score_limit[$v['kategori_soal_id']]['max'] * 100 : 0;
                                        $score_tka += $current_score_tka;
                                        if ($v['category'] == 'saintek' || $v['category'] == 'soshum') :
                                ?>
                                            <tr>
                                                <th scope="row"><?= ucwords($v['subject']) ?></th>
                                                <td class="text-light" style="--size: calc( <?= $v['score'] ?> / <?= $score_limit[$v['kategori_soal_id']]['max'] ?> ); --color: <?= $chart_colors[$subject_tka - 1] ?>"><b><?= $v['score'] ?></b></td>
                                            </tr>
                                <?php
                                        $subject_tka++;
                                        endif;
                                    endforeach;
                                endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: Activity -->

<script>
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
</script>