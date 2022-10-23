<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $message ?>
            </p>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <?= form_open('manage/reseller') ?>
                    <div class="h5 text-biru">Tambah User Sekolah</div>
                    <div class="form-group">
                        <?= form_input($identity) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($first_name) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($email) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($phone) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($company) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($provinsi) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($kabupaten) ?>
                    </div>
                    <div class="form-group">
                        <?= form_input($password) ?>
                    </div>
                    <div class="text-right">
                        <button type="submot" class="btn btn-primary">Simpan</button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body px-0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <span class="h4 text-biru">
                                    Reseller
                                </span>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-hover table-sm" id="data_table">
                                    <thead>
                                        <tr class="text-biru">
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No. Telp</th>
                                            <th>Sekolah</th>
                                            <th>Kabupaten</th>
                                            <th>Provinsi</th>
                                            <th>Status Akun</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (empty($resellers)) {
                                            echo '<tr><td colspan="5" class="text-center">No data <b>Belum ada data reseller.</b> </td></tr>';
                                        } else {
                                            foreach ($resellers as $i) { ?>
                                                <tr>
                                                    <td><?= $i['first_name'] ?></td>
                                                    <td><?= $i['username'] ?></td>
                                                    <td><?= $i['email'] ?></td>
                                                    <td><?= $i['phone'] ?></td>
                                                    <td><?= $i['company'] ?></td>
                                                    <td><?= $i['kabupaten'] ?></td>
                                                    <td><?= $i['provinsi'] ?></td>
                                                    <td><?= $i['active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                                                    <td>
                                                        <!-- Button trigger modal -->
                                                        <a class="badge badge-success" data-toggle="modal" data-target="#exampleModal<?= $i['id'] ?>" href="#">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </a>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="exampleModal<?= $i['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data Sekolah</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <?= form_open('manage/reseller/edit_school_aksi/') ?>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">Username</label>
                                                                            </div>
                                                                            <input type="hidden" id="id" name="id" value="<?= $i['id'] ?>">
                                                                            <input class="form-control" type="text" name="username" value="<?= $i['username']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">Nama</label>
                                                                            </div>
                                                                            <input class="form-control" name="nama" value="<?= $i['first_name']; ?>" type="text">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">Email</label>
                                                                            </div>
                                                                            <input class="form-control" type="email" name="email" value="<?= $i['email']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">No Telepon</label>
                                                                            </div>
                                                                            <input class="form-control" type="text" name="phone" value="<?= $i['phone']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">Sekolah</label>
                                                                            </div>
                                                                            <input class="form-control" type="text" name="company" value="<?= $i['company']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">Provinsi</label>
                                                                            </div>
                                                                            <input class="form-control" type="text" name="provinsi" value="<?= $i['provinsi']; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div>
                                                                                <label for="">Kabupaten</label>
                                                                            </div>
                                                                            <input class="form-control" type="text" name="kabupaten" value="<?= $i['kabupaten']; ?>">
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                    <?= form_close() ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <a class=" badge badge-danger mr-1" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')" data-toggle="tooltip" data-placement="top" title="Hapus" href="<?= base_url('manage/reseller/delete_school/' . $i['id']) ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>