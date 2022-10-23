<div class="container-fluid mb-5 pb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="h2 text-biru">Tambah Paket Soal</div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <?=form_open('manage/paket_soal/create')?>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Nama Paket">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="description" id="description" aria-describedby="helpId" placeholder="Deskripsi">
                        </div>
                        <button type="submit" class="btn bg-orange text-light py-1">Tambahkan paket soal</button>
                    <?=form_close()?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- END CONTAINER -->

<script>
    $(document).ready(function() {

        $("#menu-1").click(function() {
            $(".daftar-soal-2").addClass("hide-content");
            $(".daftar-soal-1").removeClass("hide-content");

            $("#menu-1").addClass("text-biru-muda");
            $("#menu-2").removeClass("text-biru-muda");
        });

        $("#menu-2").click(function() {
            $(".daftar-soal-1").addClass("hide-content");
            $(".daftar-soal-2").removeClass("hide-content");

            $("#menu-2").addClass("text-biru-muda");
            $("#menu-1").removeClass("text-biru-muda");
        });
    });
</script>