<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Importação de arquivos</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Importações
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tecnometal" data-toggle="tab">Tecnometal</a>
                        </li>
                        <li><a href="#tekla" data-toggle="tab">Tekla</a>
                        </li>
                        <li><a href="#cadem" data-toggle="tab">ST_CadEM</a>
                        </li>
                        <li><a href="#manual" data-toggle="tab">Manual</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tecnometal">
                            <br />
                            <h4>Importação de arquivos padrão Tecnometal</h4>
                            <br />
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post" action="<?=base_url() . 'saas/importacoes/gravar';?>" enctype="multipart/form-data" id='dbftogo'>
                                        <div class="form-group">
                                            <label>Arquivo DBF</label>
                                            <input type="file" name="files[]" accept=".DBF,.dbf" id='dbfile'/>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Arquivo DAT</label>
                                            <input type="file" name="files[]" />
                                        </div> -->
                                        <div class="form-group">
                                            <label>Arquivo IFC</label>
                                            <input type="file" name="files[]" accept=".ifc" id='ifcile'/>
                                        </div>
                                        <div class="form-group">
                                            <label>Arquivo FBX</label>
                                            <input type="file" name="files[]" accept=".fbx" id='fbxile'/>
                                        </div>
                                        <div class="form-group">
                                            <label>Observações</label>
                                            <textarea name="observacoes" class="form-control" rows="3"></textarea>
                                        </div>
                                        <?php $toDisable = (count($importacoes) == 0) ? '' : 'disabled'; ?>
                                        <div class="form-group">
                                            <label>Sentido</label> <br>
                                            <input type="radio" name='sentido' <?php if($importacoes[0]->sentido == 1 || count($importacoes) == 0) echo ' checked ' ?> <?= $toDisable ?> value='1'> X / Y &nbsp; &nbsp;
                                            <input type="radio" name='sentido' <?php if($importacoes[0]->sentido == 2 && count($importacoes) != 0) echo ' checked ' ?> <?= $toDisable ?> value='2'> -X / Y &nbsp; &nbsp;
                                            <input type="radio" name='sentido' <?php if($importacoes[0]->sentido == 3 && count($importacoes) != 0) echo ' checked ' ?> <?= $toDisable ?> value='3'> -X- / Y &nbsp; &nbsp;
                                            <input type="radio" name='sentido' <?php if($importacoes[0]->sentido == 4 && count($importacoes) != 0) echo ' checked ' ?> <?= $toDisable ?> value='4'> X / -Y &nbsp; &nbsp;
                                        </div>
                                        <input type="hidden" name="subetapaID" value="<?=$dados->subetapaID;?>">
                                        <button type="submit" class="btn btn-primary btn-block" id="subImport"><i class="fa fa-cloud-upload"></i> Importar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tekla">
                            <br />
                            <h4>Importação de arquivos padrão Tekla</h4>
                            <p>&nbsp;</p>
                            <h3>Em construção</h3>
                        </div>
                        <div class="tab-pane fade" id="cadem">
                            <br />
                            <h4>Importação de arquivos padrão ST_CadEM</h4>
                            <p>&nbsp;</p>
                            <h3>Em construção</h3>
                        </div>
                        <div class="tab-pane fade" id="manual">
                            <br />
                            <h4>Importação de arquivos Manual</h4>
                            <p>&nbsp;</p>
                            <h3>Em construção</h3>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
        
        <div class="col-lg-6 hidden" id="tipoLoading" style="margin-top:20px;background:rgba(0,0,0,0)">
              <img style="width:10%;margin-left:45%;padding-bottom:10px"src="<?=base_url('assets/img/ajax-loader.gif');?>">
              <h4 style='padding-bottom:15px' class='text-center'>Aguarde enquanto processamos sua importação. Isto pode demorar alguns instantes...</h4>
        </div>

        <div class="col-lg-6">
            <?php
            if(!empty($this->session->flashdata('danger'))){
                ?>
            <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('danger'); ?></p>
                </div>
            </div>
            <?php
                }elseif(!empty($this->session->flashdata('success'))){
            ?>
                <div class="panel panel-success">
                <div class="panel-heading">
                    Sucesso!
                </div>
                <div class="panel-body">
                    <p><?= $this->session->flashdata('success'); ?></p>
                </div>
                </div>
            <?php

                }elseif(!empty($this->session->flashdata('todelete'))){
                    list($delName, $delID) = explode('&xx&',$this->session->flashdata('todelete'));
                ?>
             <div class="panel panel-yellow" id="rusure">
                <div class="panel-heading">
                    Realmente Deseja deletar a importação <strong><?= $delName ?></strong>?
                </div>
                <div class="panel-body">
                    <p>Saiba que ao deletar uma importação todas informações e arquivos ligadas a ela serão deletados completamente do sistema. <br />
                        <br>Continuar? </p>
                    <div style="text-align:center;font-size:20px;margin-bottom:none;padding-bottom:none">
                        <a href="<?= base_url()."saas/importacoes/excluirdbf/".$delID ?>" style="color:green">SIM</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="<?= base_url()."saas/importacoes/listar/".$importacoes[0]->subetapaID; ?>" style="color:red">NÃO</a>
                    </div>
                </div>
            </div>
            <?php }elseif(!empty($this->session->flashdata('copy'))){ 
            ?>
                <div class="panel panel-danger">
                <div class="panel-heading">
                    Erro ao Importar Banco
                </div>
                <div class="panel-body">
                    <p>O(s) seguinte(s) conjunto(s): <br><br><strong>
                    <?php 
                        foreach($this->session->flashdata('copy') as $copy){
                            list($mark, $x, $y, $z) = explode('&', $copy);
                            $x = empty($x) ? 0 : $x;
                            $y = empty($y) ? 0 : $y;
                            $z = empty($z) ? 0 : $z;
                            echo $mark.' - X:'.$x.' - Y:'.$y.' - Z:'.$z.'<br>';
                        }
                    ?>
                    </strong>
                    <br> Ja estão cadastrado(s) no sistema. <br><strong> Importação não realizada.</strong>
                    </p>

                </div>
            </div>
            <?php } ?>
            <?php if(!empty($importacoes)) { ?>
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Arquivos Importados
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <?php
                    $nrdDone = array();
                    $nrArqui = 1;
                    foreach ($importacoes as $importacao) {
                        if ($nrArqui < $importacao->importacaoNr) {
                            echo '<hr />';
                            $nrArqui++;
                        }
                       if(!in_array($importacao->importacaoNr, $nrdDone)){
                        ?>
                        <a href="<?= base_url()."saas/importacoes/todeletedbf/".$importacao->importacaoID?>" title="Excluir Importação" style="color:red;float:right;margin-right:20px"><i class="fa fa-trash-o fa-2x"></i></a>
                        
                        <?php
                        if(!empty($importacao->observacoes))
                          echo  "<p style='font-size:14px;padding-right:60px;padding-bottom:20px'>&nbsp;".$importacao->observacoes."</p>";
                        $nrdDone[] = $importacao->importacaoNr;
                       }
                    ?>
                    <p align="left"><i class="fa fa-file-code-o fa-2x"></i> &nbsp;&nbsp; <strong><a href="<?=base_url() . 'arquivos/' . $importacao->locatarioID . '/' . $importacao->clienteID . '/' . $importacao->obraID . '/' . $importacao->etapaID . '/' . $importacao->subetapaID . '/' . $importacao->importacaoNr . '/' . $importacao->arquivo;?>" target="_blank"><?=$importacao->arquivo;?></a></strong> - <?=$importacao->importacaoNr;?>ª importação
                    </p>
                    <?php
                    }
                    ?>
                </div>
                <!-- /.panel-body -->
            </div>
            <?php } ?>
        </div>
        
    </div>
    <a href="<?=base_url() . 'saas/subetapa/listar/' . $dados->obraID . '/' . $dados->etapaID;?>" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>