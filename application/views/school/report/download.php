<?php
$chart_colors = array("#ef8521", "#182f64", "#24C0F1", "#00be29");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('asset/user/') ?>img/logo.png" type="image/gif">
    <title><?= $title ?> - SobatUTBK</title>
    <link rel="stylesheet" href="<?= base_url('asset/homepage/css/app.css') ?>?version=<?php echo filemtime('./asset/homepage/css/app.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('asset/homepage/css/app.css') ?>?version=<?php echo filemtime('./asset/homepage/css/app.css'); ?>" media="print">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('asset/user/') ?>css/style.css?version=<?php echo filemtime('./asset/user/css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/charts.css/dist/charts.min.css">
    <link rel="stylesheet" href="<?= base_url('asset/user/') ?>css/progress-chart.css?version=<?php echo filemtime('./asset/user/css/progress-chart.css'); ?>">
</head>

<body id="cmd">
    <div id="app" class="w-full md:w-full lg:w-3/4 mx-auto mt-4">
        <!-- BEGIN: Content -->
        <template id="content">
            <?php
            if (!empty($utbk_score)) { ?>
                <!-- BEGIN: Panel -->
                <main class="grid grid-cols-12 gap-4">
                    <!-- BEGIN: Panel Download -->
                    <div class="col-span-12 lg:col-span-4">
                        <section class="border-gray-200 col-span-full flex flex-col p-4">
                            <div class="relative content-box border border-gray-100 items-center p-4 rounded-lg">
                                <h2 class="text-blue-theme2 text-2xl font-extrabold leading-tight mt-3 text-center" >Pengaturan Export</h2>
                                <div class="mt-3 flex flex-col">
                                    <label for="setting-form-1" class="mb-2">Nama File</label>
                                    <input type="text" class="rounded-lg py-2 px-2 border border-gray-300 float-right w-full focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-200" id="setting-form-1" v-model="option_pdf.filename">
                                </div>

                                <div class="mt-3 flex flex-col">
                                    <label for="setting-form-2" class="mb-2">Orientasi</label>
                                    <select class="rounded-lg py-2 px-2 border border-gray-300 h-10 p-6 text-base placeholder-gray-600 appearance-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-200" placeholder="Pilih Orientasi" id="forms-orientation" name="setting-form-2" v-model="option_pdf.orientation">
                                        <option value="portrait">Portrait</option>
                                        <option value="landscape">Landscape</option>
                                    </select>
                                </div>

                                <div class="mt-3 flex flex-col">
                                    <label for="setting-form-3" class="mb-2">Ukuran Kertas</label>
                                    <select class="rounded-lg py-2 px-2 border border-gray-300 h-10 p-6 text-base placeholder-gray-600 appearance-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-200" placeholder="Pilih Ukuran" id="forms-size" name="setting-form-3" v-model="option_pdf.format">
                                        <option value="letter">Letter</option>
                                        <option value="a4" selected>A4</option>
                                    </select>
                                </div>

                                <div class="mt-3 flex flex-col">
                                    <label for="setting-form-4" class="mb-2">Kualitas PDF</label>
                                    <select class="rounded-lg py-2 px-2 border border-gray-300 h-10 p-6 text-base placeholder-gray-600 appearance-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-indigo-200" placeholder="Pilih Ukuran" id="forms-quality" name="setting-form-4" v-model="option_pdf.quality">
                                        <option value="0.5">Rendah</option>
                                        <option value="0.95">Standar</option>
                                        <option value="1">Bagus</option>
                                    </select>
                                </div>

                                <div class="mt-6 block">
                                    <button class="content-box w-full items-center hover:text-white text-gray-50 bg-blue-400 h-10 px-4 transition-colors duration-150 rounded-lg focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-blue-200 hover:bg-blue-600 font-semibold" @click="exportToPDF">Download File</button>
                                </div>
                            </div>
                        </section>
                    </div>
                    <!-- END: Panel Download -->

                    <!-- BEGIN: Panel Report -->
                    <div class="grid grid-cols-12 gap-4 col-span-12 lg:col-span-8" ref="report">
                        <!-- BEGIN: Panel Detail -->
                        <section class="col-span-full flex flex-col p-4 pb-0 rounded-lg pdf-item" style="font-family: 'Montserrat', sans-serif;">
                            <div class="relative border border-gray-800 items-center py-4 text-center rounded-xl">
                                <div class="flex flex-row min-w-full">
                                    <img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" class="ml-4" alt="" width="20%">
                                    <img src="<?= base_url('asset/user/img'); ?>/ornament-top-report.jpg" class="mr-0 flex-1 ml-36" alt="" width="40%">
                                </div>
                                <h2 class="text-blue-theme2 text-2xl font-extrabold leading-tight mt-3">Report Tryout SobatUTBK</h2>

                                <div class="pt-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 mt-4">
                                    <table class="table-auto table-identity divide-y divide-gray-200 mx-auto text-lg font-semibold text-orange-dark border border-orange border-solid">
                                        <tr>
                                            <td class="text-right">Nama</td>
                                            <td>:</td>
                                            <td class="text-left">
                                                <?php if ($this->session->userdata('name')) {
                                                    echo ucwords(strtolower($this->session->userdata('name')));
                                                } else {
                                                    echo $this->session->userdata('username');
                                                }; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">NISN</td>
                                            <td>:</td>
                                            <td class="text-left"><?= $user->username ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">Sekolah</td>
                                            <td>:</td>
                                            <td class="text-left"><?= $user->company ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </section>

                        <section class="col-span-full flex flex-row p-4 rounded-lg" style="font-family: 'Montserrat', sans-serif;">
                            <div class="flex-1 relative border border-gray-800 items-center py-4 rounded-xl mr-2 pdf-item">
                                <h2 class="text-blue-theme2 text-xl font-extrabold leading-tight mt-3 text-center" >Report Nilai<br>Tes Potensi Skolastik</h2>

                                <!-- BEGIN: Report Nilai TPS -->

                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">
                                    <table class="charts-css column show-labels show-4-secondary-axes data-spacing-20 text-xs" id="chart-print">
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
                                                            <td class="text-white" style="--size: calc( <?= $v['score'] ?> / <?= $score_limit[$v['kategori_soal_id']]['max'] ?> ); --color: <?= $chart_colors[$subject_tps - 1] ?>"><b><?= $v['score'] ?></b></td>
                                                        </tr>
                                            <?php
                                                        $subject_tps++;
                                                    endif;
                                                endforeach;
                                            endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-certificate text-white">
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col" class="bg-biru-muda text-sm font-bold px-2 py-2 text-center" width="70%">Materi Uji</th>
                                                <th scope="col" class="bg-biru text-sm font-bold px-2 py-2 text-center" width="30%">Nilai TPS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        <tr class="border-b">
                                                            <td class="whitespace-normal text-sm font-medium"><?= ucwords($v['subject']) ?></td>
                                                            <td class="text-sm font-light whitespace-nowrap"><b><?= $v['score'] ?></b></td>
                                                        </tr>
                                            <?php
                                                    endif;
                                                endforeach;
                                            endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Report Nilai TPS -->

                            </div>
                                
                            <div class="flex-1 relative border border-gray-800 items-center py-4 rounded-xl ml-2 pdf-item">

                                <h2 class="text-blue-theme2 text-xl font-extrabold leading-tight mt-3 text-center" >Report Nilai<br>Tes Kemampuan Akademik</h2>

                                <!-- BEGIN: Report Nilai TKA -->
                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">
                                    <table class="charts-css column show-labels show-4-secondary-axes data-spacing-20 text-xs" id="chart-print">
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
                                                            <td class="text-white" style="--size: calc( <?= $v['score'] ?> / <?= $score_limit[$v['kategori_soal_id']]['max'] ?> ); --color: <?= $chart_colors[$subject_tka - 1] ?>"><b><?= $v['score'] ?></b></td>
                                                        </tr>
                                            <?php
                                                        $subject_tka++;
                                                    endif;
                                                endforeach;
                                            endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-certificate text-white" >
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col" class="bg-biru-muda text-sm font-bold px-2 py-2 text-center" width="70%">Materi Uji</th>
                                                <th scope="col" class="bg-biru text-sm font-bold px-2 py-2 text-center" width="30%">Nilai TKA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
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
                                                        <tr class="border-b">
                                                            <td class="whitespace-nowrap text-sm font-medium"><?= ucwords($v['subject']) ?></td>
                                                            <td class="text-sm font-light whitespace-nowrap"><b><?= $v['score'] ?></b></td>
                                                        </tr>
                                            <?php
                                                    endif;
                                                endforeach;
                                            endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </section>

                        <div class="html2pdf__page-break"></div>

                        <section class="col-span-full flex flex-col p-4 rounded-lg pdf-item" style="font-family: 'Montserrat', sans-serif;">
                            <div class="relative border border-gray-800 items-center py-4 rounded-xl">
                                <h2 class="text-blue-theme2 text-2xl font-extrabold leading-tight mt-3 text-center">Pilihan Prodi</h2>

                                <!-- BEGIN: Pilihan Prodi -->
                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-certificate text-white">
                                        <thead class="border-b">
                                            <tr>
                                                <th scope="col" class="bg-biru-muda text-sm font-bold px-6 py-2 text-center" width="40%">Universitas</th>
                                                <th scope="col" class="bg-biru text-sm font-bold px-6 py-2 text-center" width="15%">DT</th>
                                                <th scope="col" class="bg-biru-muda text-sm font-bold px-6 py-2 text-center" width="15%">IK</th>
                                                <th scope="col" class="bg-biru text-sm font-bold px-6 py-2 text-center" width="30%">POIN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $text_color = array("text-orange", "text-blue-400");

                                            if (!empty($choosen_university)) :
                                                $x = 0;
                                                foreach ($choosen_university as $v) :
                                            ?>
                                            <tr class="border-b">
                                                <td class="px-6 py-2 whitespace-normal text-base font-medium">
                                                    <span class="font-bold <?= $text_color[$x] ?>"><?= $v['nama'] ?></span><br>
                                                    <span><?= $v['jurusan'] ?></span><br>
                                                    <span><?= $v['provinsi'] ?></span>
                                                </td>
                                                <td class="text-base px-6 py-2 whitespace-nowrap"><?= $v['daya_tampung'] ?></td>
                                                <td class="text-base px-6 py-2 whitespace-nowrap"><?= $v['daya_tampung'] > 0 && $v['peminat'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>%</td>
                                                <td class="text-base px-6 py-2"><button class="rounded-xl px-4 py-2 <?= $v['point'] < $avg_score['score'] ? 'bg-orange' : 'bg-biru-muda text-biru' ?>"><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></button></td>
                                            </tr>
                                            <?php
                                                    $x++;
                                                endforeach;
                                            endif;
                                            ?>
                                            <tr class="bg-biru">
                                                <td class="px-6 py-2 whitespace-nowrap text-base font-bold" colspan="4">
                                                    Nilai: <?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Pilihan Prodi -->

                            </div>
                        </section>

                        <?php if (!empty($output2[0]) || !empty($output2[1])) {
                            if (count($output2) == 1) { ?>
                        <div class="html2pdf__page-break"></div>
                            <?php }
                        } ?>

                        <section class="col-span-full flex flex-col p-4 rounded-lg pdf-item" style="font-family: 'Montserrat', sans-serif;">
                            <div class="relative border border-gray-800 items-center py-4 rounded-xl">
                                <h2 class="text-blue-theme2 text-2xl font-bold leading-tight mt-3 text-center">Rekomendasi Pilihan Prodi yang Sama<br>Sesuai Pilihan Siswa Di Provinsi yang Dipilih</h2>

                                <!-- BEGIN: Rekomendasi Pilihan Prodi 1 -->
                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-certificate text-white">
                                        <tbody>
                                            <?php
                                            $x = 0;
                                            $bg_color = array("bg-biru-muda text-biru", "bg-biru text-white");

                                            if (!empty($output2[0]) || !empty($output2[1])) :
                                                foreach ($output2 as $output) :
                                                    if (!empty($output)) :
                                                        foreach ($output as $key => $v) :
                                            ?>
                                            <tr class="<?= $bg_color[$x] ?>">
                                                <td class="px-6 py-2 whitespace-nowrap text-base" colspan="4">
                                                    <span class="font-bold text-lg"><?= $v['nama'] ?></span>
                                                </td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-6 py-2 whitespace-normal text-base font-medium"><?= $v['jurusan'] ?></td>
                                                <td class="text-base px-6 py-2 whitespace-nowrap" rowspan="2">IK:<br><?= $v['daya_tampung'] > 0 && $v['peminat'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>%</td>
                                                <td class="text-base px-6 py-2">DT: <?= $v['daya_tampung'] ?></td>
                                                <td class="text-base px-6 py-2">Nilai: <?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?></td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-6 py-2 whitespace-normal text-base font-medium"><?= $v['provinsi'] ?></td>
                                                <td class="text-base px-6 py-2">Poin Prodi: <?= round($v['point'], 2) ?></td>
                                                <td class="text-base px-6 py-2"><button class="rounded-xl px-4 py-2 <?= $v['point'] < $avg_score['score'] ? 'bg-orange' : 'bg-biru-muda text-biru' ?>"><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></button></td>
                                            </tr>
                                            <?php
                                                            if ($x == 1) $x = 0;
                                                            else $x++;
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                            else :
                                                echo '<tr class="text-center"><td><span>Tidak ada rekomendasi berdasarkan skor yang diraih</span></td></tr>';
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Rekomendasi Pilihan Prodi 1 -->

                            </div>
                        </section>

                        <?php if (!empty($output3[0]) || !empty($output3[1])) {?>
                        <div class="html2pdf__page-break"></div>
                        <?php } ?>

                        <section class="col-span-full flex flex-col p-4 rounded-lg pdf-item" style="font-family: 'Montserrat', sans-serif;">
                            <div class="relative border border-gray-800 items-center py-4 rounded-xl">
                                <h2 class="text-blue-theme2 text-2xl font-bold leading-tight mt-3 text-center">Rekomendasi Pilihan Prodi yang Sama<br>Sesuai Pilihan Siswa Di Wilayah (Region) PTN</h2>

                                <!-- BEGIN: Rekomendasi Pilihan Prodi 2 -->
                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-download text-white">
                                        <tbody>
                                            <?php
                                            if (!empty($output3[0]) || !empty($output3[1])) :

                                                $numItems = count($output3);
                                                $i = 0;
                                                foreach ($output3 as $okey => $output) :
                                                    if (!empty($output)) :
                                                        $i++;
                                                        foreach ($output as $key => $v) :
                                            ?>
                                            <?php
                                            if ($key == 0) { ?>
                                            <tr class='<?= $i === $numItems ? "bg-biru-muda text-biru" : "bg-biru text-white" ?>'>
                                                <td class="px-6 py-2 whitespace-nowrap text-base" colspan="4">
                                                    <span class="font-bold text-lg"><?= $v['jurusan'] ?></span>
                                                </td>
                                            </tr>
                                            <?php }
                                            ?>
                                            <tr>
                                                <td class="px-6 py-2 whitespace-normal text-base font-bold"><?= $v['nama'] ?></td>
                                                <td class="text-base px-6 py-2 whitespace-nowrap" rowspan="2">IK:<br><?= $v['daya_tampung'] > 0 && $v['peminat'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>%</td>
                                                <td class="text-base px-6 py-2">DT: <?= $v['daya_tampung'] ?></td>
                                                <td class="text-base px-6 py-2">Nilai: <?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?></td>
                                            </tr>
                                            <tr class="border-b">
                                                <td class="px-6 py-2 whitespace-normal text-base font-medium"><?= $v['provinsi'] ?></td>
                                                <td class="text-base px-6 py-2">Poin Prodi: <?= round($v['point'], 2) ?></td>
                                                <td class="text-base px-6 py-2"><button class="rounded-xl px-4 py-2 <?= $v['point'] < $avg_score['score'] ? 'bg-orange' : 'bg-biru-muda text-biru' ?>"><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></button></td>
                                            </tr>
                                            <?php
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                            else :
                                                echo '<tr class="text-center"><td><span>Tidak ada rekomendasi berdasarkan skor yang diraih</span></td></tr>';
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Rekomendasi Pilihan Prodi 2 -->

                            </div>
                        </section>

                        <div class="html2pdf__page-break"></div>

                        <section class="col-span-full flex flex-col p-4 rounded-lg pdf-item" style="font-family: 'Montserrat', sans-serif;">
                            <div class="relative border border-gray-800 items-center py-4 rounded-xl">
                                <h2 class="text-blue-theme2 text-2xl font-bold leading-tight mt-3 text-center">Rekomendasi Pilihan Prodi<br>Sesuai Pilihan Siswa</h2>

                                <!-- BEGIN: Rekomendasi Pilihan Prodi 3 -->
                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-download text-white">
                                        <tbody>
                                            <?php
                                            $bg_color = array("bg-biru-muda text-biru", "bg-biru text-white");

                                            if (!empty($output4[0]) || !empty($output4[1])) :

                                                $numItems = count($output4);
                                                $i = 0;
                                                foreach ($output4 as $okey => $output) :
                                                    $i++;
                                                    if (!empty($output)) :
                                                        foreach ($output as $key => $v) :
                                            ?>

                                            <?php
                                            if ($key == 0) { ?>
                                            <tr class='<?= $i === $numItems ? "bg-biru-muda text-biru" : "bg-biru text-white" ?>'>
                                                <td class="px-6 py-2 whitespace-nowrap text-base" colspan="5">
                                                    <span class="font-bold text-lg"><?= $v['nama'] ?></span>
                                                </td>
                                            </tr>
                                            <?php }
                                            ?>
                                            <tr>
                                                <td class="px-6 py-2 whitespace-normal text-base font-bold" rowspan="2"><?= $v['jurusan'] ?></td>
                                                <td class="text-base px-6 py-2 whitespace-nowrap" rowspan="2">IK:<br><?= $v['daya_tampung'] > 0 && $v['peminat'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>%</td>
                                                <td class="text-base px-6 py-2">DT: <?= $v['daya_tampung'] ?></td>
                                                <td class="text-base px-6 py-2">Poin Prodi: <?= round($v['point'], 2) ?></td>
                                            <?php
                                            if ($key == 0) { ?>
                                                <td class="text-base px-6 py-2 font-bold bg-orange" rowspan="<?= $numItems ?>">Nilai<br><?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?></td>
                                            </tr>
                                            <?php }
                                            ?>

                                            <?php
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                            else :
                                                echo '<tr class="text-center"><td><span>Tidak ada rekomendasi berdasarkan skor yang diraih</span></td></tr>';
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Rekomendasi Pilihan Prodi 3 -->

                            </div>
                        </section>

                        <?php if (!empty($output5[0]) || !empty($output5[1])) {?>
                        <div class="html2pdf__page-break"></div>
                        <?php } ?>

                        <section class="col-span-full flex flex-col p-4 rounded-lg pdf-item" style="font-family: 'Montserrat', sans-serif;">
                            <div class="relative border border-gray-800 items-center py-4 rounded-xl">
                                <h2 class="text-blue-theme2 text-2xl font-bold leading-tight mt-3 text-center">Rekomendasi Pilihan Prodi<br>Sesuai Kompetensi Siswa di PTN yang Dipilih</h2>

                                <!-- BEGIN: Rekomendasi Pilihan Prodi 4 -->
                                <div class="py-2 px-5 align-middle inline-block min-w-full sm:px-6 lg:px-8 my-4">

                                    <table class="min-w-full table-auto table table-gradient table-rounded table-v table-download text-white">
                                        <tbody>
                                            <?php
                                            $bg_color = array("bg-biru-muda text-biru", "bg-biru text-white");

                                            if (!empty($output5[0]) || !empty($output5[1])) :
                                                $numItems = count($output4);
                                                $i = 0;
                                                foreach ($output5 as $okey => $output) :
                                                    $i++;
                                                    if (!empty($output)) :
                                                        foreach ($output as $key => $v) :
                                            ?>

                                            <?php
                                            if ($key == 0) { ?>
                                            <tr class='<?= $i === $numItems ? "bg-biru-muda text-biru" : "bg-biru text-white" ?>'>
                                                <td class="px-6 py-2 whitespace-nowrap text-base" colspan="5">
                                                    <span class="font-bold text-lg"><?= $v['nama'] ?></span>
                                                </td>
                                            </tr>
                                            <?php }
                                            ?>
                                            <tr>
                                                <td class="px-6 py-2 whitespace-normal text-base font-bold" rowspan="2"><?= $v['jurusan'] ?></td>
                                                <td class="text-base px-6 py-2 whitespace-nowrap" rowspan="2">IK:<br><?= $v['daya_tampung'] > 0 && $v['peminat'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>%</td>
                                                <td class="text-base px-6 py-2">DT: <?= $v['daya_tampung'] ?></td>
                                                <td class="text-base px-6 py-2">Poin Prodi: <?= round($v['point'], 2) ?></td>
                                            <?php
                                            if ($key == 0) { ?>
                                                <td class="text-base px-6 py-2 font-bold bg-orange" rowspan="<?= $numItems ?>">Nilai<br><?= is_null($avg_score['score']) ? 0 : round($avg_score['score'], 2) ?></td>
                                            </tr>
                                            <?php }
                                            ?>

                                            <?php
                                                        endforeach;
                                                    endif;
                                                endforeach;
                                            else :
                                                echo '<tr class="text-center"><td><span>Tidak ada rekomendasi berdasarkan skor yang diraih</span></td></tr>';
                                            endif;
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <!-- END: Rekomendasi Pilihan Prodi 4 -->

                            </div>
                        </section>

                        <!-- END: Panel Detail -->
                    </div>
                    <!-- END: Panel Report -->
                </main>
                <!-- END: Panel -->
            <?php } else { ?>
                <div class="flex h-screen">
                    <div class="m-auto">
                        <?= form_open(base_url(uri_string()).'?'.$_SERVER['QUERY_STRING'], ['class' => 'bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4']) ?>
                        <div class="relative mb-3">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" name="tryout_group">
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
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>

                        <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Pilih</button>
                        <?= form_close() ?>
                    </div>
                </div>
            <?php } ?>
        </template>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.common.dev.min.js" integrity="sha512-TpgbLHXaTCAZ7ULhjopb1PveTz5Jx6KEQUtMfXhV0m0EArh+6O8ybZjjDN1Yug6oagN6iFm6EoMjuYSiFr0qXQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.0/html2pdf.bundle.min.js"></script>

    <script>
        new Vue({
            components: {
                html2pdf: html2pdf
            },
            data() {
                return {
                    option_pdf: {
                        filename: 'Report Tryout SobatUTBK - <?php if ($this->session->userdata('name')) { echo addslashes(ucwords(strtolower($this->session->userdata('name')))); } else { echo addslashes($this->session->userdata('username'));} ?>',
                        format: 'a4',
                        orientation: 'portrait',
                        quality: 0.95
                    }
                }
            },
            methods: {
                exportToPDF() {
                    html2pdf(this.$refs.report, {
                        margin: 0.5,
                        filename: this.option_pdf.filename + '.pdf',
                        pagebreak: {
                            mode: ['legacy']
                        },
                        image: {
                            type: 'jpeg',
                            quality: this.option_pdf.quality
                        },
                        html2canvas: {
                            dpi: 192,
                            letterRendering: true
                        },
                        jsPDF: {
                            unit: 'in',
                            format: this.option_pdf.format,
                            orientation: this.option_pdf.orientation
                        }
                    })
                }
            }
        }).$mount('#app')
    </script>
</body>