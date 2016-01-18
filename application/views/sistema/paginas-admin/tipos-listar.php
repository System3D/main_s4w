<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Tipos de Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tipos de Clientes
                </div>
                <!-- /.panel-heading -->
                <?php if (!empty($tipoClientes)) { ?>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Tipo</th>
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tipoClientes as $tipos) { ?>
                                <tr>
                                    <td><?=$tipos->tipoClienteID;?></td>
                                    <td><?=$tipos->nome;?></td>
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'tipos/editar/' . $tipos->tipoClienteID;?>" alt="Editar tipo" title="Editar tipo">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <?php } else { ?>
                <div class="panel-heading">
                    <h4>Nada ainda cadastrado!</h4>
                </div>
                <?php } ?>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
    </div>
    <!-- /.row -->
</div>