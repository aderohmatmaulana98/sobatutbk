<!-- Footer -->
<div class="container text-baloo py-5 footer">
    <div class="row">
        <div class="col-md-3">
            <ul class="disabled">
                <li class="">
                    <h4 class="text-biru">Tentang SobatUTBK</h4>
                </li>
                <li>
                    <a href="">Profil SobatUTBK</a>
                </li>
                <li>
                    <a href="">Testimoni</a>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="disabled">
                <li class="disabled">
                    <h4 class="text-biru">Produk Kami</h4>
                </li>
                <li>
                    <p>Tryout Saintek</p>
                </li>
                <li>
                    <p>Tryout Soshum</p>
                </li>
                <li>
                    <p>Tryout Campuran</p>
                </li>
                <li>
                    <p>Konsultasi</p>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="disabled">
                <li class="disabled">
                    <h4 class="text-biru">Kontak</h4>
                </li>
                <li>
                    <a href="">Profil SobatUTBK</a>
                </li>
                <li>
                    <a href="">Testimoni</a>
                </li>
            </ul>
        </div>
        <div class="col-md-3">
            <ul class="disabled">
                <li class="disabled">
                    <img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" alt="" class="img-fluid" width="60%">
                </li>
                <li>
                    <p>SobatUTBK <br>
                        Jl. Kaliurang KM 10, <br>
                        Kota Sleman, <br>
                        D.I Yogyakarta</p>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Akhir Footer -->

<!-- Menu Mobile -->
<section class="bg-orange fixed-bottom text-center menu-mobile text-baloo">
    <div class="container-fluid">
        <div class="row my-2">
            <div class="col-1"></div>
            <div class="col-2  text-center">
                <a href="<?= base_url(''); ?>">
                    <img src="<?= base_url('asset/homepage/img'); ?>/icon/home.png" class="img-fluid" alt="">
                    <div class="text">Home</div>
                </a>
            </div>
            <div class="col-2  text-center">
                <a href="<?= base_url('home/tentang'); ?>">
                    <img src="<?= base_url('asset/homepage/img'); ?>/icon/information.png" class="img-fluid" alt="">
                    <div class="text">Tentang</div>
                </a>
            </div>
            <div class="col-2  text-center">
                <a href="<?= base_url(''); ?>">
                    <img src="<?= base_url('asset/homepage/img'); ?>/icon/product.png" class="img-fluid" alt="">
                    <div class="text">Produk</div>
                </a>
            </div>
            <div class="col-2  text-center">
                <a href="<?= base_url('home/testimoni'); ?>">
                    <img src="<?= base_url('asset/homepage/img'); ?>/icon/testimoni.png" class="img-fluid" alt="">
                    <div class="text">Testimoni</div>
                </a>
            </div>
            <div class="col-2  text-center">
                <a href="<?= base_url('auth/login'); ?>">
                    <img src="<?= base_url('asset/homepage/img'); ?>/icon/user.png" class="img-fluid" alt="">
                    <div class="text">Akun</div>
                </a>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</section>
<!-- Akhir Menu Mobile -->

<!-- Whatsapp -->
<section class="whatsapp">
    <a href="https://wa.me/6282325036930">
        <img src="<?= base_url('asset/homepage/img'); ?>/icon/whatsapp.png" class="img-fluid" style="position: fixed; right: 0; bottom: 45px;">
    </a>
</section>
<!-- Akhir Whatsapp -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="<?= base_url('asset/homepage/js/index.js'); ?>"></script>

<script src="<?= base_url('asset/homepage/js/CountUp.min.js'); ?>"></script>

<script>
    const jumlahSekolah = new CountUp('jumlahSekolah', 0, 21302);
    const jumlahPeserta = new CountUp('jumlahPeserta', 0, 662404);
    const rerataTertinggi = new CountUp('rerataTertinggi', 0, 681.885, 4);
    const rerataTerendah = new CountUp('rerataTerendah', 0, 353.725, 4);
    jumlahSekolah.start();
    jumlahPeserta.start();
    rerataTertinggi.start();
    rerataTerendah.start();
</script>
</body>

</html>