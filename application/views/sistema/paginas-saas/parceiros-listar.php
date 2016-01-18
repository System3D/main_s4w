<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Contatos</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listagem de contatos
                </div>
                <?php if (!empty($parceiros)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="dataTables">
                            <thead>
                                <tr>
                                    <th>Razão Social</th>
                                    <th>Fantasia</th>
                                    <th width="15%">Telefone</th>
                                    <th width="8%" title="Construtora">Cons</th>
                                    <th width="8%" title="Gerenciadora">Ger</th>
                                    <th width="8%" title="Calculista">Calc</th>
                                    <th width="8%" title="Detalhamento">Det</th>
                                    <th width="8%" title="Montagem">Mont</th>
                                    <th width="10%" title="Montagem">Outro</th>
                                    <th width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($parceiros as $parceiros) {
                                if ($parceiros->tipo == 0) {
                                    $tipo = 'Física';
                                } else {
                                    $tipo = 'Jurídico';
                                }
                                ?>
                                <tr class="stripped">
                                <td><a href="<?=base_url() . 'saas/contatos/ver/' . $parceiros->clienteID;;?>"><?=$parceiros->razao;?></a></td>
                                    <td><?=$parceiros->fantasia;?></td>
                                    <td class="telefone"><?=$parceiros->fone;?></td>
                                    <td title="Construtora">
                                        <div class="text-center">
                                            <?=$retVal = ($parceiros->construtora == 1) ? '<i class="fa fa-check fa-fw"></i>' : '<i class="fa fa-times fa-fw"></i>';?>
                                        </div>
                                    </td>
                                    <td title="Gerenciadora">
                                        <div class="text-center">
                                            <?=$retVal = ($parceiros->gerenciadora == 1) ? '<i class="fa fa-check fa-fw"></i>' : '<i class="fa fa-times fa-fw"></i>';?>
                                        </div>
                                    </td>
                                    <td title="Calculista">
                                        <div class="text-center">
                                            <?=$retVal = ($parceiros->calculista == 1) ? '<i class="fa fa-check fa-fw"></i>' : '<i class="fa fa-times fa-fw"></i>';?>
                                        </div>
                                    </td>
                                    <td title="Detalhamento">
                                        <div class="text-center">
                                            <?=$retVal = ($parceiros->detalhamento == 1) ? '<i class="fa fa-check fa-fw"></i>' : '<i class="fa fa-times fa-fw"></i>';?>
                                        </div>
                                    </td>
                                    <td title="Montagem">
                                        <div class="text-center">
                                            <?=$retVal = ($parceiros->montagem == 1) ? '<i class="fa fa-check fa-fw"></i>' : '<i class="fa fa-times fa-fw"></i>';?>
                                        </div>
                                    </td>
                                    <td title="Montagem">
                                        <div class="text-center">
                                            <?=word_limiter($parceiros->outro, 1, '&#8230;');?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <a href="<?=base_url() . 'saas/contatos/editar/' . $parceiros->clienteID;?>" alt="Editar contato" title="Editar contato">
                                                <i class="fa fa-edit fa-fw"></i>
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
        <div class="col-lg-6 col-md-6">
            <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
           <a href="<?=base_url('saas/contatos/cadastrar/');?>" type="button" class="btn btn-primary">Cadastrar Contato</a>
        </div>
        <!-- /.col-lg-12 -->
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