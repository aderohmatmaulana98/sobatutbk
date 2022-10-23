<script>
    const menu = ['Header', 'Tentang', 'Alasan', 'Produk', 'Testimoni', 'Footer', 'Tentang-Hero', 'Tentang-FAQ', 'Testimoni-Hero', 'User-Dashboard'];


    function menuHome(index) {
        sessionStorage.setItem("index", index);
        tampil = menu[index];
        $('#home').text(tampil);
        $('#' + tampil).show();
        $('#btn-' + tampil).addClass('btn-info');
        for (i = 0; i < menu.length; i++) {
            if (i != index) {
                console.log('hide #' + menu[i])
                $('#' + menu[i]).hide();
                $('#btn-' + menu[i]).removeClass('btn-info');
                $('#btn-' + menu[i]).addClass('btn-secondary');
            }
        }
    }
</script>

<div class="container-fluid homepage pb-5">
    <div class="row">
        <div class="col-md-2">
            <div class="card shadow">
                <div class="card-body p-2">
                    <div class="text-center text-dark">
                        HomePage
                    </div>
                    <hr class="mt-1 mb-2">
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Header" onclick="menuHome(0)">Header & Hero</button>
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Tentang" onclick="menuHome(1)">Tentang</button>
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Alasan" onclick="menuHome(2)">Alasan</button>
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Produk" onclick="menuHome(3)">Produk</button>
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Testimoni" onclick="menuHome(4)">Testimoni</button>
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Footer" onclick="menuHome(5)">F&Q</button>

                </div>
            </div>

            <div class="card shadow mt-2">
                <div class="card-body p-2">
                    <div class="text-center text-dark">
                        Tentang
                    </div>
                    <hr class="mt-1 mb-2">
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Tentang-Hero" onclick="menuHome(6)">Hero</button>
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Tentang-FAQ" onclick="menuHome(7)">F&Q</button>
                </div>
            </div>

            <div class="card shadow mt-2">
                <div class="card-body p-2">
                    <div class="text-center text-dark">
                        Testimoni
                    </div>
                    <hr class="mt-1 mb-2">
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-Testimoni-Hero" onclick="menuHome(8)">Hero</button>
                </div>
            </div>

            <hr>

            <div class="card shadow mt-3">
                <div class="card-body p-2">
                    <div class="text-center text-dark">
                        SiswaPage
                    </div>
                    <hr class="mt-1 mb-2">
                    <button class="btn btn-sm btn-secondary btn-block" id="btn-User-Dashboard" onclick="menuHome(9)">Dashboard</button>

                </div>
            </div>
        </div>

        <div class="col-md-10 mt-3 mt-md-0" id="content-home">
            <div class="container-fluid  px-0">
                <div class="row">
                    <div class="col-md-8">
                        <?= $this->session->flashdata('message'); ?>
                        <?= $this->session->flashdata('message-file'); ?>
                    </div>

                    <div class="col-md-8" id="Header">
                        <div class="card shadow">
                            <?php echo form_open_multipart('manageui/header/update'); ?>
                            <div class="card-body">
                                <input type="hidden" name="awal" value="0">
                                <input type="hidden" name="akhir" value="4">
                                <div class="text-center text-dark h5 mb-0"> Promo</div>
                                <hr class="my-2">
                                <div class="form-group">
                                    <label for="" class="mb-0">Text</label>
                                    <input type="text" class="form-control" value="<?= $master[0]['isi'] ?>" name="<?= $master[0]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol</label>
                                    <input type="text" class="form-control" value="<?= $master[1]['isi'] ?>" name="<?= $master[1]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center text-dark h5 mb-0"> Hero</div>

                                <hr class="my-2">

                                <div class="form-group">
                                    <label for="" class="mb-0">Text 1</label>
                                    <input type="text" class="form-control" value="<?= $master[2]['isi'] ?>" name="<?= $master[2]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="">Text 2</label>
                                    <textarea class="form-control" name="<?= $master[3]['judul'] ?>" rows="3"><?= $master[3]['isi'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol</label>
                                    <input type="text" class="form-control" value="<?= $master[4]['isi'] ?>" name="<?= $master[4]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 30%;" src="<?= base_url('asset/homepage/img/') . $img[0]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[0]['id'] ?>" value="<?= $img[0]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[0]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8" id="Tentang">
                        <?php echo form_open_multipart('manageui/tentang/update'); ?>
                        <div class="card">
                            <div class="card-body shadow">
                                <input type="hidden" name="awal" value="5">
                                <input type="hidden" name="akhir" value="22">
                                <div class="form-group">
                                    <label for="" class="mb-0">Header 1</label>
                                    <input type="text" class="form-control" value="<?= $master[5]['isi'] ?>" name="<?= $master[5]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="">Text</label>
                                    <textarea class="form-control" name="<?= $master[6]['judul'] ?>" rows="3"><?= $master[6]['isi'] ?></textarea>
                                </div>

                                <hr class="bg-dark">

                                <div class="form-group">
                                    <label for="" class="mb-0">Header 2</label>
                                    <input type="text" class="form-control" value="<?= $master[7]['isi'] ?>" name="<?= $master[7]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 8%;" src="<?= base_url('asset/homepage/img/') . $img[1]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[1]['id'] ?>" value="<?= $img[1]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[1]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Text 1</label>
                                    <textarea class="form-control" name="<?= $master[8]['judul'] ?>" rows="3"><?= $master[8]['isi'] ?></textarea>
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 8%;" src="<?= base_url('asset/homepage/img/') . $img[2]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[2]['id'] ?>" value="<?= $img[2]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[2]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Text 2</label>
                                    <textarea class="form-control" name="<?= $master[9]['judul'] ?>" rows="3"><?= $master[9]['isi'] ?></textarea>
                                </div>

                                <hr class="bg-dark">

                                <div class="form-group">
                                    <label for="" class="mb-0">Header 3</label>
                                    <input type="text" class="form-control" value="<?= $master[10]['isi'] ?>" name="<?= $master[10]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="" class="mb-0">Subheader 1</label>
                                    <input type="text" class="form-control" value="<?= $master[11]['isi'] ?>" name="<?= $master[11]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Text 1</label>
                                    <input type="text" class="form-control" value="<?= $master[12]['isi'] ?>" name="<?= $master[12]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="">Text 2</label>
                                    <textarea class="form-control" name="<?= $master[13]['judul'] ?>" rows="3"><?= $master[13]['isi'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol</label>
                                    <input type="text" class="form-control" value="<?= $master[14]['isi'] ?>" name="<?= $master[14]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 20%;" src="<?= base_url('asset/homepage/img/') . $img[3]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[3]['id'] ?>" value="<?= $img[3]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[3]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="" class="mb-0">Subheader 2</label>
                                    <input type="text" class="form-control" value="<?= $master[15]['isi'] ?>" name="<?= $master[15]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Text 1</label>
                                    <input type="text" class="form-control" value="<?= $master[16]['isi'] ?>" name="<?= $master[16]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for=""></label>
                                    <textarea class="form-control" name="<?= $master[17]['judul'] ?>" rows="3"><?= $master[17]['isi'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol</label>
                                    <input type="text" class="form-control" value="<?= $master[18]['isi'] ?>" name="<?= $master[18]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 20%;" src="<?= base_url('asset/homepage/img/') . $img[4]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[4]['id'] ?>" value="<?= $img[4]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[4]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                    <label for="" class="mb-0">Subheader 3</label>
                                    <input type="text" class="form-control" value="<?= $master[19]['isi'] ?>" name="<?= $master[19]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Text 1</label>
                                    <input type="text" class="form-control" value="<?= $master[20]['isi'] ?>" name="<?= $master[20]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="">Text 2</label>
                                    <textarea class="form-control" name="<?= $master[21]['judul'] ?>" rows="3"><?= $master[21]['isi'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol</label>
                                    <input type="text" class="form-control" value="<?= $master[22]['isi'] ?>" name="<?= $master[22]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 20%;" src="<?= base_url('asset/homepage/img/') . $img[5]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[5]['id'] ?>" value="<?= $img[5]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[5]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <hr>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-8" id="Alasan">
                        <?php echo form_open_multipart('manageui/alasan/update'); ?>
                        <div class="card shadow">
                            <div class="card-body">
                                <input type="hidden" name="awal" value="23">
                                <input type="hidden" name="akhir" value="23">
                                <div class="form-group">
                                    <label for="" class="mb-0">Header</label>
                                    <input type="text" class="form-control" value="<?= $master[23]['isi'] ?>" name="<?= $master[23]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 100%;" src="<?= base_url('asset/homepage/img/') . $img[6]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[6]['id'] ?>" value="<?= $img[6]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[6]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-8" id="Produk">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php echo form_open_multipart('manageui/produk/update'); ?>
                                <input type="hidden" name="awal" value="24">
                                <input type="hidden" name="akhir" value="26">
                                <div class="form-group">
                                    <label for="" class="mb-0">Header</label>
                                    <input type="text" class="form-control" value="<?= $master[24]['isi'] ?>" name="<?= $master[24]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol 1</label>
                                    <input type="text" class="form-control" value="<?= $master[25]['isi'] ?>" name="<?= $master[25]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol 2</label>
                                    <input type="text" class="form-control" value="<?= $master[26]['isi'] ?>" name="<?= $master[26]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8" id="Testimoni">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php echo form_open_multipart('manageui/tentang/update'); ?>
                                <input type="hidden" name="awal" value="27">
                                <input type="hidden" name="akhir" value="27">
                                <div class="form-group">
                                    <label for="">Header</label>
                                    <input type="text" class="form-control" value="<?= $master[27]['isi'] ?>" name="<?= $master[27]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-primary btn-sm">Simpan</button>
                                </div>
                                </form>

                                <hr>

                                <div class="text-right mb-2">
                                    <button type="submit" class="btn btn-sm btn-success py-0 px-3" data-toggle="modal" data-target="#addTesti">Add</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr class="text-center text-dark">
                                                <th width="5%">No</th>
                                                <th width="10%">Nama</th>
                                                <th width="15%">Instansi</th>
                                                <th width="55%">Caption</th>
                                                <th width="15%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($testi) : ?>
                                                <?php $no = 1;
                                                foreach ($testi as $t) : ?>
                                                    <tr>
                                                        <td class="align-middle text-center"><?= $no ?></td>
                                                        <td class="align-middle"><?= $t['nama'] ?></td>
                                                        <td class="align-middle text-center"><?= $t['instansi'] ?></td>
                                                        <td><?= $t['isi'] ?></td>
                                                        <td class="align-middle text-center">
                                                            <a href="#" class="mx-1" data-toggle="modal" data-target="#editTesti<?= $t['id'] ?>"><i class="fas fa-edit"></i></a>
                                                            <a href="<?= base_url('manageui/testimoni/hapus/') . $t['id'] ?>" class="mx-1 btn-hapus"><i class="fas fa-trash-alt text-danger"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="6" class="text-center"><i>No Data</i></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <?php foreach ($testi as $t) : ?>
                            <div class="modal fade" id="editTesti<?= $t['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header py-2">
                                            Edit Testimoni
                                        </div>
                                        <form action="<?= base_url('manageui/testimoni/edit') ?>" method="post">
                                            <div class="modal-body">
                                                <input type="hidden" value="<?= $t['id'] ?>" name="id">
                                                <div class="container-fluid">
                                                    <div class="form-group">
                                                        <label for="" class="mb-0">Nama</label>
                                                        <input type="text" value="<?= $t['nama'] ?>" class="form-control" name="nama" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="" class="mb-0">Instansi</label>
                                                        <input type="text" value="<?= $t['instansi'] ?>" class="form-control" name="instansi" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Caption</label>
                                                        <textarea class="form-control" name="caption" rows="3"><?= $t['isi'] ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer py-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Modal -->
                        <div class="modal fade" id="addTesti" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header py-2">
                                        Tambah Testimoni
                                    </div>
                                    <form action="<?= base_url('manageui/testimoni/add') ?>" method="post">
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="form-group">
                                                    <label for="" class="mb-0">Nama</label>
                                                    <input type="text" class="form-control" name="nama" aria-describedby="helpId" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="" class="mb-0">Instansi</label>
                                                    <input type="text" class="form-control" name="instansi" aria-describedby="helpId" placeholder="">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Caption</label>
                                                    <textarea class="form-control" name="caption" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer py-2">
                                            <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8" id="Footer">
                        <div class="card shadow">
                            <?php echo form_open_multipart('manageui/produk/update'); ?>
                            <input type="hidden" name="awal" value="28">
                            <input type="hidden" name="akhir" value="29">
                            <div class="card-body">
                                <div class="text-center text-dark h5 mb-0"> F&Q</div>
                                <hr class="my-2">

                                <div class="form-group">
                                    <label for="" class="mb-0">Text</label>
                                    <input type="text" class="form-control" value="<?= $master[28]['isi'] ?>" name="<?= $master[28]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">Tombol</label>
                                    <input type="text" class="form-control" value="<?= $master[29]['isi'] ?>" name="<?= $master[29]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8" id="Tentang-Hero">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php echo form_open_multipart('manageui/tentang/update'); ?>
                                <input type="hidden" name="awal" value="30">
                                <input type="hidden" name="akhir" value="34">
                                <div class="form-group">
                                    <label for="" class="mb-0">Header 1</label>
                                    <input type="text" class="form-control" value="<?= $master[30]['isi'] ?>" name="<?= $master[30]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Text</label>
                                    <textarea class="form-control" name="<?= $master[31]['judul'] ?>" id="" rows="3"><?= $master[31]['isi'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">Header 2</label>
                                    <input type="text" class="form-control" value="<?= $master[32]['isi'] ?>" name="<?= $master[32]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="">Text</label>
                                    <textarea class="form-control" name="<?= $master[33]['judul'] ?>" id="" rows="3"><?= $master[33]['isi'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="" class="mb-0">Header 3</label>
                                    <input type="text" class="form-control" value="<?= $master[34]['isi'] ?>" name="<?= $master[34]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-right">
                                    <button class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                                </form>

                                <hr>

                                <div class="text-right">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addMisi">Add</button>
                                </div>

                                <div class="table-responsive mt-2">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr class="text-center text-dark">
                                                <th width="5%">No</th>
                                                <th width="80%">Misi</th>
                                                <th width="15%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($misi) : ?>
                                                <?php $no = 1;
                                                foreach ($misi as $m) : ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $no; ?></td>
                                                        <td class="text-justify align-middle"><?= $m['isi']; ?></td>
                                                        <td class="text-center align-middle">
                                                            <a href="#" data-toggle="modal" data-target="#updateMisi<?= $m['id'] ?>" class="mx-1"><i class="fas fa-edit"></i></a>
                                                            <a href="<?= base_url('manageui/tentang/deleteMisi/') . $m['id'] ?>" class="text-danger mx-1 btn-hapus"><i class="fas fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">No Data</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php foreach ($misi as $m) : ?>
                                    <div class="modal fade" id="updateMisi<?= $m['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="<?= base_url('manageui/tentang/updateMisi') ?>" method="POST">
                                                    <input type="hidden" value="<?= $m['id'] ?>" name="id">
                                                    <div class="modal-header py-2">
                                                        Update daftar misi
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" value="<?= $m['isi'] ?>" name="misi" id="" aria-describedby="helpId" placeholder="misi">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer py-2">
                                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>


                                <!-- Modal -->
                                <div class="modal fade" id="addMisi" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="<?= base_url('manageui/tentang/addMisi') ?>" method="POST">
                                                <div class="modal-header py-2">
                                                    Tambah daftar misi
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="misi" id="" aria-describedby="helpId" placeholder="misi">
                                                    </div>
                                                </div>
                                                <div class="modal-footer py-2">
                                                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" id="Tentang-FAQ">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="form-group">
                                    <?php echo form_open_multipart('manageui/tentang/update'); ?>
                                    <input type="hidden" name="awal" value="35">
                                    <input type="hidden" name="akhir" value="35">
                                    <label for="" class="mb-0">F&Q</label>
                                    <input type="text" class="form-control" value="<?= $master[35]['isi'] ?>" name="<?= $master[35]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </form>
                                </div>

                                <hr>
                                <div class="text-right">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addFAQ">Add</button>
                                </div>

                                <div class="table-responsive mt-1">
                                    <table class="table table-sm table-bordered">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="5%">No</th>
                                                <th width="40%">Tanya</th>
                                                <th width="40%">Jawab</th>
                                                <th width="15%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($faq) : ?>
                                                <?php $no = 1;
                                                foreach ($faq as $f) : ?>
                                                    <tr>
                                                        <td class="text-center align-middle"><?= $no; ?></td>
                                                        <td class="text-center align-middle"><?= $f['tanya'] ?></td>
                                                        <td class="text-justify align-middle"><?= $f['jawab'] ?></td>
                                                        <td class="text-center align-middle">
                                                            <a href="" data-toggle="modal" data-target="#updateFAQ<?= $f['id'] ?>"><i class="fas fa-edit mx-1"></i></a>
                                                            <a href="<?= base_url('manageui/tentang/deleteFAQ/') . $f['id'] ?>" class="text-danger mx-1 btn-hapus"><i class="fas fa-trash    "></i></a>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">No Data</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php foreach ($faq as $f) : ?>
                                    <div class="modal fade" id="updateFAQ<?= $f['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    Tambah data F&Q
                                                </div>
                                                <form action="<?= base_url('manageui/tentang/updateFAQ') ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?= $f['id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Tanya (?)</label>
                                                            <input type="text" class="form-control" value="<?= $f['tanya'] ?>" name="tanya" id="" aria-describedby="helpId" placeholder="">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Jawab</label>
                                                            <input type="text" class="form-control" value="<?= $f['jawab'] ?>" name="jawab" id="" aria-describedby="helpId" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Modal -->
                                <div class="modal fade" id="addFAQ" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                Tambah data F&Q
                                            </div>
                                            <form action="<?= base_url('manageui/tentang/addFAQ') ?>" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">Tanya (?)</label>
                                                        <input type="text" class="form-control" name="tanya" id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Jawab</label>
                                                        <input type="text" class="form-control" name="jawab" id="" aria-describedby="helpId" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8" id="Testimoni-Hero">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php echo form_open_multipart('manageui/tentang/update'); ?>
                                <input type="hidden" name="awal" value="36">
                                <input type="hidden" name="akhir" value="37">

                                <div class="text-center my-2">
                                    <img class="img-fluid" style="width: 30%;" src="<?= base_url('asset/homepage/img/') . $img[7]['isi'] ?>" alt="aaa">
                                </div>

                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[7]['id'] ?>" value="<?= $img[7]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[7]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Link Embed Video</label>
                                    <textarea class="form-control" name="<?= $master[36]['judul'] ?>" rows="3"><?= $master[36]['isi'] ?></textarea>
                                    <small>*Add class <b>responsive-iframe mx-auto</b></small>
                                </div>
                                <div class="form-group">
                                    <label for="">Text</label>
                                    <input type="text" class="form-control" value="<?= $master[37]['isi'] ?>" name="<?= $master[37]['judul'] ?>" aria-describedby="helpId" placeholder="">
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-sm btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-8" id="User-Dashboard">
                        <div class="card shadow">
                            <div class="card-body">
                                <?php echo form_open_multipart('manageui/userdashboard/addCard1'); ?>
                                <input type="hidden" name="awal" value="0">
                                <input type="hidden" name="akhir" value="1">
                                <div class="form-group">
                                    <label for="" class="mb-0">Header</label>
                                    <input type="text" class="form-control" name="<?= $user_dashboard[0]['judul'] ?>" value="<?= $user_dashboard[0]['isi'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="mb-0">Text</label>
                                    <input type="text" class="form-control" name="<?= $user_dashboard[1]['judul'] ?>" value="<?= $user_dashboard[1]['isi'] ?>" aria-describedby="helpId" placeholder="">
                                </div>

                                <div class="text-center">
                                    <img src="<?= base_url('asset/user/img/') . $img[9]['isi'] ?>" alt="aa" style="width: 40%;" class="img-fluid">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[9]['id'] ?>" value="<?= $img[9]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[9]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow mt-3">
                            <div class="card-body">
                                <div class="text-right mb-3">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addlist1">Add</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr class="text-center text-dark">
                                                <th width="5%">No</th>
                                                <th width="80%">Isi List 1 - dashboard</th>
                                                <th width="15%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($user_list_1 as $ul1) : ?>
                                                <tr>
                                                    <td class="text-center align-center"><?= $no; ?></td>
                                                    <td class="text-justify"><?= $ul1['isi'] ?></td>
                                                    <td class="text-center align-center">
                                                        <a href="#" class="mx-1" data-toggle="modal" data-target="#editUL1<?= $ul1['id'] ?>"><i class="fas fa-edit"></i></a>
                                                        <a href="<?= base_url('manageui/userdashboard/hapus/') . $ul1['id'] ?>" class="mx-1 btn-hapus"><i class="fas fa-trash-alt text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php foreach ($user_list_1 as $ul1) : ?>
                                    <div class="modal fade" id="editUL1<?= $ul1['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="<?= base_url('manageui/userdashboard/edit') ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?= $ul1['id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">User list card dashboard</label>
                                                            <textarea class="form-control" name="isi" rows="3"><?= $ul1['isi'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0">
                                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Modal -->
                                <div class="modal fade" id="addlist1" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="<?= base_url('manageui/userdashboard/add') ?>" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">User list card dashboard</label>
                                                        <textarea class="form-control" name="isi" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mt-3">
                            <div class="card-body">
                                <div class="text-right mb-3">
                                    <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#addlist2">Add</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr class="text-center text-dark">
                                                <th width="5%">No</th>
                                                <th width="80%">Isi List 2 - Tata tertib</th>
                                                <th width="15%">#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1;
                                            foreach ($user_list_2 as $ul2) : ?>
                                                <tr>
                                                    <td class="text-center align-center"><?= $no; ?></td>
                                                    <td class="text-justify"><?= $ul2['isi'] ?></td>
                                                    <td class="text-center align-center">
                                                        <a href="#" class="mx-1" data-toggle="modal" data-target="#editul2<?= $ul2['id'] ?>"><i class="fas fa-edit"></i></a>
                                                        <a href="<?= base_url('manageui/userdashboard/hapusul2/') . $ul2['id'] ?>" class="mx-1 btn-hapus"><i class="fas fa-trash-alt text-danger"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <?php foreach ($user_list_2 as $ul2) : ?>
                                    <div class="modal fade" id="editul2<?= $ul2['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <form action="<?= base_url('manageui/userdashboard/editul2') ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?= $ul2['id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">User list card dashboard</label>
                                                            <textarea class="form-control" name="isi" rows="3"><?= $ul2['isi'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0 pt-0">
                                                        <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- Modal -->
                                <div class="modal fade" id="addlist2" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="<?= base_url('manageui/userdashboard/addlisttatib') ?>" method="POST">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="">User list card dashboard</label>
                                                        <textarea class="form-control" name="isi" rows="3"></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mt-3">
                            <div class="card-body">

                                <form action="<?= base_url('manageui/userdashboard/addCard1') ?>" method="POST">
                                    <input type="hidden" name="awal" value="2">
                                    <input type="hidden" name="akhir" value="3">

                                    <div class="form-group">
                                        <label for="" class="mb-0">Note</label>
                                        <textarea class="form-control" name="<?= $user_dashboard[2]['judul'] ?>" rows="3"><?= $user_dashboard[2]['isi'] ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="mb-0">Notif PopUp
                                            <?php if ($user_dashboard[3]['is_active'] == 1) : ?>
                                                <i class="fas fa-eye text-success"></i>
                                                <a href="<?= base_url('manageui/userdashboard/is_active/') . $user_dashboard[3]['id'] ?>" class="badge badge-dark">Matikan</a>
                                            <?php else : ?>
                                                <i class="fas fa-eye-slash text-dark"></i>
                                                <a href="<?= base_url('manageui/userdashboard/is_active/') . $user_dashboard[3]['id'] ?>" class="badge badge-success">Aktifkan</a>
                                            <?php endif; ?>
                                        </label>
                                        <textarea class="form-control" name="<?= $user_dashboard[3]['judul'] ?>" rows="3"><?= $user_dashboard[3]['isi'] ?></textarea>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card shadow mt-3">
                            <div class="card-body">
                                <?php echo form_open_multipart('manageui/userdashboard/addCard1'); ?>
                                <input type="hidden" name="awal" value="4">
                                <input type="hidden" name="akhir" value="4">
                                <div class="form-group">
                                    <label for="">Notif Statistik
                                        <?php if ($user_dashboard[4]['is_active'] == 1) : ?>
                                            <i class="fas fa-eye text-success"></i>
                                            <a href="<?= base_url('manageui/userdashboard/is_active/') . $user_dashboard[4]['id'] ?>" class="badge badge-dark">Matikan</a>
                                        <?php else : ?>
                                            <i class="fas fa-eye-slash text-dark"></i>
                                            <a href="<?= base_url('manageui/userdashboard/is_active/') . $user_dashboard[4]['id'] ?>" class="badge badge-success">Aktifkan</a>
                                        <?php endif; ?>
                                    </label>
                                    <textarea class="form-control" name="<?= $user_dashboard[4]['judul'] ?>" rows="3"><?= $user_dashboard[4]['isi'] ?></textarea>
                                </div>
                                <div class="text-center">
                                    <img src="<?= base_url('asset/user/img/') . $img[8]['isi'] ?>" alt="aa" style="width: 40%;" class="img-fluid">
                                </div>
                                <div class="input-group mb-3">
                                    <input type="hidden" name="<?= $img[8]['id'] ?>" value="<?= $img[8]['id'] ?>">
                                    <div class="custom-file">
                                        <input type="file" name="<?= $img[8]['judul'] ?>" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        IndexSession = sessionStorage.getItem("index");

        // console.log(IndexSession);

        if (IndexSession) {
            for (i = 0; i < menu.length; i++) {
                if (i != IndexSession) {
                    $('#' + menu[i]).hide();
                    $('#btn-' + menu[i]).removeClass('btn-info');
                    $('#btn-' + menu[i]).addClass('btn-secondary');
                }
                if (i == IndexSession) {
                    $('#btn-' + menu[i]).removeClass('btn-secondary');
                    $('#btn-' + menu[i]).addClass('btn-info');
                }

            }
        } else {
            for (i = 1; i < menu.length; i++) {
                $('#' + menu[i]).hide();
            }
            $('#btn-' + menu[0]).addClass('btn-info');

        }


        $('.custom-file-input').on('change', function() {
            let filename = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(filename);
        });
    </script>