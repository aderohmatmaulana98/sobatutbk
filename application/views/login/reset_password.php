<!doctype html>
<html lang="en">

<head>
    <title>Reset Password - Sobat UTBK</title>
    <link rel="icon" href="<?= base_url('asset/homepage/img/logo.png') ?>" type="image/gif">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center mt-5">
                <div class="card">
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <div class="card-body">


                        <img class="mt-5" src="<?= base_url('asset/auth/img/lupa_password.svg') ?>" alt="" style="width: 35%;">
                        <div class="h5 text-dark mt-3">Reset Password</div>
                        <p class="text-secondary">Isikan password baru kamu</p>
                        <?php echo form_open('auth/reset_password/' . $code); ?>
                        <div class="form-group">
                            <?php echo form_input($new_password, '', 'type="password" class="form-control text-center" placeholder="Password"'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_input($new_password_confirm, '', 'type="password" class="form-control text-center" placeholder="Ulangi Password"'); ?>
                        </div>
                        <?php echo form_input($user_id); ?>
                        <?php echo form_hidden($csrf); ?>
                        <button type="submit" class="btn btn-primary btn-block">Submit</button>
                        <?php echo form_close(); ?>
                        <div class="container-fluid mt-4">
                            <div class="row">
                                <div class="col">
                                    <hr>
                                </div>
                                <div class="col-3 text-secondary"> ATAU</div>
                                <div class="col">
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div>Hubungi Customer Service</div>
                        <a href="https://wa.me/6282325036930" target="_blank"><img src="<?= base_url('asset/homepage/img/icon/whatsapp.png') ?>" style="width: 7%;" alt=""></a>
                        <div class="border-top mt-5 pt-2"><a href="<?= base_url('auth/login') ?>" class="text-primary" style="text-decoration:  none;"> Kembali ke halaman login </a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>

        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>