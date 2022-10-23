<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
        </div>

        <div class="col-12 mb-3">
            <div class="h3 text-biru">Waktu Ujian</div>
        </div>

        <div class="col-lg-12 mb-2">
            <div class="card shadow">
                <div class="card-body">
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="<?= base_url('manage_school/examtime/create')  ?>" class="text-menu">
                                    <svg width="3em" height="3em" viewBox="0 0 16 16" class="bi bi-plus-circle-fill " fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                                    </svg>
                                </a>
                                <span class="h5 text-biru">
                                    Waktu ujian
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

        <div class="col-lg-12">
            <div class="card shadow">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover">
                        <tbody>
                            <?php if (!empty($item)) {
                                foreach ($item as $i) {
                            ?>
                                    <tr>
                                        <td class="pl-md-5">
                                            <small>Paket Ujian</small>
                                            <p class="text-biru"><?= $i['tryout_group_name'] ?></p>
                                        </td>
                                        <td class="pl-md-5">
                                            <small>Nama Sesi</small>
                                            <p class="text-biru"><?= $i['name'] ?></p>
                                        </td>
                                        <td class="pl-md-5">
                                            <small>Kategori</small>
                                            <p class="text-biru">
                                                <?php
                                                switch ($i['type']) {
                                                    case 1:
                                                        echo 'TKA - SAINTEK';
                                                        break;
                                                    case 2:
                                                        echo 'TKA - SOSHUM';
                                                        break;
                                                    case 3:
                                                        echo 'TKA - CAMPURAN';
                                                        break;
                                                    case 4:
                                                        echo 'TPS';
                                                        break;
                                                    default:
                                                        echo '';
                                                } ?>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="d-inline-block">
                                                <small>Tanggal</small>
                                                <p class="text-biru"><?= date('d-m-Y', strtotime($i['start_date'])) . ' - ' . date('d-m-Y', strtotime($i['end_date'])) ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-block">
                                                <small>Sesi</small>
                                                <p class="text-biru"><?= date('H:i', strtotime($i['start_time'])) . ' - ' . date('H:i', strtotime($i['end_time'])) ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-inline-block">
                                                <small>Status</small>
                                                <p class="text-biru"><?= ($i['status'] == 0) ? 'Non Aktif' : 'Aktif' ?></p>
                                            </div>
                                        </td>
                                        <td width="1">
                                            <a href="<?= site_url('manage_school/examtime/update/' . $i['id']) ?>">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pen-fill mt-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <!-- <td width="1" class="pr-md-5">
                                            <a href="<?= base_url('manage_school/examtime/delete/' . $i['id']) ?>" class="btn-hapus">
                                                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill mt-3 text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                </svg>
                                            </a>
                                        </td> -->
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>