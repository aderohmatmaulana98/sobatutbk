<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?= $this->session->flashdata('msg') ?>
            </p>
            <div class="h2 text-biru">Tambah Koleksi Soal</div>
        </div>
        <div class="col-lg-6">
            <?= form_open('manage/bank_soal/update/' . $post['id']) ?>
            <div class="form-group">
                <select class="custom-select" name="" id="category">
                    <option>Pilih kategori soal</option>
                    <?php if (!empty($item)) :
                        foreach ($item as $i) : ?>
                            <option <?= ($i['category'] == $post['category']) ? 'selected' : '' ?> value="<?= $i['category'] ?>"><?= ucfirst($i['category']) ?></option>
                    <?php endforeach;
                    endif; ?>
                </select>
            </div>
            <div class="form-group">
                <select class="custom-select" name="subject" id="subject">
                    <option>Pilih Subject soal</option>
                    <?php foreach ($subject as $i) :
                        if ($i['category'] == $post['category']) : ?>
                            <option <?= ($i['subject'] == $post['subject']) ? 'selected' : '' ?> value="<?= $i['id'] ?>"><?= ucfirst($i['subject']) ?></option>
                    <?php endif;
                    endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="name" id="name" value="<?= $this->form_validation->set_value('name', $post['name']) ?>" aria-describedby="helpId" placeholder="Nama Soal">
            </div>
            <button type="submit" class="btn bg-orange text-light py-1" style="border-radius: 2em;">Upload Soal</button>
            <?= form_close() ?>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card" style="background-color: #e6e6e6;">
                <div class="card-body">
                    <a href="<?= base_url('manage/bank_soal') ?>">
                        <i class="fa fa-arrow-left mb-3" aria-hidden="true"></i> Kembali ke bank soal
                    </a>
                    <div class="h4 text-dark"><?= ucwords($post['name']) ?></div>

                    <div class="card">
                        <div class="card-body">
                            <div class="container-fluid px-0">
                                <div class="row">
                                    <div class="col-6 text-biru h4">Daftar Pertanyaan</div>
                                    <div class="col-6"><input type="search" class="form-control" placeholder="Cari Pertanyaan"></div>
                                    <div class="col-12 text-right mt-2">
                                        <a href="<?= base_url('manage/bank_soal/create_soal/' . $post['id']) ?>" class="btn btn-primary text-light">Tambah Pertanyaan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (!empty($soal)) :
                        $no = 1;
                    ?>
                        <div class="card mt-3">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <?php foreach ($soal as $i) : ?>
                                        <tr>
                                            <td class="pl-md-4 py-5">
                                                <div class="h5 text-biru">Pertanyaan <?= $no ?></div>
                                                <?= $i['description'] ?>
                                                <div class="text-biru">
                                                    <ol type="a">
                                                        <li <?= ($i['answer'] == 1) ? 'class="text-success"' : '' ?>><?= $i['opt1'] ?></li>
                                                        <li <?= ($i['answer'] == 2) ? 'class="text-success"' : '' ?>><?= $i['opt2'] ?></li>
                                                        <li <?= ($i['answer'] == 3) ? 'class="text-success"' : '' ?>><?= $i['opt3'] ?></li>
                                                        <li <?= ($i['answer'] == 4) ? 'class="text-success"' : '' ?>><?= $i['opt4'] ?></li>
                                                        <li <?= ($i['answer'] == 5) ? 'class="text-success"' : '' ?>><?= $i['opt5'] ?></li>
                                                    </ol>
                                                </div>
                                                <div class="card" style="background-color: bisque;">
                                                    <div class="card-body">
                                                        <div class="text-biru">Pembahasan <i id="pembahasan<?= $no ?>" class="fa fa-eye text-primary" aria-hidden="true" style="cursor: pointer;"></i> </div>
                                                        <span id="content-pembahasan<?= $no ?>">
                                                            <?= $i['explanation'] ?>
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="1" class="py-5">
                                                <a href="<?= site_url('manage/bank_soal/update_soal/' . $post['id'] . '/' . $i['id']) ?>">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-pen-fill mt-3 text-primary" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M13.498.795l.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                    </svg>
                                                </a>
                                            </td>
                                            <td width="1" class="pr-md-5 py-5">
                                                <a href="<?= base_url('manage/bank_soal/delete_soal/' . $post['id'] . '/' . $i['id']) ?>" class="btn-hapus">
                                                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-trash-fill mt-3 text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                        <script>
                                            $("#content-pembahasan<?= $no ?>").hide();
                                            $("#pembahasan<?= $no ?>").click(function() {
                                                $("#content-pembahasan<?= $no ?>").toggle("slow");
                                            });
                                        </script>
                                    <?php $no++;
                                    endforeach; ?>
                                </table>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>