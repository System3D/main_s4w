<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Locatários</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de locatários do sistema
                </div>
                <?php if (!empty($locatarios)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Razão Social</th>
                                    <th>Fantasia</th>
                                    <th width="15%">Telefone</th>
                                    <th width="10%">Tipo</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Cadastro</th>
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($locatarios as $loc) {
                                if ($loc->tipo == 0) {
                                    $tipo = 'Física';
                                } else {
                                    $tipo = 'Jurídico';
                                }
                                if ($loc->status == 0) {
                                    $status = 'Inativo';
                                    $tipoStatus = 'danger';
                                    $acaoStatus = 'ativar';
                                } else {
                                    $status = 'Ativo';
                                    $tipoStatus = 'success';
                                    $acaoStatus = 'inativar';
                                }
                                ?>
                                <tr class="<?=$tipoStatus;?>">
                                    <td class="text-center"><?=$loc->locatarioID;?></td>
                                    <td><?=$loc->razao;?></td>
                                    <td><?=$loc->fantasia;?></td>
                                    <td class="telefone"><?=$loc->fone;?></td>
                                    <td class="text-center"><?=$tipo;?></td>
                                    <td class="text-center"><?=dataMySQL_to_dataBr($loc->data);?></td>
                                    <td class="text-center">
                                        <span class="text-<?=$tipoStatus;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'sistema/locatarios/editar/' . $loc->locatarioID;?>" alt="Editar locatário" title="Editar locatário">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?=base_url() . 'sistema/locatariosUsuarios/listar/' . $loc->locatarioID;?>" alt="Usuários" title="Usuários">
                                                <i class="fa fa-users fa-fw"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?=base_url() . 'sistema/locatarios/editarStatus/' . $loc->locatarioID . '/' . $acaoStatus;?>" alt="Mudar Status" title="Mudar Status">
                                                <i class="fa fa-refresh fa-fw"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
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
           <a href="<?=base_url('sistema/locatarios/cadastrar/');?>" type="button" class="btn btn-primary">Cadastrar locatário</a>
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