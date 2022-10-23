<div>
    <div>
        <div>


            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light border-0 topbar mb-0 static-top bg-biru">
                <div class="container">
                    <a href="<?= site_url('usr/product') ?>" class="h4 ubuntu text-light" style="text-decoration: none;">
                        <i class="fa fa-arrow-left text-orange" aria-hidden="true"></i> Produk
                    </a>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-light small">Hay,
                                    <?php if ($this->session->userdata('name')) {
                                        echo ucwords(strtolower($this->session->userdata('name')));
                                    } else {
                                        echo $this->session->userdata('username');
                                    }; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="<?= base_url('asset/user/profile/profile.svg'); ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('auth/edit_user/' . $this->session->userdata('user_id')) ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="text-center ubuntu bg-biru pb-3" style="height: 240px;">
                <div class="h2 text-light">Checkout Tryout</div>
            </div>

            <!-- Detail Pembayaran -->
            <div class="detail-pembayaran">
                <div class="container mb-5">
                    <div class="row">

                        <div class="col-lg-8 mt-4">
                            <div class="card shadow ubuntu" style="border-radius: 1em;">
                                <div class="card-body">
                                    <div class="container-fluid px-0">
                                        <div class="row">
                                            <div class="col-sm-4 mb-4">
                                                <img class="img-fluid" src="<?= base_url('asset/user/img/ilus-bayar.svg') ?>" alt="">
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="h4 text-biru"><?= ucwords($orders['product_name']) ?></div>
                                                <div class="pl-1 mb-3">
                                                    <div><i class="fa fa-check text-success" aria-hidden="true"></i> <?= $orders['quantity'] ?> x Tryout <?= product_category($orders['category']) ?>
                                                    </div>
                                                    <div><i class="fa fa-check text-success" aria-hidden="true"></i> <?= $orders['quantity'] ?> x Tryout TPS</div>
                                                    <div><i class="fa fa-check text-success" aria-hidden="true"></i> Pembahasan soal
                                                    </div>
                                                    <div><i class="fa fa-check text-success" aria-hidden="true"></i> Report Progress
                                                        full akses</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <div class="card shadow ubuntu" style="border-radius: 1em;">
                                <div class="card-body  text-biru">
                                    <?php
                                    if (!is_null($orders['payment']) && !is_null($orders['status'])) : ?>
                                        <div class="form-group">
                                            <small class="text-secondary">Metode Pembayaran</small> <?= ucwords($orders['payment']) ?>
                                        </div>
                                        <div class="form-group">
                                            <small class="text-secondary">Status</small>
                                            <?php
                                            switch($orders['status']) {
                                                case 'settlement':
                                                case 'capture':
                                                    echo 'Paid';
                                                    break;
                                                case 'deny':
                                                case 'expire':
                                                case 'cancel':
                                                    echo 'Cancel';
                                                    break;
                                                default:
                                                    echo 'Pending';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="h5">Pembayaran</div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-borderless table-hover">
                                            <tr>
                                                <td>Jumlah Tiket <?= product_category($orders['category']) ?></td>
                                                <td class="text-right text-biru"><?= $orders['quantity'] ?> <i class="fa fa-ticket" aria-hidden="true"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Jumlah Tiket TPS</td>
                                                <td class="text-right text-biru"><?= $orders['quantity'] ?> <i class="fa fa-ticket" aria-hidden="true"></i></td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td class="text-right text-biru">Rp <?= number_format($orders['price'], 0, '', '.') ?></td>
                                            </tr>
                                            <tr class="border-top">
                                                <td class="text-dark">Total Pembayaran</td>
                                                <td class="text-right text-success">Rp <?= number_format($orders['price'], 0, '', '.') ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="text-biru mb-1">Customer</div>
                                    <div class="form-group mb-0">
                                        <small class="text-secondary">Nama</small>
                                        <p><?= ucwords($orders['first_name']) ?></p>
                                    </div>
                                    <div class="form-group mb-0">
                                        <small class="text-secondary">Email</small>
                                        <p><?= ucwords($orders['email']) ?></p>
                                    </div>
                                    <div class="form-group mb-0">
                                        <small class="text-secondary">Nomor HP</small>
                                        <p><?= ucwords($orders['phone']) ?></p>
                                    </div>
                                    <div class="form-group mb-0">
                                        <small class="text-secondary">Apabila kamu memilih pembayaran Gopay, dan menutup/close tampilan barcode sebelum dilakukan pembayaran/scan barcode maka order akan di cancel. Kamu harus mengulangi order.</small>
                                    </div>
                                    <?php if (is_null($orders['status']) || $orders['status'] == 'pending') : ?>
                                        <button id="pay-button" class="btn btn-block btn-bayar mt-4">Bayar Tryout</button>
                                        <!-- <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            function product_category($category)
            {
                switch ($category) {
                    case 1:
                        return 'TKA SAINTEK';
                    case 2:
                        return 'TKA SOSHUM';
                    case 3:
                        return 'TKA Campuran';
                    case 4:
                        return 'TPS';
                    default:
                        return '';
                }
            }
            ?>