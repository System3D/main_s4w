<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Usuários Admin</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de administradores
                </div>
                <?php if (!empty($admins)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($admins as $admin) {
                                if ($admin->status == 0) {
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
                                    <td class="text-center"><?=$admin->usuarioAdminID;?></td>
                                    <td><?=$admin->nome;?></td>
                                    <td><?=$admin->email;?></td>
                                    <td class="text-center">
                                        <span class="text-<?=$tipoStatus;?>">
                                            <?=$status;?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'sistema/usuarios/editar/' . $admin->usuarioAdminID;?>" alt="Editar usuário" title="Editar usuário">
                                                <i class="fa fa-edit fa-fw"></i>
                                            </a>
                                            &nbsp;
                                            <a href="<?=base_url() . 'sistema/usuarios/editarStatus/' . $admin->usuarioAdminID . '/' . $acaoStatus;?>" alt="Mudar Status" title="Mudar Status">
                                                <i class="fa fa-refresh fa-fw"></i>
                                            </a>
                                             &nbsp;
                                            <a href="<?=base_url() . 'sistema/usuarios/excluir/' . $admin->usuarioAdminID;?>" alt="Excluir usuário" title="Excluir usuário">
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
        <div class="col-lg-6">
            <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
        </div>
        <div class="col-lg-6 text-right">
           <a href="<?=base_url() . 'sistema/usuarios/cadastrar/';?>" type="button" class="btn btn-primary">Cadastrar usuário</a>
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