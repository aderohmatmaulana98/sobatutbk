<div class="container-fluid">

    <div class="row mt-5">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
        </div>
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
                                                <th>NISN</th>
                                                <th>Nama Siswa</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (empty($detail)) {
                                                echo '<tr><td colspan="5" class="text-center">No data <b>Belum ada data user.</b> </td></tr>';
                                            } else {
                                                foreach ($detail as $i) { ?>
                                                    <tr>
                                                        <td><?= $i['username'] ?></td>
                                                        <td><?= $i['first_name'] ?></td>
                                                        <td width="1">
                                                            <a class="badge bg-primary text-white" href="<?= site_url('manage/userdata/user_active/' . $i['reseller_id'] . '/' . $i['user_id']) ?>">
                                                                Accept
                                                            </a>
                                                            <a class="badge bg-danger text-white" href="<?= site_url('manage/userdata/user_delete/' . $i['reseller_id'] . '/' . $i['user_id']) ?>">
                                                                Delete
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
                                <div class="text-center">
                                    <a class="btn btn-smbtn btn-primary btn-sm" href="<?= site_url('manage/userdata/') ?>">
                                        <i class="fas fa-long-arrow-alt-left"></i> Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>