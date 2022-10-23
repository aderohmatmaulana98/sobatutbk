<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $message ?>
            </p>
            <p>
                <?= $this->session->flashdata('msg'); ?>
            </p>
            <div class="h3 text-biru"><?= ($this->uri->segment(3) == 'create') ? 'Tambah' : 'Update' ?> Produk</div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <?php
                    if ($this->uri->segment(3) == 'create') {
                        echo form_open('manage/product/create');
                    } else {
                        echo form_open('manage/product/update/' . $post['id']);
                    }
                    ?>
                    <div class="form-group">
                        <?= form_input($name) ?>
                    </div>
                    <div class="form-group">
                        <?= form_textarea($description) ?>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="type" id="type">
                            <option>Kategori</option>
                            <option <?= (!empty($post)) ? (($post['type'] == 1) ? 'selected' : '') : '' ?> value="1">SAINTEK</option>
                            <option <?= (!empty($post)) ? (($post['type'] == 2) ? 'selected' : '') : '' ?> value="2">SOSHUM</option>
                            <option <?= (!empty($post)) ? (($post['type'] == 3) ? 'selected' : '') : '' ?> value="3">CAMPURAN</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="status" id="status">
                            <option>Status</option>
                            <option <?= (!empty($post)) ? (($post['status'] == 1) ? 'selected' : '') : '' ?> value="1">Aktif</option>
                            <option <?= (!empty($post)) ? (($post['status'] == 0) ? 'selected' : '') : '' ?> value="0">Non-aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan produk</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <?php if ($this->uri->segment(3) == 'update') : ?>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <?= form_open('manage/product/add_ticket'); ?>
                        <div class="form-group">
                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Jumlah tiket">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="price" id="price" placeholder="Harga tiket">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" id="description" placeholder="Keterangan. Contoh: Diskon 30%">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan tiket</button>
                        <?= form_hidden('product_id', $post['id']) ?>
                        <?= form_close() ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php
    if ($this->uri->segment(3) == 'update') :
        if (!empty($product_item)) :
    ?>
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0">
                                    <tr class="border-bottom border-top border-orange" style="border-radius: 5em;">
                                        <th>Jumlah Tiket</th>
                                        <th>Harga</th>
                                        <th>Keterangan</th>
                                        <th></th>
                                    </tr>
                                    <?php foreach ($product_item as $i) : ?>
                                        <tr class="border-orange" style="border-radius: 5em;">
                                            <td><?= $i['quantity'] ?></td>
                                            <td><?= number_format($i['price'], 0, '', '.') ?></td>
                                            <td><?= $i['description'] ?></td>
                                            <td width="1">
                                                <a href="<?= base_url('manage/product/delete_product_item/' . $i['id'] . '/' . $post['id']) ?>" class="btn-hapus">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php endif;
    endif; ?>
</div>