<div class="row my-3 recap <?= null === $output['filter'] && null === $output['filter-nilai'] ? 'hide-content' : '' ?>">
    <div class="col-12">
        <div class="card shadow mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 form-inline">
                        <?php if ($output['tryout_group_id'] > 0) : ?>
                            <?= form_open('manage_school/placement', ['class' => 'form-inline']) ?>
                            <div class="form-group">
                                <div class="text-hitam pr-2">Filter:</div>
                                <select name="filter" class="form-control" id="filter">
                                    <option value="0" <?= $output['filter'] === '0' ? 'selected' : '' ?>>Semua</option>
                                    <option value="saintek" <?= $output['filter'] === 'saintek' ? 'selected' : '' ?>>Pilihan Saintek</option>
                                    <option value="soshum" <?= $output['filter'] === 'soshum' ? 'selected' : '' ?>>Pilihan Soshum</option>
                                </select>
                                <div class="text-hitam pr-2">&nbsp; Tampilkan:</div>
                                <select name="filter-nilai" class="form-control" id="filter-nilai" style="margin-right: 10px">
                                    <option value="0" <?= $output['filter-nilai'] === '0' ? 'selected' : '' ?>>Semua Nilai</option>
                                    <option value="TKA" <?= $output['filter-nilai'] === 'TKA' ? 'selected' : '' ?>>Nilai TKA</option>
                                    <option value="TPS" <?= $output['filter-nilai'] === 'TPS' ? 'selected' : '' ?>>Nilai TPS</option>
                                </select>
                                <input type="hidden" name="tryout_group" value="<?= $output['tryout_group_id'] ?>">
                                <button type="submit" class="btn" style="background-color: #EF8521; color: white; padding-left: 10px">Tampilkan</button>
                                <!-- <div class="form-check mx-2">
                                <input class="form-check-input" type="radio" value="all" id="flexCheckSemua" name="radioTampilkan" checked>
                                <label class="form-check-label" for="flexCheckSemua">
                                    Semua Nilai
                                </label>
                            </div>
                            <div class="form-check mx-2">
                                <input class="form-check-input" type="radio" value="tps" id="flexCheckNilaiTPS" name="radioTampilkan">
                                <label class="form-check-label" for="flexCheckNilaiTPS">
                                    Nilai TPS
                                </label>
                            </div>
                            <div class="form-check mx-2">
                                <input class="form-check-input" type="radio" value="tka" id="flexCheckNilaiTPA" name="radioTampilkan">
                                <label class="form-check-label" for="flexCheckNilaiTPA">
                                    Nilai TKA
                                </label>
                            </div> -->
                            </div>
                            <?= form_close() ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-6 form-inline justify-content-end">
                        <div class="form-group float-end">

                            <?php if ($output['tryout_group_id'] > 0) : ?>
                                <?= form_open('manage_school/placement/nilai_tryout') ?>
                                <input type="hidden" name="tryout_group_id" value="<?= $output['tryout_group_id'] ?>">
                                <button type="submit" class="btn btn-success text-white" style="background-color: #16a362;">
                                    <svg class="h-8 w-8 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" />
                                        <path d="M19 18a3.5 3.5 0 0 0 0 -7h-1a5 4.5 0 0 0 -11 -2a4.6 4.4 0 0 0 -2.1 8.4" />
                                        <line x1="12" y1="13" x2="12" y2="22" />
                                        <polyline points="9 19 12 22 15 19" />
                                    </svg> Download Rekapitulasi
                                </button>
                                <?= form_close() ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="table-responsive p-2">
                    <table class="table table-bordered table-striped text-center nowrap" id='data_table' width="100%">
                        <thead>
                            <tr class="rounded border text-putih align-middle">
                                <th class="bg-orange" rowspan="2">No</th>
                                <th class="bg-biru" rowspan="2">Username</th>
                                <th class="bg-orange" rowspan="2">Nama</th>
                                <?php if ($output['filter-nilai'] !== 'TKA') : ?>
                                    <th class="bg-biru nilai-tps" colspan="4">Tes Potensi Akademik</th>
                                <?php endif;
                                if ($output['filter-nilai'] !== 'TPS') : ?>
                                    <th class="bg-orange nilai-tka" colspan="8">Tes Kompetensi Akademik</th>
                                <?php endif; ?>
                            </tr>
                            <tr class="rounded border text-putih">
                                <?php if ($output['filter-nilai'] !== 'TKA') : ?>
                                    <th class="bg-biru-1 nilai-tps">PU</th>
                                    <th class="bg-biru-2 nilai-tps">PBM</th>
                                    <th class="bg-biru-1 nilai-tps">PPU</th>
                                    <th class="bg-biru-2 nilai-tps">PK</th>
                                    <?php endif;
                                if ($output['filter-nilai'] !== 'TPS') :
                                    if ($output['filter'] !== 'soshum') : ?>
                                        <th class="bg-orange-tua nilai-tka saintek">Matematika</th>
                                        <th class="bg-orange-muda nilai-tka saintek">Biologi</th>
                                        <th class="bg-orange-tua nilai-tka saintek">Fisika</th>
                                        <th class="bg-orange-muda nilai-tka saintek">Kimia</th>
                                    <?php endif;
                                    if ($output['filter'] !== 'saintek') : ?>
                                        <th class="bg-orange-tua nilai-tka soshum">Sejarah</th>
                                        <th class="bg-orange-muda nilai-tka soshum">Ekonomi</th>
                                        <th class="bg-orange-tua nilai-tka soshum">Geografi</th>
                                        <th class="bg-orange-muda nilai-tka soshum">Sosiologi</th>
                                <?php endif;
                                endif; ?>
                            </tr>
                        </thead>
                        <tbody class="text-hitam">
                            <?php
                            if (!empty($exam_data_score)) {
                                $no = 1;
                                foreach ($exam_data_score as $v) {
                            ?>
                                    <tr class="<?= $v['category'] == 'saintek' ? 'saintek-category' : 'soshum-category' ?>">
                                        <td><?= $no ?></td>
                                        <td><?= $v['username'] ?></td>
                                        <td><?= $v['first_name'] ?></td>
                                        <?php if ($output['filter-nilai'] !== 'TKA') : ?>
                                            <td class="nilai-tps"><?= $v[4] ?></td>
                                            <td class="nilai-tps"><?= $v[1] ?></td>
                                            <td class="nilai-tps"><?= $v[2] ?></td>
                                            <td class="nilai-tps"><?= $v[3] ?></td>
                                            <?php endif;
                                        if ($output['filter-nilai'] !== 'TPS') :
                                            if ($output['filter'] !== 'soshum') : ?>
                                                <td class="nilai-tka saintek"><?= $v[6] ?></td>
                                                <td class="nilai-tka saintek"><?= $v[9] ?></td>
                                                <td class="nilai-tka saintek"><?= $v[7] ?></td>
                                                <td class="nilai-tka saintek"><?= $v[8] ?></td>
                                            <?php endif;
                                            if ($output['filter'] !== 'saintek') : ?>
                                                <td class="nilai-tka soshum"><?= $v[10] ?></td>
                                                <td class="nilai-tka soshum"><?= $v[13] ?></td>
                                                <td class="nilai-tka soshum"><?= $v[11] ?></td>
                                                <td class="nilai-tka soshum"><?= $v[12] ?></td>
                                        <?php endif;
                                        endif; ?>
                                    </tr>
                            <?php $no++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[name=radioTampilkan]').click(function() {
        switch ($('input[name=radioTampilkan]:checked').val()) {
            case 'all':
                $(".nilai-tps").removeClass("hide-content")
                $(".nilai-tka").removeClass("hide-content")
                switch ($('#filter').val()) {
                    case '1':
                        $(".saintek").removeClass("hide-content")
                        $(".soshum").addClass("hide-content")
                        break;
                    case '2':
                        $(".soshum").removeClass("hide-content")
                        $(".saintek").addClass("hide-content")
                        break;
                }
                break
            case 'tka':
                $(".nilai-tps").addClass("hide-content")
                $(".nilai-tka").removeClass("hide-content")
                switch ($('#filter').val()) {
                    case '1':
                        $(".saintek").removeClass("hide-content")
                        $(".soshum").addClass("hide-content")
                        break;
                    case '2':
                        $(".soshum").removeClass("hide-content")
                        $(".saintek").addClass("hide-content")
                        break;
                }
                break
            case 'tps':
                $(".nilai-tka").addClass("hide-content")
                $(".nilai-tps").removeClass("hide-content")
                break
        }
    })

    $('#filter').on('change', function(e) {
        if ($('input[name=radioTampilkan]:checked').val() != 'tps') {
            switch (this.value) {
                case '0':
                    $(".saintek").removeClass("hide-content")
                    $(".soshum").removeClass("hide-content")
                    break
                case '1':
                    $(".saintek").removeClass("hide-content")
                    $(".soshum").addClass("hide-content")
                    break
                case '2':
                    $(".soshum").removeClass("hide-content")
                    $(".saintek").addClass("hide-content")
                    break
            }
        }
    })
</script>