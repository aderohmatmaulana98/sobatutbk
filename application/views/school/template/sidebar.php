<?php

$dashboard = "text-orange-tua";
$banksoal = "text-orange-tua";
$paketsoal = "text-orange-tua";
$paketujian = "text-orange-tua";
$product = "text-orange-tua";
$laporan = "text-orange-tua";
$homepage = "text-orange-tua";
$userdata = "text-orange-tua";
$reseller = "text-orange-tua";
$examtime = "text-orange-tua";
$placement = "text-orange-tua";
$tracking = "text-orange-tua";

$dashboard_1 = "text-orange-tua";
$banksoal_1 = "text-orange-tua";
$paketsoal_1 = "text-orange-tua";
$paketujian_1 = "text-orange-tua";
$product_1 = "text-orange-tua";
$laporan_1 = "text-orange-tua";
$homepage_1 = "text-orange-tua";
$userdata_1 = "text-orange-tua";
$reseller_1 = "text-orange-tua";
$examtime_1 = "text-orange-tua";
$placement_1 = "text-orange-tua";
$tracking_1 = "text-orange-tua";


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
if ($title == "Reseller") :
    $reseller = "text-putih";
    $reseller_1 = "text-putih border-kiri";
endif;
if ($title == "Waktu Ujian") :
    $examtime = "text-putih";
    $examtime_1 = "text-putih border-kiri";
endif;
if ($title == "Placement") :
    $placement = "text-putih";
    $placement_1 = "text-putih border-kiri";
endif;
if ($title == "Tracking Pengerjaan") :
    $tracking = "text-putih";
    $tracking_1 = "text-putih border-kiri";
endif;



?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-orange sidebar sidebar-dark accordion toggled fixed-top" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <div class="sidebar-brand d-flex align-items-center text-hitam justify-content-center">
            <a class="sidebar-brand-icon d-md-block d-none" href="#">
                <img src="<?= base_url('asset/admin/') ?>img/logo-admin.png" class="img-fluid" width="88%">
            </a>
            <!-- <div class="sidebar-brand-text mx-3 text-light">SobatUTBK</div> -->
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn text-putih d-md-none rounded-circle">
                <i class="fa fa-chevron-left"></i>
            </button>
        </div>


        <!-- Divider -->
        <hr class="sidebar-divider bg-putih my-0">

        <!-- Nav Item - Dashboard -->
        <?php
        if (empty($user_reseller)) :
        ?>
            <!-- <li class="nav-item active">
                <a class="nav-link <?= $dashboard_1 ?>" href="<?= base_url('school') ?>">
                    <i class="fa fa-home <?= $dashboard ?>" aria-hidden="true"></i>
                    <span>Dashboard</span>
                </a>
            </li> -->
            <!-- <li class="nav-item active">
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
            </li> -->
            <!-- <li class="nav-item active">
                <a class="nav-link <?= $reseller_1 ?>" href="<?= base_url('manage/reseller') ?>">
                    <i class="fa fa-users <?= $reseller ?>" aria-hidden="true"></i>
                    <span>Reseller</span>
                </a>
            </li> -->


        <?php endif; ?>
        <li class="nav-item active">
            <a class="nav-link <?= $dashboard_1 ?>" href="<?= base_url('manage_school/homepage') ?>">
                <i class="fa fa-home <?= $dashboard ?>" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link <?= $tracking_1 ?>" href="<?= base_url('manage_school/tracking') ?>">
                <i class="fa fa-clipboard-list <?= $tracking ?>" aria-hidden="true"></i>
                <span>Tracking</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link <?= $placement_1 ?>" href="<?= base_url('manage_school/placement') ?>">
                <i class="fa fa-chart-pie <?= $placement ?>" aria-hidden="true"></i>
                <span>Placement</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link <?= $userdata_1 ?>" href="<?= base_url('manage_school/userdata') ?>">
                <i class="fa fa-user <?= $userdata ?>" aria-hidden="true"></i>
                <span>User data</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link <?= $examtime_1 ?>" href="<?= base_url('manage_school/examtime') ?>">
                <i class="fa fa-clock <?= $examtime ?>" aria-hidden="true"></i>
                <span>Waktu Ujian</span>
            </a>
        </li>

        <!-- <?php
                if (empty($user_reseller)) :
                ?>
            <li class="nav-item">
                <a class="nav-link <?= $homepage_1 ?>" href="<?= base_url('admin/homepage') ?>">
                    <i class="fa fa-desktop <?= $homepage ?>" aria-hidden="true"></i>
                    <span>Interface</span>
                </a>
            </li>
        <?php endif; ?> -->



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