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

<!-- Logout Modal -->
<!-- <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div> -->

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
<!--<script src="<?= base_url('asset/user/') ?>js/utility.js"></script>-->
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });

    $(document).ready(function() {

        $('#ptn1').change(function() {
            var ptn = $(this).val();

            $.ajax({
                url: "<?= base_url('Exm/get_jurusan'); ?>",
                method: "POST",
                data: {
                    nama: ptn,
                    kategori: '<?= $ptn_category ?>'
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            html += '<option value="' + value.id + '">' + value.jurusan + '</option>';
                        });

                        $('#jurusan1').html('<option selected>Jurusan</option>' + html);
                    }
                }
            });
            return false;
        });

        $('#ptn2').change(function() {
            var ptn = $(this).val();
            $.ajax({
                url: "<?= base_url('Exm/get_jurusan'); ?>",
                method: "POST",
                data: {
                    nama: ptn,
                    kategori: '<?= $ptn_category ?>'
                },
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    if (data.status) {
                        $.each(data.data, function(index, value) {
                            html += '<option value="' + value.id + '">' + value.jurusan + '</option>';
                        });

                        $('#jurusan2').html('<option selected>Jurusan</option>' + html);
                    }
                }
            });
            return false;
        });
    });
</script>
</body>

</html>