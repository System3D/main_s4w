<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Painel administrativo</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-dollar fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $retVal = (isset($qtdLocatarios)) ? $qtdLocatarios : 0 ; ?></div>
                            <div>Locatários do Sistema</div>
                        </div>
                    </div>
                </div>
                <a href="<?=base_url('sistema/locatarios/listar');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalhes</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <!-- /.row -->

    <!-- /.row -->
</div>