</div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>public/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url(); ?>public/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>public/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo base_url(); ?>public/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>public/vendors/iCheck/icheck.min.js"></script>
<!-- Datatables -->
<script src="<?php echo base_url(); ?>public/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/jszip/dist/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>public/vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo base_url(); ?>public/build/js/custom.min.js"></script>

<script>
    $(document).ready(function() {
        // updating the view with notifications using ajax
        function load_unseen_notification(view = '') {
            $.ajax({
                url: "<?php echo base_url('transaksi/transaksi_notif'); ?>",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('.counts').html(data.notification);
                    if (data.unseen_notification > 0) {
                        // badge
                        $('.counts').html(data.unseen_notification);
                        // bunyi
                        var snd = new Audio('<?php echo base_url('public/sound/notif2.mp3'); ?>');
                        snd.play();
                    } else {
                        $('.counts').html("");
                    }
                }
            });
        }
        load_unseen_notification();

        // updating the view with notifications using ajax
        function load_other_notification(view = '') {
            $.ajax({
                url: "<?php echo base_url('transaksi/transaksi_other_notif'); ?>",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('.countsother').html(data.notification);
                    if (data.unseen_notification > 0) {
                        // badge
                        $('.countsother').html(data.unseen_notification);
                        // bunyi
                        var snd = new Audio('<?php echo base_url('public/sound/notif2.mp3'); ?>');
                        snd.play();
                    } else {
                        $('.countsother').html("");
                    }
                }
            });
        }
        load_other_notification();

        function load_pasien_mendaftar(view = '') {
            $.ajax({
                url: "<?php echo base_url('user/user_mendaftar_notif'); ?>",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('.count_user').html(data.notification);
                    if (data.unseen_notification > 0) {
                        // badge
                        $('.count_user').html(data.unseen_notification);
                    } else {
                        $('.count_user').html("");
                    }
                }
            });
        }
        load_pasien_mendaftar();

        // load new notifications
        $(document).on('click', '.badge-danger', function() {
            $('.badge-danger').html('');
            load_unseen_notification('yes');
        });

        setInterval(function() {
            load_unseen_notification();;
            load_other_notification();
            load_pasien_mendaftar();
        }, 5000);
    });
</script>

</body>

</html>