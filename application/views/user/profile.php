<!-- Begin Page Content -->
<div class="container-fluid mb-5 pb-5">
    <div id="infoMessage"><?php echo $message; ?></div>
    <div id="infoMessage"><?php echo $this->session->flashdata('picmessage'); ?></div>
    <div class="row profile">
        <div class="col-lg-4">
            <div class="card" style="border: 1px solid #183f9b;">
                <div class="card-body">
                    <?= form_open_multipart('auth/edit_user/' . $user->id) ?>
                    <div class="form-group text-center text-hitam">
                        Data pribadi
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama lengkap</label>
                        <?php echo form_input($first_name, '', 'class="form-control" aria-describedby="helpId" placeholder=""'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">Username</label>
                        <input type="text" class="form-control disable" value="<?= $user->username ?>" aria-describedby="helpId" placeholder="" disabled>
                    </div>
                    <?php
                    if ($user->email == NULL) :
                    ?>
                        <div class="form-group">
                            <label for="nama">Email</label>
                            <?php echo form_input($email, '', 'class="form-control" aria-describedby="helpId" placeholder="Email tidak dapat diubah setelah terisi"'); ?>
                        </div>
                    <?php else : ?>
                        <div class="form-group">
                            <label for="nama">Email</label>
                            <input type="text" class="form-control disable" value="<?= $user->email ?>" aria-describedby="helpId" placeholder="" disabled>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nama">Telephone</label>
                        <?php echo form_input($phone, '', 'class="form-control" aria-describedby="helpId" placeholder=""'); ?>
                    </div>
                    <div class="form-group">
                        <label for="nama">Asal Sekolah</label>
                        <?php echo form_input($company, '', 'class="form-control" aria-describedby="helpId" placeholder=""'); ?>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Gender</label>
                        <select id="inputState" class="form-control" name="gender">
                            <option <?= ($user->gender == '1' || $user->gender == '2') ? 'selected' : '' ?>>Choose...</option>
                            <option value="1" <?= ($user->gender == '1') ? 'selected' : '' ?>>Pria</option>
                            <option value="2" <?= ($user->gender == '2') ? 'selected' : '' ?>>Wanita</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputState">Photo profile</label>
                        <table width="100%">
                            <tr>
                                <td width="30%">
                                    <?php
                                    if (empty($user->profile)) : ?>
                                        <span class="badge badge-danger">Belum upload</span>
                                    <?php else : ?>
                                        <img class="img-fluid rounded" src="<?= base_url('asset/user/profile/' . $user->profile); ?>">
                                    <?php endif;
                                    ?>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profilepic" id="profilepic" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Upload
                                                Photo</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <div class="form-group text-right">
                        <button class="btn btn-dark-blue">Simpan</button>
                    </div>
                    <?= form_hidden('id', $user->id); ?>
                    <?= form_hidden($csrf); ?>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mt-3 mt-sm-0" style="border: 1px solid #183f9b;">
                <div class="card-body">
                    <?= form_open('auth/change_password') ?>
                    <div class="form-group text-center text-hitam">
                        Ganti Password
                    </div>
                    <div class="form-group">
                        <label for="nama">Password lama</label>
                        <input type="password" id="password-lama" class="form-control" name="old" id="password_old" aria-describedby="helpId" placeholder="">
                        <span toggle="#password-lama" class="fa fa-fw fa-eye fa-eye-slash field-icon toggle-password text-dark"></span>

                    </div>
                    <div class="form-group">
                        <label for="nama">Password baru</label>
                        <input id="password-baru" type="password" class="form-control" name="new" id="password" aria-describedby="helpId" placeholder="">
                        <span toggle="#password-baru" class="fa fa-fw fa-eye fa-eye-slash field-icon text-dark toggle-password"></span>

                    </div>
                    <div class="form-group">
                        <label for="nama">Verifikasi Password</label>
                        <input id="verifikasi-password" type="password" class="form-control" name="new_confirm" id="password_confirm" aria-describedby="helpId" placeholder="">
                        <span toggle="#verifikasi-password" class="fa fa-fw fa-eye fa-eye-slash text-dark field-icon toggle-password"></span>

                    </div>
                    <hr>
                    <div class="form-group text-right">
                        <button class="btn btn-dark-blue">Simpan</button>
                    </div>
                    <?= form_hidden('id', $user->id); ?>
                    <?= form_hidden($csrf); ?>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
</script>

<!-- /.container-fluid -->