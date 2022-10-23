<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?> Sobat UTBK</title>
    <link rel="icon" href="<?= base_url('asset/homepage/img'); ?>/logo.png" type="image/gif">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- font google -->
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('asset/homepage/css'); ?>/style.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <script>
        // len_fag = $('#jml-fag').attr('name');
        // console.log(len_fag);

        function toggleFAG(i) {
            $("#answer" + i).toggle(600, "swing");
        }
    </script>

</head>

<body>
    <?php if ($title == "Tentang -") : ?>
        <div class="head-tentang">
        <?php endif; ?>
        <!-- Notif -->
        <div class="notif bg-biru text-center text-baloo text-light py-2">
            <span class="mr-3"> <?= $master[0]['isi'] ?> </span>
            <a href="<?= base_url('auth/login'); ?>" class="btn-notif px-3">
                <b><?= $master[1]['isi'] ?></b>
            </a>
        </div>
        <!-- Akhir Notif -->

        <!-- Menu -->
        <nav class="navbar navbar-expand-sm navbar-light bg-light text-baloo" id="navbar_top">
            <div class="container">
                <a class="navbar-brand logo" href="<?= base_url(''); ?>"><img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" alt="" class="img-fluid text-primary logo-cover"></a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 text-biru">
                        <li class="nav-item">
                            <a class="item-menu px-4 mx-2" href="<?= base_url('home/'); ?>tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="item-menu px-4 mx-2" href="<?= base_url(''); ?>">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="item-menu px-4 mx-2" href="<?= base_url('home/'); ?>testimoni">Testimoni</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="menu-login" href="<?= base_url('auth/login'); ?>">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Akhir Menu -->

        <!-- Menu mobile atas -->
        <div class="fixed-top py-1 menu-mobile-atas" style="background-color: white;">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <a href="index.html">
                            <img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" class="img-fluid" alt="" width="20%">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Menu mobile atas -->