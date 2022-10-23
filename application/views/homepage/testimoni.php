    <!-- Video -->
    <div class="container py-5 mt-5 video">
        <div class="row">
            <div class="col-md-4">
                <img src="<?= base_url('asset/homepage/img/') . $img[7]['isi'] ?>" alt="" class="img-fluid">
            </div>
            <div class="col-md-7">
                <div class="container-testi">
                    <?= $master[36]['isi'] ?>
                </div>
                <h6 class="text-center mt-1 text-biru"><?= $master[37]['isi'] ?></h6>
            </div>
        </div>
    </div>
    <!-- Akhir Video -->

    <!-- Testimoni -->
    <div class="container text-baloo py-5">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text-orange display-4 judul-fnq"><?= $master[27]['isi'] ?></h1>
            </div>
            <div class="col-md-12 text-center">
                <div id="carouselId" class="carousel slide" style="width: 100%;" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselId" data-slide-to="1"></li>
                        <li data-target="#carouselId" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <?php $no = 1;
                        foreach ($testi as $t) : ?>
                            <div class="carousel-item <?php if ($no == 2) {
                                                            echo 'active';
                                                        } ?>">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10 py-5">
                                            <div class="kotak-kelompok bg-orange-muda text-left p-5 shadow">
                                                <div class="row">
                                                    <div class="col-md-12 text-light h3">
                                                        <?= $t['nama'] ?>
                                                    </div>
                                                    <div class="col-md-12 text-light h3">
                                                        <?= $t['instansi'] ?>
                                                    </div>
                                                    <div class="col-md-7">
                                                        <p class="text-light h4">
                                                            <?= $t['isi'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $no++;
                        endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <svg viewBox="0 0 16 16" class="bi bi-caret-left-fill prev-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3.86 8.753l5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z" />
                        </svg>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <svg viewBox="0 0 16 16" class="bi bi-caret-right-fill next-icon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.14 8.753l-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Akhir Testimoni -->