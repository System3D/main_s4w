<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Dashboard Saas</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-users fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $retVal = (isset($qtdClientes)) ? $qtdClientes : 0;?></div>
                            <div>Clientes cadastrados</div>
                        </div>
                    </div>
                </div>
                <div class="panel-list">
                     <?php
                    if(!empty($clientes)){
                      foreach ($clientes as $cliente) {  ?>
                     <a href="<?=base_url() . 'saas/clientes/ver/' . $cliente->clienteID;?>"><?=$cliente->razao;?></a>
                     <?php }
                     }else{
                        echo "<span>Nenhum Cliente Cadastrado.</span>";
                     } ?>
                </div>
                <a href="<?=base_url('saas/clientes/listar');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-building-o fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $retVal = (isset($qtdObras)) ? $qtdObras : 0;?></div>
                            <div>Obras cadastradas</div>
                        </div>
                    </div>
                </div>
                <div class="panel-list">
                     <?php
                    if(!empty($obras)){
                      foreach ($obras as $obra) {  ?>
                     <a href="<?=base_url() . 'saas/obras/ver/' . $obra->obraID?>"><?=$obra->nomeObra;?></a>
                     <?php }
                     }else{
                        echo "<span>Nenhuma Obra Cadastrada.</span>";
                     } ?>
                </div>
                <a href="<?=base_url('saas/obras/listar');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todas</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
         <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $retVal = (isset($qtdUsers)) ? $qtdUsers : 0;?></div>
                            <div>Usuarios Cadastrados</div>
                        </div>
                    </div>
                </div>
                <div class="panel-list">
                     <?php
                    if(!empty($users)){
                      foreach ($users as $user) {  ?>
                    <a href= "<?= base_url() . 'saas/usuarios/ver/' . $user->usuarioLocatarioID;?>"><?=$user->nome;?></a>
                     <?php }
                     }else{
                        echo "<span>Nenhum Usuario Cadastrado.</span>";
                     } ?>
                </div>
                <a href="<?=base_url('saas/usuarios/listar');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todos</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-upload fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $retVal = (isset($qtdImport)) ? $qtdImport : 0;?></div>
                            <div>Importações Cadastradas</div>
                        </div>
                    </div>
                </div>
                 <div class="panel-list">
                     <?php
                    if(!empty($imports)){
                      foreach ($imports as $import) {  ?>
                    <a href= "<?=base_url('').'saas/importacoes/listar/'.$import->subetapaID;?>"><?=$import->arquivo;?></a>
                     <?php }
                     }else{
                        echo "<span>Nenhuma Importação Cadastrada.</span>";
                     } ?>
                </div>
                <a href="<?=base_url('saas/importacoes/listar');?>">
                    <div class="panel-footer">
                        <span class="pull-left">Ver todas</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>