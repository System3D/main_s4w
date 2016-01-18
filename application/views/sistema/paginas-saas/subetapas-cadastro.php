<?php
if (isset($edicao)) {
    $name   = 'form-subetapa-edita';
    $action = "gravarEdicao";
    $title  = 'Edição';
} else {
    $name = 'form-subetapa';
    $action = "gravar";
    $title = 'Cadastro';
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?=$title;?> de subetapa</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title;?> de subetapa
                </div>
                <div class="panel-body">
                    <div class="row">
                         <div class="col-lg-12">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8" action="<?=base_url() . 'saas/subetapa/' . $action;?>" method="post">
                                <div class="form-group">
                                    <label>Código da Subetapa:</label>
                                    <input class="form-control" name="codigoSubetapa" id="codigoSubetapa" <?php if (isset($edicao)) echo 'value="' . $subetapa->codigoSubetapa . '"' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Peso:</label>
                                    <input class="form-control" name="peso" id="peso" <?php if (isset($edicao)) echo 'value="' . $subetapa->peso . '"' ?>>
                                </div>

                                <div class="form-group">
                                    <label>Opções da Etapa:</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option>Selecione...</option>

                                        <?php
                                            if(isset($etapa->estruturaPrincipal) && $etapa->estruturaPrincipal == 1) {
                                                echo "<option value='estruturaPrincipal'>Estrutura Principal</option>";
                                            }

                                            if(isset($etapa->estruturaSecundaria) && $etapa->estruturaSecundaria == 1) {
                                                echo "<option value='estruturaSecundaria'>Estrutura Secundária</option>";
                                            }

                                            if(isset($etapa->telhasCobertura) && $etapa->telhasCobertura == 1) {
                                                echo "<option value='telhasCobertura'>Telhas cobertura</option>";
                                            }

                                            if(isset($etapa->telhasFechamento) && $etapa->telhasFechamento == 1) {
                                                echo "<option value='telhasFechamento'>Telhas fechamento</option>";
                                            }

                                            if(isset($etapa->calhas) && $etapa->calhas == 1) {
                                                echo "<option value='calhas'>Calhas</option>";
                                            }

                                            if(isset($etapa->rufosArremates) && $etapa->rufosArremates == 1) {
                                                echo "<option value='rufosArremates'>Rufos arremates</option>";
                                            }

                                            if(isset($etapa->steelDeck) && $etapa->steelDeck == 1) {
                                                echo "<option value='steelDeck'>SteelDeck</option>";
                                            }

                                            if(isset($etapa->gradesPiso) && $etapa->gradesPiso == 1) {
                                                echo "<option value='gradesPiso'>Grades piso</option>";
                                            }

                                            if(isset($etapa->escadas) && $etapa->escadas == 1) {
                                                echo "<option value='escadas'>Escadas</option>";
                                            }

                                            if(isset($etapa->corrimao) && $etapa->corrimao == 1) {
                                                echo "<option value='corrimao'>Corrimão</option>";
                                            }

                                            if(isset($etapa->outro) && $etapa->outro != '') {
                                                echo "<option value='outro'>Outro: {$etapa->outro}</option>";
                                            }

                                         ?>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Observação:</label>
                                    <textarea class="form-control" rows="3" id="observacao" name="observacao"><?php if (isset($edicao) && $subetapa->observacao != '') echo $subetapa->observacao;?></textarea>
                                </div>


                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="subetapaID" id="subetapaID" value="<?=$subetapa->etapaID;?>">
                                <?php } ?>
                                <input type="hidden" name="etapaID" id="etapaID" value="<?=$etapaID;?>">
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
        <?php if(isset($subetapas)){ ?>
        <div class="col-lg-8">
            <div class="row">
                <?php foreach($subetapas as $subetapa){
                       switch ($subetapa->tipo) {
                            case 'estruturaPrincipal':
                               $tipo = 'Estrutura Principal';
                               break;
                            case 'estruturaSecundaria':
                                $tipo = 'Estrutura Secundária';
                                break;
                            case 'telhasCobertura':
                                $tipo = 'Telhas cobertura';
                                break;
                            case 'telhasFechamento':
                                $tipo = 'Telhas fechamento';
                                break;
                            case 'calhas':
                                $tipo = 'Calhas';
                                break;
                            case 'rufosArremates':
                                $tipo = 'Rufos arremates';
                                break;
                            case 'steelDeck':
                                $tipo = 'SteelDeck';
                                break;
                            case 'gradesPiso':
                                $tipo = 'Grades piso';
                                break;
                            case 'escadas':
                                $tipo = 'Escadas';
                                break;
                            case 'corrimao':
                                $tipo = 'Corrimão';
                                break;
                            case 'outro':
                                $tipo = 'Outro';
                                break;
                           default:
                               $tipo = $subetapa->tipo;
                               break;
                       }
                ?>
                <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            Detalhes da Subetapa
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <address>
                                <?php if(isset($subetapa->codigoSubetapa)) echo '<strong>Código: ' . $subetapa->codigoSubetapa . '</strong><br /><br />';?>
                                <?php if(isset($subetapa->peso)) echo 'Peso: ' . peso($subetapa->peso) . '<br />';?>
                                <?php if(isset($subetapa->tipo)) echo 'Tipo: ' . $tipo . '<br />';?>
                                <?php if(isset($subetapa->observacao)) { ?>
                                <br /><strong>Observação:</strong> <br />
                                <em><?=$subetapa->observacao;?></em>
                                <?php } ?>
                            </address>
                            <p class="text-right">
                                <a href="<?=base_url() . 'saas/importacoes/listar/' . $subetapa->subetapaID;?>" type="button"  class="btn btn-info">Importações</a>
                                <a href="<?=base_url() . 'saas/subetapa/excluir/' . $obraID . '/' . $etapa->etapaID . '/' . $subetapa->subetapaID;?>" type="button" onclick="return confirma_exclusao('<?=$subetapa->codigoSubetapa;?>')" class="btn btn-danger">Excluir</a>
                            </p>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            <?php } ?>
            </div>
        </div>
        <?php } ?>
    </div>
    <a href="<?=base_url() . 'saas/obras/ver/' . $obraID;?>" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>
<script>
    function confirma_exclusao(codigoEtapa) {
        if (!confirm("Deseja realmente excluir a subetapa: '" + codigoEtapa + "' ?")) {
            return false;
        }
        return true;
    }
</script>