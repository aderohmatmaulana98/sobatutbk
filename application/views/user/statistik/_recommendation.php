<?php
$bg_color = array("bg-biru-muda", "bg-orange");
$text_color = array("text-orange", "text-biru-muda");
?>

<!-- Begin: Recommendation -->
<div class="row recommendation hide-content">
    <div class="col-xl-8 col-lg-12">
        <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">Pilihan Prodi Berdasarkan Minat Siswa</div>
            </div>
            <?php
            if (!empty($choosen_university)) :
                $x = 0;
                foreach ($choosen_university as $v) :
            ?>
                    <div class="table-responsive px-4 mb-4">
                        <table class="table table-borderless text-center table-gradient table-rounded table-v" style="width: auto!important">
                            <tbody class="text-light">
                                <tr>
                                    <td class="<?= $bg_color[$x] ?>" width="100px"><?= $v['provinsi'] ?></td>
                                    <td class="text-nowrap">
                                        <span style="font-size: 16pt; font-weight: bolder;" class="<?= $text_color[$x] ?>"><?= $v['nama'] ?></span><br>
                                        <span><?= $v['jurusan'] ?></span>
                                    </td>
                                    <td width="80px">
                                        <div class="pie big-pie" data-value="<?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 0) : "0" ?>" data-real-value="<?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>"></div>
                                    </td>
                                    <td class="text-nowrap">DT: <?= $v['daya_tampung'] ?><br>Poin Prodi: <?= round($v['point'], 2) ?></td>
                                    <td width="200px">Nilai: <b><?= round($avg_score['score'], 2) ?></b><br><span class="btn btn-primary <?= $v['point'] < $avg_score['score'] ? 'bg-orange' : 'bg-biru-muda' ?>"><?= $v['point'] < $avg_score['score'] ? 'Berpeluang Masuk' : 'Tingkatkan Lagi Nilai Anda' ?></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            <?php
                    $x++;
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>

<div class="row recommendation hide-content">
    <div class="col-xl-8 col-lg-12">
        <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">Rekomendasi Pilihan Prodi yang Sama Sesuai Pilihan Siswa Di Provinsi yang Dipilih</div>
            </div>
            <div class="table-responsive px-4">
                <table class="table table-borderless text-left table-gradient table-rounded table-v" style="width: auto!important">
                    <tbody class="text-light">
                        <?php if (!empty($output2[0]) || !empty($output2[1])) :
                            foreach ($output2 as $output) :
                                if (!empty($output)) :
                                    foreach ($output as $key => $v) :
                        ?>
                                        <tr>
                                            <?php
                                            if ($key == 0) { ?>
                                                <td rowspan="<?= count($output) ?>" class="bg-biru-muda text-center" width="100px"><?= $v['provinsi'] ?></td>
                                            <?php }
                                            ?>
                                            <td class="text-nowrap" style="padding-left: 3rem;">
                                                <span style="font-size: 16pt; font-weight: bolder;" class="text-orange"><?= $v['nama'] ?></span><br>
                                                <span><?= $v['jurusan'] ?></span><br>
                                                <span>DT: <?= $v['daya_tampung'] ?></span><br>
                                                <span>Poin Prodi: <?= round($v['point'], 2) ?></span><br>
                                                <span class="btn btn-white">Nilai: <b><?= round($avg_score['score'], 2) ?></b></span>
                                            </td>
                                            <td rowspan="1">
                                                <div class="pie big-pie" data-value="<?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 0) : "0" ?>" data-real-value="<?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>"></div>
                                            </td>
                                        </tr>
                        <?php
                                    endforeach;
                                endif;
                            endforeach;
                        else :
                            echo '<span style="text-align: center">Tidak ada rekomendasi berdasarkan skor yang diraih</span>';
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
                <?php
                if (!empty($output3[0]) || !empty($output3[1])) :
                ?>
                    <table class="table table-borderless table-gradient table-v" style="width: auto!important">
                        <thead>
                            <tr class="text-light">
                                <th colspan="3" class="bg-putih"></th>
                                <th class="bg-biru-muda text-nowrap">DT</th>
                                <th class="bg-orange text-nowrap">IK (%)</th>
                                <th class="bg-biru-muda text-nowrap">POIN PRODI</th>
                                <th class="bg-orange"></th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php
                            
                            $numItems = count($output3);
                            $i = 0;
                            foreach ($output3 as $okey => $output) :
                                if (!empty($output)) :
                                    $i++;
                                    foreach ($output as $key => $v) :
                            ?>
                                        <tr>
                                            <?php
                                            if ($key == 0) { ?>
                                                <td rowspan="<?= count($output) ?>" class="<?= $okey == 0 && $key == 0 ? 'bg-biru-muda' : 'bg-orange' ?> text-center" width="100px"><?= $v['jurusan'] ?></td>
                                            <?php }
                                            ?>
                                            <td class="b-bottom-color text-nowrap"><?= $v['provinsi'] ?></td>
                                            <td class="b-bottom-color text-nowrap"><span class="<?= $i === $numItems ? 'text-orange' : 'text-biru-muda' ?>" style="font-weight: bolder;"><?= $v['nama'] ?></span></td>
                                            <td><?= $v['daya_tampung'] ?></td>
                                            <td><?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?></td>
                                            <td><?= $v['point'] ?></td>
                                            <?php
                                            if ($okey == 0 && $key == 0) { ?>
                                                <td rowspan="6" class="bg-orange"><span style="font-size: 16pt; font-weight: bolder;">Nilai<br><b><?= round($avg_score['score'], 2) ?></b></span></td>
                                            <?php }
                                            ?>
                                        </tr>
                            <?php
                                    endforeach;
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                <?php
                else :
                    echo '<span style="text-align: center">Tidak ada rekomendasi berdasarkan skor yang diraih</span>';
                endif;
                ?>
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
                <?php
                if (!empty($output4[0]) || !empty($output4[1])) :
                ?>
                    <table class="table table-borderless table-gradient table-v" style="width: auto!important">
                        <thead>
                            <tr class="text-light">
                                <th colspan="2" class="bg-putih"></th>
                                <th class="bg-biru-muda text-nowrap">DT</th>
                                <th class="bg-orange text-nowrap">IK (%)</th>
                                <th class="bg-biru-muda text-nowrap">POIN PRODI</th>
                                <th class="bg-orange"></th>
                            </tr>
                        </thead>
                        <tbody class="text-light">
                            <?php

                            $numItems = count($output4);
                            $i = 0;
                            foreach ($output4 as $okey => $output) :
                                $i++;
                                if (!empty($output)) :
                                    foreach ($output as $key => $v) :
                            ?>
                                        <tr>
                                            <?php
                                            if ($key == 0) { ?>
                                                <td rowspan="<?= count($output) ?>" class="<?= $okey == 0 && $key == 0 ? 'bg-biru-muda' : 'bg-orange' ?> text-center" width="100px"><?= $v['nama'] . '(' . $v['provinsi'] . ')' ?></td>
                                            <?php }
                                            ?>
                                            <td class="b-bottom-color text-nowrap"><span class="<?= $i === $numItems ? 'text-orange' : 'text-biru-muda' ?>" style="font-weight: bolder;"><?= $v['jurusan'] ?></span></td>
                                            <td><?= $v['daya_tampung'] ?></td>
                                            <td><?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?></td>
                                            <td><?= $v['point'] ?></td>
                                            <?php if ($okey == 0 && $key == 0) { ?>
                                                <td rowspan="6" class="bg-orange"><span style="font-size: 16pt; font-weight: bolder;">Nilai<br><b><?= round($avg_score['score'], 2) ?></b></span></td>
                                            <?php } ?>
                                        </tr>
                            <?php
                                    endforeach;
                                endif;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                <?php
                else :
                    echo '<span style="text-align: center">Tidak ada rekomendasi berdasarkan skor yang diraih</span>';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>

