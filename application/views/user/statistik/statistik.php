<!-- Begin Page Content -->
<div class="row">
    <div class="col ml-4">
        <?= form_open('usr/statistik', ['class' => 'form-inline']) ?>
        <div class="form-group mb-2 mr-2">
            <select name="tryout_group" class="form-control">
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
    <?php
    if (!empty($utbk_score)) { ?>
        <div class="col d-flex justify-content-end mr-4">

            <?= form_open('usr/statistik?action=download') ?>
            <?php
            if (!empty($tryout)) {
                foreach ($tryout as $v) {
            ?>
                    <input type="hidden" name="tryout_group" value="<?= $v['id'] ?>">
            <?php }
            }
            ?>
            <button type="submit" class="btn mb-2" style="background-color: #02055A; color: white;">Download PDF</button>
            <?= form_close() ?>

        </div>
    <?php } ?>
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

        <?php include '_activity.php'; ?>

        <?php include '_recommendation.php'; ?>

        <?php include '_history.php'; ?>

    </div>
<?php } else {
    include 'notavailable.php';
} ?>

<!-- End Page Content -->

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