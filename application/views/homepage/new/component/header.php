<?php

$default = "block lg:inline-block text-center my-2 py-2 px-4 font-bold no-underline text-gray-700 hover:text-gray-900 transition duration-500 ease-in-out hover:rounded hover:bg-gray-200 rounded";
$active = "block lg:inline-block text-center my-2 py-2 px-4 font-bold no-underline text-green-theme2";

?>

<!doctype html>
<html lang="en">

<head>
    <title><?= $title ?> | Sobat UTBK</title>

    <link rel="icon" href="<?= base_url('asset/user/') ?>img/logo.png" type="image/gif">

    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?= base_url('asset/homepage/css/app.css') ?>?version=<?php echo filemtime('./asset/homepage/css/app.css'); ?>">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <style>
        #welcome {
            background: transparent url("<?= base_url('asset/homepage/img'); ?>/homepage-bg-atas.png") no-repeat center bottom;
            background-size: cover;
            min-height: 1280px;
        }

        #solusi {
            background: #265D92 url("<?= base_url('asset/homepage/img'); ?>/homepage-bg-bottom.png") no-repeat center top;
            background-size: 100%;
        }

        #alasan {
            background-color: #265D92;
        }

        #penawaran {
            background: #265D92 url("<?= base_url('asset/homepage/img'); ?>/homepage-bg-bottom2.png") no-repeat center top;
            background-size: cover;
            min-height: 512px;
        }
    </style>
</head>

<body>

<header>
    <nav id="header" class="fixed w-full z-30 top-0 text-black bg-white filter drop-shadow-lg">
        <div class="w-full px-4 md:px-12 lg:px-24 container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <!-- Logo -->
            <div class="pl-4 flex items-center">
                <a href="<?= base_url(''); ?>" class="no-underline hover:no-underline">
                    <img src="<?= base_url('asset/homepage/img'); ?>/logo-2.png" alt="" class="w-32">
                </a>
            </div>

            <!-- Menu Toggle -->
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center p-1 text-blue-theme1 hover:text-gray-900 focus:outline-none focus:shadow-sm transform transition hover:scale-105 duration-300 ease-in-out">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </button>
            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden mt-2 lg:mt-0 lg:bg-transparent text-black p-4 lg:p-0 z-20" id="nav-content">
                <ul class="list-reset lg:flex justify-center flex-1 items-center">
                    <li class="mr-3">
                        <a href="<?= base_url('home/tentang'); ?>" class="<?php if($title == "Tentang") echo $active; else echo $default; ?>">Tentang</a>
                    </li>
                    <li class="mr-3">
                        <a href="<?= base_url('home/testimoni'); ?>" class="<?php if($title == "Testimoni") echo $active; else echo $default; ?>">Testimoni</a>
                    </li>
                    <li class="mr-3">
                        <a href="<?= base_url('home/galeri'); ?>" class="<?php if($title == "Galeri") echo $active; else echo $default; ?>">Galeri</a>
                    </li>
                </ul>
                <button class="block w-full lg:w-auto mx-auto lg:mx-0 hover:underline font-bold rounded-full mt-4 lg:mt-0 py-2 px-4 shadow opacity-75 focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out text-white bg-gradient-to-r from-blue-theme1 to-green-theme1 cursor-pointer"><a href="<?= base_url('auth/login'); ?>">Login</a></button>
            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0">
    </nav>
</header>