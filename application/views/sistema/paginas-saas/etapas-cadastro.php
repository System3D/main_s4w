<?php
if (isset($edicao)) {
    $name  = 'form-etapa-edita';
    $title = 'Edição';
} else {
    $name = 'form-etapa';
    $title = 'Cadastro';
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?=$title;?> de etapa</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title;?> de etapa
                </div>
                <div class="panel-body">
                    <div class="row">
                         <div class="col-lg-12">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Código da Etapa:</label>
                                    <input class="form-control" name="codigoEtapa" id="codigoEtapa" <?php if (isset($edicao)) echo 'value="' . $etapa->codigoEtapa . '"' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Peso:</label>
                                    <input class="form-control" name="peso" id="peso" <?php if (isset($edicao)) echo 'value="' . $etapa->peso . '"' ?>>
                                </div>

                                <div class="form-group">
                                    <label>Detalhes da etapa</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="estruturaPrincipal" id="estruturaPrincipal" <?php if(isset($edicao) && $etapa->estruturaPrincipal == 1) echo 'checked'; ?>>Estrutura Principal
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="estruturaSecundaria" id="estruturaSecundaria" <?php if(isset($edicao) && $etapa->estruturaSecundaria == 1) echo 'checked'; ?>>Estrutura Secundária
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="telhasCobertura" id="telhasCobertura" <?php if(isset($edicao) && $etapa->telhasCobertura == 1) echo 'checked'; ?>>Telhas de cobertura
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="telhasFechamento" id="telhasFechamento" <?php if(isset($edicao) && $etapa->telhasFechamento == 1) echo 'checked'; ?>>Telhas de fechamento
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="calhas" id="calhas" <?php if(isset($edicao) && $etapa->calhas == 1) echo 'checked'; ?>>Calhas
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="rufosArremates" id="rufosArremates" <?php if(isset($edicao) && $etapa->rufosArremates == 1) echo 'checked'; ?>>Rufos e Arremates
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="steelDeck" id="steelDeck" <?php if(isset($edicao) && $etapa->steelDeck == 1) echo 'checked'; ?>>SteelDeck
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="gradesPiso" id="gradesPiso" <?php if(isset($edicao) && $etapa->gradesPiso == 1) echo 'checked'; ?>>Grades e Piso
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="escadas" id="escadas" <?php if(isset($edicao) && $etapa->escadas == 1) echo 'checked'; ?>>Escadas
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="corrimao" id="corrimao" <?php if(isset($edicao) && $etapa->corrimao == 1) echo 'checked'; ?>>Corrimão
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Outro:</label>
                                    <input class="form-control" name="outro" id="outro" <?php if (isset($edicao)) echo 'value="' . $etapa->outro . '"' ?>>
                                </div>

                                <div class="form-group">
                                    <label>Observação:</label>
                                    <textarea class="form-control" rows="3" id="observacao" name="observacao"><?php if (isset($edicao) && $etapa->observacao != '') echo $etapa->observacao;?></textarea>
                                </div>


                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="etapaID" id="etapaID" value="<?=$etapa->etapaID;?>">
                                <?php } ?>
                                <input type="hidden" name="obraID" id="obraID" value="<?=$obraID;?>">

                                <button type="submit" class="btn btn-primary btn-block">Gravar</button>

                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4 hidden" id="tipoLoading" style="margin-top:20px;background:rgba(0,0,0,0)">
              <img style="width:10%;margin-left:45%"src="<?=base_url('assets/img/ajax-loader.gif');?>">
        </div>
        <div class="col-lg-4 hidden" id="tipoSuccess">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>A etapa foi gravada com sucesso!</p>
                </div>
             </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-4 hidden" id="tipoError">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>A etapa não pôde ser gravado, tente novamente mais tarde!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <div class="col-lg-4 hidden" id="tipoError2">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>A etapa não pôde ser gravado, verifique os dados</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>