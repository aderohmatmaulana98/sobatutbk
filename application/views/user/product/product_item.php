<!-- Begin Page Content -->
<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <div class="col-lg-4">
            <?= validation_errors() ?>
            <?= form_open('usr/order/' . $product['id'], 'id="form-pretest"') ?>
            <div class="card shadow">
                <div class="card-body">
                    <div class="container-fluid px-0">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="h4 text-biru mb-2 text-center"><?= $product['name'] ?></div>
                                <!-- <p>Kamu akan diarahkan ke WA CS kami untuk pemesanan.</p> -->
                                <div class="h5 text-biru mb-2">Pilih Tiket</div>
                                <div class="form-group">
                                    <select class="form-control" name="ticket" id="ticket">
                                        <?php
                                        if (!empty($product_item)) :
                                            foreach ($product_item as $i) : ?>
                                                <option value="<?= $i['id'] ?>"><?= $i['quantity'] . ' Tiket Rp. ' . number_format($i['price'], 0, '', '.') . ' ' . $i['description'] ?></option>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </div>
                                <?=form_hidden('category', $product['type'])?>
                                <button type="submit" class="btn btn-mulai-ptn btn-block mt-4" id="btn-mulai-ptn">Beli Tiket</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->