<div class="row recommendation hide-content">
    <div class="col-lg-12">
        <div class="card shadow welcome border-0" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam">Rekomendasi Pilihan Prodi Sesuai Kompetensi Siswa di PTN yang Dipilih</div>
            </div>
            <div class="row px-4 py-2">
                <?php
                if (!empty($output5[0]) || !empty($output5[1])) :
                    foreach ($output5 as $okey => $output) :
                        if (!empty($output)) :
                ?>
                            <div class="col-lg-6">
                                <div class="table-responsive">
                                    <table class="table table-borderless table-gradient table-rounded table-v table-recommend text-light" style="width: auto!important">
                                        <thead>
                                            <tr>
                                                <th colspan="<?= count($output) ?>" class="bg-<?= $okey == 0 ? 'orange' : 'biru-muda' ?>"><span style="font-size: 16pt;font-weight: bolder;"><?= $output[0]['nama'] ?></span><br><?= $output[0]['provinsi'] ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="b-right-color">
                                            <tr>
                                                <?php foreach ($output as $key => $v) : ?>
                                                    <td><span class="text-<?= $okey == 0 ? 'orange' : 'biru-muda' ?>" style="font-weight: bolder;"><?= $v['jurusan'] ?></span></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <tr>
                                                <?php foreach ($output as $key => $v) : ?>
                                                    <td>DT : <?= $v['daya_tampung'] ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <tr>
                                                <?php foreach ($output as $key => $v) : ?>
                                                    <td>Poin Prodi : <?= $v['point'] ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <tr>
                                                <?php foreach ($output as $key => $v) : ?>
                                                    <td>
                                                        <div class="pie big-pie" data-value="<?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 0) : "0" ?>" data-real-value="<?= $v['daya_tampung'] > 0 ? round($v['daya_tampung'] / $v['peminat'] * 100, 2) : "0" ?>">
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="<?= count($output) ?>" class="bg-<?= $okey == 0 ? 'orange-tua' : 'biru' ?>"><span style="font-size: 14pt;font-weight: bolder;">Nilai: <b><?= round($avg_score['score'], 2) ?></b></span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                <?php
                        endif;
                    endforeach;
                else :
                    echo '<span style="text-align: center">Tidak ada rekomendasi berdasarkan skor yang diraih</span>';
                endif;
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End: Recommendation -->