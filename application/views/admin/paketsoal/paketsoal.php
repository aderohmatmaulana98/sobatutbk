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
                                <a href="<?= base_urL('manage/paket_soal/create') ?>" class="text-menu">
                                    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </a>
                                <span class="h5 text-biru">
                                    Paket Soal
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
    <?php
    if (!empty($item)) : ?>
        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">
                            <thead>
                                <tr class="text-biru">
                                    <th class="text-left pl-md-5">Nama Paket Soal Ujian</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th colspan="3" class="text-center pr-md-5">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($item as $i) : ?>
                                    <tr>
                                        <td class="pl-md-5">
                                            <p class="text-biru"><?= $i['name'] ?></p>
                                        </td>
                                        <td class="">
                                            <p class="text-biru"><?= $i['description'] ?></p>
                                        </td>
                                        <td>
                                            <p class="text-biru"><?= $i['created'] ?></p>
                                        </td>
                                        <td width="1">
                                            <a href="<?= site_url('manage/paket_soal/update/' . $i['id']) ?>">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pen-fill mt-2 text-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td width="1">
                                            <a href="<?= base_url('manage/paket_soal/delete/' . $i['id']) ?>" class="btn-hapus">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill mt-2 text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

</div>