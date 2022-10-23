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
                    <span aria-hidden="true">×</span>
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
<script>
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });
</script>
<?php if ($this->uri->segment(2) == 'transaction') : ?>
    <?php if (is_null($orders['status']) || $orders['status'] == 'pending') : ?>
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $clientKey ?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function() {
                $.ajax({
                    url: '<?= base_url() ?>' + '/usr/update_snaptoken',
                    method: "POST",
                    data: {
                        id: <?= $orders['id'] ?>,
                        snaptoken: '<?= $snapToken ?>'
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.status);
                    }
                });
                getStats();
                // SnapToken acquired from previous step
                snap.pay('<?= $snapToken ?>', {
                    // Optional
                    onSuccess: function(result) {
                        updStats(result);
                        getStats();
                    },
                    // Optional
                    onPending: function(result) {
                        updStats(result);
                        getStats();
                    },
                    // Optional
                    onError: function(result) {}
                });
            };

            function updStats(result) {
                $.ajax({
                    url: '<?= base_url() ?>' + '/usr/update_transaction',
                    method: "POST",
                    data: {
                        id: <?= $orders['id'] ?>,
                        payment: result.payment_type,
                        status: result.transaction_status,
                        modified: result.transaction_time,
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data.status);
                    }
                });
            };

            function getStats() {
                $.ajax({
                    url: '<?= base_url() ?>' + '/usr/get_transaction',
                    method: "POST",
                    data: {
                        id: <?= $orders['id'] ?>,
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status) {
                            if (data.data.status != 'pending' && data.data.status != null) {
                                location.reload();
                            }
                        }
                    }
                });
            };
        </script>
<?php endif;
endif; ?>
</body>

</html>