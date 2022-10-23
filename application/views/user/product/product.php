<!-- Begin Page Content -->
<?php if ($this->ion_auth->is_admin()) { ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message_sa'); ?>"></div>
    <div class="container-fluid mb-5 pb-5">
        <div class="row">
            <?php if (!empty($product)) :
                foreach ($product as $i) : ?>
                    <div class="col-lg-3 col-sm-6">
                        <div class="card-promo shadow">
                            <div class="head text-center bg-biru">
                                <h1 class="mb-0 pt-4 pb-3 text-light"><?= $i['name'] ?></h1>
                            </div>
                            <div class="body pt-4 pb-4 px-4">
                                <div class="row">
                                    <div class="col-12 text-biru text-justify">
                                        <?= $i['description'] ?>
                                    </div>
                                    <div class="col-12 text-center py-3">
                                        <a href="<?= site_url('usr/order/' . $i['id']) ?>" class="btn-promo px-5" data-productid="<?= $i['id'] ?>">Beli</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            endif; ?>
        </div>
    </div>

    <!-- MODAL BELI -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
        MODAL
    </button>

    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="h3 text-biru mb-2 text-center">SOSHUM</div>
                    <div class="h5 text-biru mb-2">Pilih Tiket</div>
                    <div class="form-group">
                        <select class="form-control" name="ticket" id="ticket">
                            <option value="1">Tiket 1</option>
                            <option value="2">Tiket 2</option>
                            <option value="3">Tiket 3</option>
                            <option value="4">Tiket 4</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-mulai-ptn btn-block mt-4" id="btn-mulai-ptn">Beli Tiket</button>
                </div>
            </div>
        </div>
    </div>
    <!-- AKHIR MODAL BELI -->
    <!-- /.container-fluid -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const flashdata = $('.flash-data').data('flashdata');
        if (flashdata) {
            Swal.fire({
                title: 'Informasi',
                html: flashdata,
                icon: 'info',
                showConfirmButton: false,
                timer: 3000
            }).then((result) => {
                window.location.href = 'https://wa.me/6282325036930/?text=<?= $this->session->flashdata('message_wa'); ?>';
            });
        }
    </script>
<?php } ?>