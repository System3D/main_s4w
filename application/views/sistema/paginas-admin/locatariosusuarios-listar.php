<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Usuários do Locatário: <?=$locatario->razao;?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de usuários do locatário
                </div>
                <?php if (!empty($locatariosUsuarios)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($locatariosUsuarios as $loc) {
                                switch ($loc->tipoUsuarioID) {
                                    case 0:
                                        $tipo = 'Admin';
                                        break;
                                    case 1:
                                        $tipo = 'NNN';
                                    default:
                                        $tipo = 'Admin';
                                        break;
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
                                    <td class="text-center"><?=$loc->usuarioLocatarioID;?></td>
                                    <td><?=$loc->nome;?></td>
                                    <td><?=$loc->email;?></td>
                                    <td class="text-center"><?=$tipo;?></td>
                                    <td class="text-center">
                                        <span class="text-<?=$tipoStatus;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'sistema/locatariosUsuarios/editar/' . $loc->usuarioLocatarioID;?>" alt="Editar usuário" title="Editar usuário">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?=base_url() . 'sistema/locatariosUsuarios/editarStatus/' . $locatario->locatarioID . '/' . $loc->usuarioLocatarioID . '/' . $acaoStatus;?>" alt="Mudar Status" title="Mudar Status">
                                                <i class="fa fa-refresh fa-fw"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?=base_url() . 'sistema/locatariosUsuarios/excluir/' . $locatario->locatarioID . '/' . $loc->usuarioLocatarioID;?>" alt="Excluir usuário" title="Excluir usuário">
                                                <i class="fa fa-times fa-fw"></i>
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
                    <h4>Nenhum usuário cadastrado ainda!</h4>
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
           <a href="<?=base_url() . 'sistema/locatariosUsuarios/cadastrar/' . $locatario->locatarioID;?>" type="button" class="btn btn-primary">Cadastrar usuário</a>
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