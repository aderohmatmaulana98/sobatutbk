<div>
    <div>
        <div>


            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light border-0 topbar mb-0 static-top bg-biru">
                <div class="container">
                    <a href="<?= site_url('usr/statistik') ?>" class="h4 ubuntu text-light" style="text-decoration: none;">
                        <i class="fa fa-arrow-left text-orange" aria-hidden="true"></i> Statistik
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
                <div class="h2 text-light">Pembahasan Tryout</div>
            </div>

            <!-- Detail Pembayaran -->
            <div class="detail-pembayaran">
                <div class="container mb-5">
                    <div class="row">

                        <div class="col-lg-12 mt-4">
                            <div class="card shadow ubuntu" style="border-radius: 1em;">
                                <div class="card-body">
                                    <div class="container-fluid px-0">
                                        <div class="row">
                                            <div class="col-sm-12">

                                                <?php if (!empty($item)) :
                                                    $no_soal = 1;
                                                    foreach ($item as $key => $v) :
                                                        $no = 1;
                                                ?>
                                                        <div id="accordion">
                                                            <div class="card">
                                                                <div class="card-header" id="headingOne">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?= $key ?>" aria-expanded="false" aria-controls="collapseOne">
                                                                            <?= strtoupper($v['category']) . ' - ' . ucwords($v['subject']) ?>
                                                                        </button>
                                                                    </h5>
                                                                </div>

                                                                <div id="collapse<?= $key ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                                    <div class="card-body">
                                                                        <?php if (!empty($v['soal'])) :
                                                                            $no = 1;
                                                                        ?>
                                                                            <div class="card mt-3">
                                                                                <div class="table-responsive">
                                                                                    <table class="table mb-0">
                                                                                        <?php foreach ($v['soal'] as $i) : ?>
                                                                                            <tr>
                                                                                                <td class="pl-md-4 py-5">
                                                                                                    <div class="h5 text-biru">Pertanyaan <?= $no ?></div>
                                                                                                    <table class="table my-2 border" width="100%">
                                                                                                        <tr>
                                                                                                            <td class="p-1 text-hitam" width="30%">Materi</td>
                                                                                                            <td class="p-1"><?= $i['materi'] ?></td>
                                                                                                        </tr>
                                                                                                        <tr>
                                                                                                            <td class="p-1 text-hitam" width="30%">Indikator</td>
                                                                                                            <td class="p-1"><?= $i['indikator'] ?></td>
                                                                                                        </tr>
                                                                                                    </table>
                                                                                                    <?= $i['soal'] ?>
                                                                                                    <div class="text-biru">
                                                                                                        <ol type="A">
                                                                                                            <li <?= ($i['answer'] == 1) ? 'class="text-success"' : '' ?>><?= $i['opt1'] ?></li>
                                                                                                            <li <?= ($i['answer'] == 2) ? 'class="text-success"' : '' ?>><?= $i['opt2'] ?></li>
                                                                                                            <li <?= ($i['answer'] == 3) ? 'class="text-success"' : '' ?>><?= $i['opt3'] ?></li>
                                                                                                            <li <?= ($i['answer'] == 4) ? 'class="text-success"' : '' ?>><?= $i['opt4'] ?></li>
                                                                                                            <li <?= ($i['answer'] == 5) ? 'class="text-success"' : '' ?>><?= $i['opt5'] ?></li>
                                                                                                        </ol>
                                                                                                    </div>
                                                                                                    <strong>Jawabanmu :
                                                                                                        <?php
                                                                                                        switch ($i['user_answer']) {
                                                                                                            case 1:
                                                                                                                echo 'A';
                                                                                                                break;
                                                                                                            case 2:
                                                                                                                echo 'B';
                                                                                                                break;
                                                                                                            case 3:
                                                                                                                echo 'C';
                                                                                                                break;
                                                                                                            case 4:
                                                                                                                echo 'D';
                                                                                                                break;
                                                                                                            case 5:
                                                                                                                echo 'E';
                                                                                                                break;
                                                                                                        }
                                                                                                        ?></strong>
                                                                                                    <br>
                                                                                                    <strong>Jawaban yang benar :
                                                                                                        <?php
                                                                                                        switch ($i['answer']) {
                                                                                                            case 1:
                                                                                                                echo 'A';
                                                                                                                break;
                                                                                                            case 2:
                                                                                                                echo 'B';
                                                                                                                break;
                                                                                                            case 3:
                                                                                                                echo 'C';
                                                                                                                break;
                                                                                                            case 4:
                                                                                                                echo 'D';
                                                                                                                break;
                                                                                                            case 5:
                                                                                                                echo 'E';
                                                                                                                break;
                                                                                                        }
                                                                                                        ?></strong>
                                                                                                    <div class="card" style="background-color: bisque;">
                                                                                                        <div class="card-body">
                                                                                                            <div class="text-biru">Pembahasan <i id="pembahasan<?= $no_soal ?>" class="fa fa-eye text-primary" aria-hidden="true" style="cursor: pointer;"></i> </div>
                                                                                                            <span id="content-pembahasan<?= $no_soal ?>">
                                                                                                                <?= $i['explanation'] ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <script>
                                                                                                $("#content-pembahasan<?= $no_soal ?>").hide();
                                                                                                $("#pembahasan<?= $no_soal ?>").click(function() {
                                                                                                    $("#content-pembahasan<?= $no_soal ?>").toggle("slow");
                                                                                                });
                                                                                            </script>
                                                                                        <?php $no++;
                                                                                            $no_soal++;
                                                                                        endforeach; ?>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php endforeach;
                                                endif; ?>
                                                        </div>
                                            </div>
                                        </div>
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