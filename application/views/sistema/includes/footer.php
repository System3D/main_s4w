    <div class="row">
        <div class="col-lg-12"><br/ ><br/ >
            <p class="text-center">
                <img src="<?=base_url('assets/img/logo-Steel4web-600.png');?>" alt="Stell4Web">
            </p>
        </div>
    </div>
 </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url();?>assets/tabel.js"></script>
    <script src="<?=base_url();?>assets/moment.js"></script>
    <script src="<?=base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="<?=base_url();?>assets/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <?php if (isset($grafico) && $grafico == 1) { ?>
     <!-- Morris Charts JavaScript -->
    <script src="<?=base_url();?>assets/bower_components/raphael/raphael-min.js"></script>
    <script src="<?=base_url();?>assets/bower_components/morrisjs/morris.min.js"></script>
    <script src="<?=base_url();?>assets/js/morris-data.js"></script>
    <?php } ?>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url();?>assets/dist/js/sb-admin-2.js"></script>
    <script src="<?=base_url();?>assets/dist/js/jquery.mask.min.js"></script>
    <script src="<?=base_url();?>assets/dist/js/funcoes.js"></script>
</body>

</html>