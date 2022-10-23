<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
            <div class="h2 text-biru">Update Paket Soal</div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <?= form_open('manage/paket_soal/update/' . $post['id']) ?>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" id="name" value="<?= $post['name'] ?>" aria-describedby="helpId" placeholder="Nama Paket">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="description" id="description" value="<?= $post['description'] ?>" aria-describedby="helpId" placeholder="Deskripsi">
                    </div>
                    <button type="submit" class="btn bg-orange text-light py-1">Update paket soal</button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <?= form_open('manage/paket_soal/add_soal') ?>
                    <div class="form-group">
                        <select class="custom-select" name="category" id="category">
                            <option>Pilih kategori soal</option>
                            <?php if (!empty($kategori_soal)) :
                                foreach ($kategori_soal as $i) : ?>
                                    <option value="<?= $i['category'] ?>"><?= ucfirst($i['category']) ?></option>
                            <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="subject" id="subject">
                            <option>Pilih Subject soal</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="custom-select" name="material" id="material">
                            <option>Pilih Bank soal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn bg-orange text-light py-1">Tambahkan ke daftar soal</button>
                    <?= form_hidden('paket_soal_id', $post['id']) ?>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-header" style="background-color: #329fed;">
                    <div class="h5 mb-0 text-light">Daftar Soal Yang Digunakan</div>
                </div>
                <div class="card-body px-0">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <?php if (!empty($kategori_bank_soal)) : ?>
                                    <td width="400">
                                        <ul style="list-style-type: none;" class="pl-0 paket-soal">
                                            <?php foreach ($kategori_bank_soal as $i) : ?>
                                                <li class="border-bottom">
                                                    <button class="btn px-0 py-0 my-2" id="menu-<?= $i['id'] ?>">
                                                        <?= ucwords($i['category']) . ' - ' . ucwords($i['subject']) ?>
                                                    </button>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>

                                    <td>
                                        <?php foreach ($kategori_bank_soal as $i) : ?>
                                            <div class="card daftar-soal-<?= $i['id'] ?> hide-content">
                                                <div class="card-body">
                                                    <div>
                                                        <div class="d-inline-block">
                                                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-file-earmark-fill text-menu" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0H4zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z" />
                                                            </svg>
                                                            <span class="h5 text-biru">Daftar soal (<?= ucwords($i['category']) . ' - ' . ucwords($i['subject']) ?>)</span>
                                                        </div>
                                                        <span class="float-right mb-3 mb-md-0">
                                                            <a href="<?= base_url('manage/paket_soal/delete_all_soal/' . $post['id'] . '/' . $i['id']) ?>" class="btn btn-danger btn-hapus">
                                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                                </svg>
                                                                Delete all
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <div class="table-responsive shadow mt-4">
                                                        <table class="table mb-0">
                                                            <?php
                                                            $no = 1;
                                                            foreach ($butir_paket_soal as $j) :
                                                                if ($i['id'] == $j['kategori_soal_id']) :
                                                            ?>
                                                                    <tr class="border">
                                                                        <td class="pl-lg-4">
                                                                            <div class="h5 text-biru">No <?= $no;
                                                                                                            $no++ ?></div>
                                                                            <?= $j['description'] ?>
                                                                            <ol type="a">
                                                                                <li <?= ($j['answer'] == 1) ? 'class="text-success"' : '' ?>><?= $j['opt1'] ?></li>
                                                                                <li <?= ($j['answer'] == 2) ? 'class="text-success"' : '' ?>><?= $j['opt2'] ?></li>
                                                                                <li <?= ($j['answer'] == 3) ? 'class="text-success"' : '' ?>><?= $j['opt3'] ?></li>
                                                                                <li <?= ($j['answer'] == 4) ? 'class="text-success"' : '' ?>><?= $j['opt4'] ?></li>
                                                                                <li <?= ($j['answer'] == 5) ? 'class="text-success"' : '' ?>><?= $j['opt5'] ?></li>
                                                                            </ol>
                                                                        </td>
                                                                        <td width="1" class="pr-lg-4">
                                                                            <a href="<?= base_url('manage/paket_soal/delete_item_soal/' . $post['id'] . '/' . $j['id']) ?>" class="btn-hapus">
                                                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                                                </svg>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                            <?php endif;
                                                            endforeach; ?>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </td>
                                <?php
                                endif; ?>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END CONTAINER -->
<?php if (!empty($kategori_bank_soal)) : ?>
    <script>
        $(document).ready(function() {
            <?php foreach ($kategori_bank_soal as $i) : ?>
                $("#menu-<?= $i['id'] ?>").click(function() {
                    $(".daftar-soal-<?= $i['id'] ?>").removeClass("hide-content");
                    <?php foreach ($kategori_bank_soal as $j) :
                        if ($j['id'] != $i['id']) : ?>
                            $(".daftar-soal-<?= $j['id'] ?>").addClass("hide-content");
                    <?php endif;
                    endforeach; ?>

                    $("#menu-<?= $i['id'] ?>").addClass("text-biru-muda");
                    <?php foreach ($kategori_bank_soal as $j) :
                        if ($j['id'] != $i['id']) : ?>
                            $("#menu-<?= $j['id'] ?>").removeClass("text-biru-muda");
                    <?php endif;
                    endforeach; ?>
                });
            <?php endforeach; ?>
        });
    </script>
<?php endif; ?>