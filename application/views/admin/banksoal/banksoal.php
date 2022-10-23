<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
            <div class="card shadow">
                <div class="card-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?= site_url('manage/bank_soal/create') ?>" class="text-menu">
                                    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill text-menu" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </a>
                                <span class="h5 text-biru">
                                    Soal
                                </span>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <form>
                                    <input class="form-control" type="search" placeholder="Cari" aria-label="Search">
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover">
                        <?php if (!empty($item)) :
                            foreach ($item as $i) : ?>
                                <tr>
                                    <td width="300" class="pl-md-5">
                                        <small>Nama Paket Soal</small>
                                        <p class="text-biru"><?= $i['name'] ?></p>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-block">
                                            <small>Kategori</small>
                                            <p class="text-biru"><?= $i['category'] . " - " . $i['subject'] ?></p>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-inline-block">
                                            <small>Jumlah Soal</small>
                                            <p class="text-biru"><?= $i['count'] ?></p>
                                        </div>
                                    </td>
                                    <td width="1">
                                        <a href="<?= base_url('manage/bank_soal/update/' . $i['id']) ?>">
                                            <svg width="2.5em" height="2.5em" viewBox="0 0 16 16" class="bi bi-plus mt-2 text-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td width="1" class="pr-md-5">
                                        <a href="<?= base_url('manage/bank_soal/delete/'. $i['id']) ?>" class="btn-hapus">
                                            <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill mt-3 text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>