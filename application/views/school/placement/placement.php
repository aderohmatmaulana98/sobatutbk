<div class="container-fluid mb-4">
    <div class="row menu-placement">
        <div class="col-12 mb-4">
            <div class="h3 text-biru ml-2"><strong>Placement</strong></div>
            <br>
            <?= form_open('manage_school/placement', ['class' => 'form-inline']) ?>
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
            <button id="activity" class="text-hitam mr-3 btn <?= null === $output['filter'] && null === $output['filter-nilai'] ? 'menu-placement-active' : '' ?>">Activity Progress</button>
            <button id="recap" class="text-hitam btn <?= null === $output['filter'] && null === $output['filter-nilai'] ? '' : 'menu-placement-active' ?>">Rekapitulasi Hasil Siswa</button>
        </div>
    </div>

    <?php include '_activity.php'; ?>

    <?php include '_recap.php'; ?>

</div>