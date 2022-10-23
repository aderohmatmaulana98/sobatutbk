<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-body p-1">
                    <div class="table-responsive">
                        <table class="table mb-0 table-hover">
                            <tr class="rounded border" style="background-color: #253468;">
                                <td colspan="2" class="text-light text-center">DATA USER</td>
                            </tr>
                            <tr>
                                <td class="text-biru">Name</td>
                                <td><?= empty($user) ? '-' : $user['first_name'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-biru">Email</td>
                                <td><?= empty($user) ? '-' : $user['email'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-biru">Phone</td>
                                <td><?= empty($user) ? '-' : $user['phone'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-biru">Asal Sekolah</td>
                                <td><?= empty($user) ? '-' : $user['company'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-biru">UserName</td>
                                <td><?= empty($user) ? '-' : $user['username'] ?></td>
                            </tr>
                            <tr>
                                <td class="text-biru">Tiket</td>
                                <td>
                                    <?php if (empty($ticket)) {
                                        echo '-';
                                    } else {
                                        echo $ticket['tka_saintek'] . ' TKA Saintek<br>' . $ticket['tka_soshum'] . ' TKA Soshum<br>' . $ticket['tka_campuran'] . ' TKA Campuran<br>' . $ticket['tps'] . ' TPS';
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-body px-0">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-6 text-center text-md-right">
                                <button type="button" class="btn border tambah-produk-manual">Tambah Tiket</button>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <?= form_open('manage/userdata/add_ticket') ?>
                                        <div class="form-group">
                                            <select class="form-control" name="type" id="type">
                                                <option selected>Nama Produk</option>
                                                <option value="tka_saintek">SAINTEK</option>
                                                <option value="tka_soshum">SOSHUM</option>
                                                <option value="tka_campuran">CAMPURAN</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="quantity" id="quantity">
                                                <option selected>Jumlah tiket</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                            </select>
                                        </div>
                                        <?= form_hidden('user_id', $user['id']) ?>
                                        <button type="submit" class="btn btn-primary">Tambah Tiket</button>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <div class="h3 text-biru">Aktivasi Users</div>
        </div>
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body px-0">
                    <div class="container-fluid">
                        <div class="row mt-3">

                            <div class="col-12">
                                <div class="table-responsive mt-3">
                                    <table class="table" id="data_table">
                                        <thead>
                                            <tr class="text-dark">
                                                <th>Nama Sekolah</th>
                                                <th>Jumlah Siswa</th>
                                                <th>Detail</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (empty($school)) {
                                                echo '<tr><td colspan="5" class="text-center">No data <b>Belum ada data user.</b> </td></tr>';
                                            } else {
                                                foreach ($school as $i) { ?>
                                                    <tr>
                                                        <td><?= $i['company'] ?></td>
                                                        <?php $company = $i['reseller_id'] ?>
                                                        <?php $sekolah = $this->db->query("SELECT COUNT(users_resellers.`user_id`) as jumlah
                                                        FROM users, users_groups, groups, users_resellers
                                                        WHERE `users`.`id` = users_groups.`user_id`
                                                        AND groups.`id` = users_groups.`group_id`
                                                        AND users.`id` = `users_resellers`.`user_id`
                                                        AND users_resellers.`reseller_id` = $company
                                                        AND users.`active` = 0
                                                        AND groups.`id`= 2")->row(); ?>
                                                        <td><?= ($sekolah->jumlah) ?></td>
                                                        <td>
                                                            <a href="<?= site_url('manage/userdata/detail_school/' . $i['id']) ?>" class="btn btn-success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                </svg>
                                                            </a>
                                                        </td>
                                                        <td width="1">
                                                            <a class="badge bg-primary text-white" href="<?= site_url('manage/userdata/activation/' . $i['reseller_id']) ?>">
                                                                Accept All
                                                            </a>
                                                            <a class="badge bg-danger text-white" href="<?= site_url('manage/userdata/delete_all/' . $i['reseller_id']) ?>">
                                                                Delete All
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

    <div class="row mt-5">
        <div class="col-12">
            <div class="h3 text-biru">Data Users</div>
        </div>
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body px-0">
                    <div class="container-fluid">
                        <div class="row mt-3">
                            <?php if ($this->ion_auth->is_admin()) : ?>
                                <div class="col-md-12 mt-3 mt-md-0 text-right">
                                    <button type="button" data-toggle="modal" data-target="#importModal" class="bg-biru-muda text-light px-4 h5" style="border-radius: 2em; border-width: 0;">+ Import User</button>
                                </div>
                            <?php endif; ?>
                            <?php if ($reseller) : ?>
                                <div class="col-md-12 mt-3 mt-md-0 text-right">
                                    <a href="<?= site_url('manage/userdata/create_user') ?>" class="bg-biru-muda text-light px-4 h5" style="border-radius: 2em;">+ Add New</a>
                                </div>
                            <?php endif; ?>
                            <div class="col-12">
                                <div class="table-responsive mt-3">
                                    <table class="table" id="example">
                                        <thead>
                                            <tr class="text-dark">
                                                <th>Nama Lengkap</th>
                                                <th>Sekolah</th>
                                                <th>Username</th>
                                                <th>Status Akun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (empty($item)) {
                                                echo '<tr><td colspan="5" class="text-center">No data <b>Belum ada data user.</b> </td></tr>';
                                            } else {
                                                foreach ($item as $i) { ?>
                                                    <tr>
                                                        <td><?= $i['first_name'] ?></td>
                                                        <td><?= $i['company'] ?></td>
                                                        <td><?= $i['username'] ?></td>
                                                        <td><?= $i['active'] == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>

                                                        <td width="1">
                                                            <a href="<?= site_url('manage/userdata/index/' . $i['id']) ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-person" viewBox="0 0 16 16">
                                                                    <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z" />
                                                                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z" />
                                                                    <path fill-rule="evenodd" d="M8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                                                    <path d="M8 12c4 0 5 1.755 5 1.755V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-.245S4 12 8 12z" />
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
    <?php if ($reseller) : ?>
        <div class="row mt-5">
            <div class="col-12">
                <div class="h3 text-biru">Status Tiket</div>
            </div>
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-body px-0">
                        <div class="container-fluid">
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="table-responsive mt-3">
                                        <table class="table" id="myTable">
                                            <thead>
                                                <tr class="text-dark">
                                                    <th>Nama Lengkap</th>
                                                    <th>Phone</th>
                                                    <th>Sekolah</th>
                                                    <th>Tiket</th>
                                                    <th>Jumlah</th>
                                                    <th>Diajukan pada</th>
                                                    <th>Status</th>
                                                    <th>AKsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (empty($users_ticket)) {
                                                    echo '<tr><td colspan="8" class="text-center">No data <b>Belum ada pengajuan tiket.</b> </td></tr>';
                                                } else {
                                                    foreach ($users_ticket as $i) { ?>
                                                        <tr>
                                                            <td><?= $i['first_name'] ?></td>
                                                            <td><?= $i['phone'] ?></td>
                                                            <td><?= $i['company'] ?></td>
                                                            <td><?= $i['category'] ?></td>
                                                            <td><?= $i['quantity'] ?></td>
                                                            <td><?= date('d-m-Y - H:i', $i['created']) ?></td>
                                                            <td><?= $i['status'] == 1 ? 'Disetujui' : 'Pending' ?></td>
                                                            <td>
                                                                <?php if ($i['status'] == 0) : ?>
                                                                    <a href="<?= base_url('manage/userdata/delete_ticket/' . $i['ticket_id']) ?>" class="btn-hapus">
                                                                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                                        </svg>
                                                                    </a>
                                                                <?php endif; ?>
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
    <?php endif; ?>
</div>
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?= form_open_multipart('manage/userdata/import_user') ?>
            <div class="modal-header">
                <h5 class="modal-title">Import User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group mb-3">
                    <div class="custom-file">
                        <input type="file" name="user_file" class="custom-file-input" id="user_file">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <p>Import file sesuai format. Untuk melihat format yang harus digunakan klik Download Format.</p>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Import</button>
                <a href="<?= base_url('manage/userdata/import_user_format') ?>" class="btn btn-secondary">Download Format</a>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>