<!-- Begin: HISTORY -->
<div class="row mb-5 history hide-content">
    <div class="col-lg-8">
        <div class="card shadow welcome border-0 mb-4" style="border-radius: 1em;">
            <div class="card-body">
                <div class="h5 text-hitam mb-4">History Tryout</div>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr class="text-hitam">
                                <th>Sesi</th>
                                <th>Nama Tryout</th>
                                <th>Tanggal Sesi</th>
                                <th>Jam Sesi</th>
                                <th>Mengikuti Tryout Pada</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($exam_history)) :
                                $no = 0;
                                foreach ($exam_history as $i) :
                            ?>
                                    <tr>
                                        <td><?= $i['tryout_group_name'] ?></td>
                                        <td><?= $i['name'] ?></td>
                                        <td><?= date('d', strtotime($i['start_date'])) . ' - ' . date('d', strtotime($i['end_date'])) . ' ' . get_month(date('n', strtotime($i['end_date']))) . ' ' . date('Y', strtotime($i['end_date'])) ?></td>
                                        <td><?= date('H:i', strtotime($i['start_time'])) . ' - ' . date('H:i', strtotime($i['end_time'])) ?></td>
                                        <td><?= date('d', strtotime($i['date'])) . ' ' . get_month(date('n', strtotime($i['date']))) . ' ' . date('Y', strtotime($i['date'])) . ' - ' . date('H:i', strtotime($i['date'])) ?></td>
                                        <td><a href="<?= site_url('usr/pembahasan/' . $i['exam_id'] . '/' . $i['category']) ?>">Pembahasan</a></td>
                                    </tr>
                            <?php $no++;
                                endforeach;
                            endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="card shadow welcome border-0" style="border-radius: 1em;">
                    <div class="card-body">
                        <div class="h5 text-hitam">Orders</div>
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr class="text-hitam">
                                        <th>ID Order</th>
                                        <th>Nama Produk</th>
                                        <th>Tanggal</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($orders)) :
                                        foreach ($orders as $i) :
                                    ?>
                                            <tr>
                                                <td><?= $i['id'] ?></td>
                                                <td><?= $i['quantity'] . ' Tiket ' . $i['product_name'] ?></td>
                                                <td><?= date('d', strtotime($i['created'])) . ' ' . get_month(date('n', strtotime($i['created']))) . ' ' . date('Y', strtotime($i['created'])) ?></td>
                                                <td><?= number_format($i['price'], 0, '', '.') ?></td>
                                                <td><?= $i['status'] == 0 ? 'Diproses' : 'Complete' ?></td>
                                                <td><a href="<?= site_url('usr/transaction/' . $i['id']) ?>">Detail</a></td>
                                            </tr>
                                    <?php endforeach;
                                    endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
    </div>
    <div class="col-lg-1"></div>
    <div class="col-lg-2 col-xl-3 d-none">
        <div class="card shadow" style="background-color: #2D62ED; border-radius: 2em;">
            <div class="card-body text-light border-0">
                <img src="<?= base_url('asset/user/') ?>img/file.png" alt="">
                <div class="h1 mb-0">Disc 15%</div>
                <div class="mb-4">6x tryout</div>
                <div class="text-right">
                    <a href="#" class="text-light">
                        <b>Beli sekarang</b>
                        <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-arrow-up-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="background-color: rgba(216, 216, 216, 0.514); padding: 10px; border-radius: 50%">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End: HISTORY -->