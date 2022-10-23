<div>
    <div>
        <div>


            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light border-0 topbar mb-0 static-top bg-biru">
                <div class="container">

                </div>
            </nav>

            <div class="text-center ubuntu bg-biru pb-3" style="height: 240px;">
                <div class="h2 text-light text-center"><?= $title ?></div>
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
                                                                <div <?= $key ?> aria-labelledby="headingOne" data-parent="#accordion">
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
                                                                                                    <strong><?= strtoupper($v['category']) . ' - ' . ucwords($v['subject']) ?></strong>
                                                                                                    <div class="h5 text-biru">Pertanyaan <?= $no ?></div>
                                                                                                    <?= $i['soal'] ?>
                                                                                                    <?= $i['opt1'] ?>
                                                                                                    <?= $i['opt2'] ?>
                                                                                                    <?= $i['opt3'] ?>
                                                                                                    <?= $i['opt4'] ?>
                                                                                                    <?= $i['opt5'] ?>
                                                                                                    <strong>Jawaban:
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
                                                                                                            <div class="text-biru">Pembahasan</div>
                                                                                                            <span id="content-pembahasan<?= $no_soal ?>">
                                                                                                                <?= $i['explanation'] ?>
                                                                                                            </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
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