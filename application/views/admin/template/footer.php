</div>
</div>
<!-- End of Main Content -->

<!-- Footer -->
<!-- <footer class="sticky-footer bg-dark text-light">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2019</span>
                    </div>
                </div>
            </footer> -->
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('asset/user/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('asset/user/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('asset/user/') ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->

<!-- Page level custom scripts -->
<script src="<?= base_url('asset/user/') ?>js/demo/chart-area-demo.js"></script>
<script src="<?= base_url('asset/user/') ?>js/demo/chart-pie-demo.js"></script>
<script src="<?= base_url('asset/admin/js/sweetalert.js') ?>"></script>
<?php if ($this->uri->segment(2) == 'product') : ?>
    <script src="https://cdn.ckeditor.com/4.15.1/full/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {
            height: 150
        });
    </script>
<?php endif; ?>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#data_table').DataTable();
    });
</script>
<script type="text/javascript" src="<?= base_url('asset/user/') ?>DataTables/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script>
    $(document).ready(function() {
        $('#category').change(function() {
            var category = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>' + 'manage/bank_soal/get_subject',
                method: "POST",
                data: {
                    category: category
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            html += '<option value="' + value.id + '">' + value.subject + '</option>';
                        });

                        $('#subject').html('<option selected>Pilih kategori soal</option>' + html);
                    }
                }
            });
            return false;
        });

        $('#subject').change(function() {
            var subject = $(this).val();
            $.ajax({
                url: '<?= base_url() ?>' + 'manage/bank_soal/get_subject',
                method: "POST",
                data: {
                    id: subject
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            html += '<option value="' + value.id + '">' + value.name + '</option>';
                        });

                        $('#material').html('<option selected>Pilih bank soal</option>' + html);
                    }
                }
            });
            return false;
        });
    });
</script>
<?php
if (!empty($assets_footer) && ($this->uri->segment(3) == 'create_soal' || $this->uri->segment(3) == 'update_soal')) {
    foreach ($assets_footer as $asset) {
        echo $asset;
    }
}
?>
</body>

</html>