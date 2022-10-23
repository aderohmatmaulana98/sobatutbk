<?php

$dashboard = "text-putih-dark";
$banksoal = "text-putih-dark";
$paketsoal = "text-putih-dark";
$paketujian = "text-putih-dark";
$product = "text-putih-dark";
$laporan = "text-putih-dark";
$homepage = "text-putih-dark";
$userdata = "text-putih-dark";
$reseller = "text-putih-dark";

$dashboard_1 = "text-putih-dark";
$banksoal_1 = "text-putih-dark";
$paketsoal_1 = "text-putih-dark";
$paketujian_1 = "text-putih-dark";
$product_1 = "text-putih-dark";
$laporan_1 = "text-putih-dark";
$homepage_1 = "text-putih-dark";
$userdata_1 = "text-putih-dark";
$reseller_1 = "text-putih-dark";


if ($title == "Dashboard") :
    $dashboard = "text-putih";
    $dashboard_1 = "text-putih border-kiri";
endif;
if ($title == "Bank soal") :
    $banksoal = "text-putih";
    $banksoal_1 = "text-putih border-kiri";
endif;
if ($title == "Paket soal") :
    $paketsoal = "text-putih";
    $paketsoal_1 = "text-putih border-kiri";
endif;
if ($title == "Paket ujian") :
    $paketujian = "text-putih";
    $paketujian_1 = "text-putih border-kiri";
endif;
if ($title == "Product") :
    $product = "text-putih";
    $product_1 = "text-putih border-kiri";
endif;
if ($title == "Laporan") :
    $laporan = "text-putih";
    $laporan_1 = "text-putih border-kiri";
endif;
if ($title == "Interface") :
    $homepage = "text-putih";
    $homepage_1 = "text-putih border-kiri";
endif;
if ($title == "User data") :
    $userdata = "text-putih";
    $userdata_1 = "text-putih border-kiri";
endif;
if ($title == "User Sekolah") :
    $reseller = "text-putih";
    $reseller_1 = "text-putih border-kiri";
endif;



?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-menu sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center text-hitam justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('asset/admin/') ?>img/logo-admin.png" class="img-fluid" width="88%">
            </div>
            <!-- <div class="sidebar-brand-text mx-3 text-light">SobatUTBK</div> -->
        </a>


        <!-- Divider -->
        <!-- <hr class="sidebar-divider bg-dark my-0"> -->

        <!-- Nav Item - Dashboard -->
        <?php
        if (empty($user_reseller)) :
        ?>
            <li class="nav-item active">
                <a class="nav-link <?= $dashboard_1 ?>" href="<?= base_url('admin') ?>">
                    <i class="fa fa-home <?= $dashboard ?>" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link <?= $banksoal_1 ?>" href="<?= base_url('manage/bank_soal') ?>">
                    <i class="fa fa-pencil <?= $banksoal ?>" aria-hidden="true"></i>
                    <span>Bank soal</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link <?= $paketsoal_1 ?>" href="<?= base_url('manage/paket_soal') ?>">
                    <i class="fa fa-files-o <?= $paketsoal ?>" aria-hidden="true"></i>
                    <span>Paket soal</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link <?= $paketujian_1 ?>" href="<?= base_url('manage/paket_ujian') ?>">
                    <i class="fa fa-folder-o <?= $paketujian ?>" aria-hidden="true"></i>
                    <span>Paket ujian</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link <?= $product_1 ?>" href="<?= base_url('manage/product') ?>">
                    <i class="fa fa-shopping-cart <?= $product ?>" aria-hidden="true"></i>
                    <span>Product</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link <?= $laporan_1 ?>" href="<?= base_url('manage/laporan') ?>">
                    <i class="fa fa-pie-chart <?= $laporan ?>" aria-hidden="true"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <li class="nav-item active">
                <a class="nav-link <?= $reseller_1 ?>" href="<?= base_url('manage/reseller') ?>">
                    <i class="fa fa-users <?= $reseller ?>" aria-hidden="true"></i>
                    <span>User Sekolah</span>
                </a>
            </li>


        <?php endif; ?>
        <li class="nav-item active">
            <a class="nav-link <?= $userdata_1 ?>" href="<?= base_url('manage/userdata') ?>">
                <i class="fa fa-user <?= $userdata ?>" aria-hidden="true"></i>
                <span>User data</span>
            </a>
        </li>

        <?php
        if (empty($user_reseller)) :
        ?>
            <li class="nav-item">
                <a class="nav-link <?= $homepage_1 ?>" href="<?= base_url('admin/homepage') ?>">
                    <i class="fa fa-desktop <?= $homepage ?>" aria-hidden="true"></i>
                    <span>Interface</span>
                </a>
            </li>
        <?php endif; ?>



        <!-- Divider -->
        <!-- <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0 " style="background-color: #64646446;" id="sidebarToggle"></button>
        </div> -->

    </ul>
    <!-- End of Sidebar -->


    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content bg-biru">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="h1 text-center text-light">
                            COMING SOON
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#exampleModal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var modal = $(this);
            // Use above variables to manipulate the DOM

        });
    </script>