<!-- All Jquery -->
<!-- ============================================================== -->

<!-- Bootstrap tether Core JavaScript -->
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/sparkline/sparkline.js"></script>
<!--Wave Effects -->
<script src="<?php echo base_url('optimum/admin') ?>/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="<?php echo base_url('optimum/admin') ?>/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?php echo base_url('optimum/admin') ?>/dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<!-- Charts js Files -->
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/flot/excanvas.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/magnific-popup/meg.init.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/toastr/build/toastr.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/libs/select2/dist/js/select2.min.js"></script>

<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/multicheck/jquery.multicheck.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/DataTables-1.10.21/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Select-1.3.1/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/Buttons-1.6.2/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url('optimum/admin') ?>/assets/extra-libs/DataTables/FixedHeader-3.1.7/js/dataTables.fixedHeader.min.js"></script>




<?php include('js.php'); ?>

<script type="text/javascript">
  $(document).ready(function() {
    <?php if ($this->session->flashdata()) : ?>
      <?php if ($this->session->flashdata('error')) : ?>
        toastr.error('Faild!', '<?php echo $this->session->flashdata('msg') ?>');
      <?php else : ?>
        toastr.success('Success!', '<?php echo $this->session->flashdata('msg') ?>');
      <?php endif; ?>
    <?php endif; ?>
  });
</script>

</body>

</html>