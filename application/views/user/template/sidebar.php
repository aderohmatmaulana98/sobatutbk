<?php

$dashboard = "text-hitam";
$statistik = "text-hitam";
$product = "text-hitam";

if ($title == "Dashboard") :
    $dashboard = "text-orange";
endif;
if ($title == "Statistik") :
    $statistik = "text-orange";
endif;
if ($title == "Product") :
    $product = "text-orange";
endif;



?>
<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion toggled" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center text-hitam justify-content-center" href="<?= base_url('usr') ?>">
            <div class="sidebar-brand-icon">
                <img src="<?= base_url('asset/user/') ?>img/logo-2.png" class="img-fluid" width="88%">
            </div>
            <!-- <div class="sidebar-brand-text mx-3">SobatUTBK</div> -->
        </a>

        <!-- Divider -->
        <!-- <hr class="sidebar-divider bg-dark my-0"> -->

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link <?= $dashboard ?>" href="<?= base_url('usr') ?>">
                <i class="fa fa-home <?= $dashboard ?>" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link <?= $statistik ?>" href="<?= base_url('usr/statistik') ?>">
                <i class="fa fa-pie-chart <?= $statistik ?>" aria-hidden="true"></i>
                <span>Statistik</span>
            </a>
        </li>
        <!-- <li class="nav-item active">
            <a class="nav-link <?= $product ?>" href="<?= base_url('usr/product') ?>">
                <i class="fa fa-shopping-cart <?= $product ?>" aria-hidden="true"></i>
                <span>Product</span>
            </a>
        </li> -->

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0 " style="background-color: #fafafa;" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->