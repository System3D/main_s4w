<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Importacoes</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de importacoes
                </div>
                <?php if (!empty($imp)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="10%">Id</th>
                                    <th>Arquivo</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($imp as $im) {
                                $isso = explode('.',$im->arquivo);
                                if($isso[1] == 'DBF' || $isso[1] == 'dbf'){
                             ?>
                                
                                <tr>
                                    <td><?=$im->importacaoID;?></td>
                                    <td><a href="<?=base_url() . 'saas/estagio/conjuntos/' . $im->importacaoID?>"><?=$im->arquivo;?></a></td>
                                </tr>
                                <?php
                                    }
                                 } ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- /.panel-body -->
                <?php } else { ?>
                <div class="panel-heading">
                    <h4>Nada ainda cadastrado!</h4>
                </div>
                <?php } ?>
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.col-lg-12 -->
        <div class="col-lg-6 col-md-6">
            <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
           <a href="<?=base_url('saas/obras/cadastrar/');?>" type="button" class="btn btn-primary">Cadastrar Obra</a>
        </div>
    </div>
    <br /><hr /><br />
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#dataTables').DataTable({
        responsive: true
    });
});
</script>