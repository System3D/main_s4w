<?php
if (isset($edicao)) {
    $name = 'form-parceiro-edita';
    $tipo = 'Editar';
} else {
    $name = 'form-parceiro';
    $tipo = 'Cadastrar';
}
if(isset($disable)){
    $tipo = 'Perfil';
    $name = '';
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?=$tipo;?> de Contato</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$tipo;?> de contato
                </div>
                <div class="panel-body">
                    <div class="row">
                         <div class="col-lg-6">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Razão Social:</label>
                                    <input class="form-control" name="razao" id="razao" <?php if (isset($edicao)) echo 'value="' . $parceiro->razao . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <div class="form-group">
                                    <label>Nome Fantasia:</label>
                                    <input class="form-control" name="fantasia" id="fantasia" <?php if (isset($edicao)) echo 'value="' . $parceiro->fantasia . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" name="email" id="email" <?php if (isset($edicao)) echo 'value="' . $parceiro->email . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                 <div class="form-group">
                                    <label>Tipo de Cliente:</label>
                                    <select class="form-control" name="tipo" id="tipo" <?php if (isset($disable)) echo 'disabled'; ?>>
                                        <option value="0" <?php if(isset($edicao) && $parceiro->tipo == 0) echo 'selected'; ?>>Físico</option>
                                        <option value="1" <?php if(isset($edicao) && $parceiro->tipo == 1) echo 'selected'; ?>>Jurídico</option>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Documento:</label>
                                    <input class="form-control documento" name="documento" id="documento"  <?php if (isset($edicao)) echo 'value="' . $parceiro->documento . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <div class="form-group">
                                    <label>Inscrição Estadual:</label>
                                    <input class="form-control" name="inscricao" id="inscricao"  <?php if (isset($edicao)) echo 'value="' . $parceiro->inscricao . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                 <div class="form-group">
                                    <label>Telefone:</label>
                                    <input class="form-control telefone" name="telefone" id="telefone" <?php if (isset($edicao)) echo 'value="' . $parceiro->fone . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="estado">Seu Estado</label>
                                    <select class="form-control" id="estado" name="estado"  onchange='search_cities($(this).val())' <?php if (isset($disable)) echo 'disabled'; ?>>
                                        <option>Selecione...</option>
                                         <?php
                                            foreach ($estados as $estado) {
                                        ?>
                                        <option value="<?= $estado->estadoID; ?>" <?php if (isset($edicao) && $estadoDados->estadoID == $estado->estadoID) echo 'selected'; ?>><?= $estado->nome . ' - ' . $estado->uf; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cidade">Sua Cidade</label>
                                     <select class="form-control" id="cidade" name="cidade" <?php if (isset($disable)) echo 'disabled'; ?>>
                                        <?php if (isset($edicao) && isset($cidadeDados)){ ?>
                                        <option value="<?= $cidadeDados->cidadeID; ?>" <?php if (isset($edicao)) echo 'selected'; ?>><?= $cidadeDados->nome; ?></option>
                                        <?php } else { ?>
                                        <option>Selecione o Estado...</option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Endereço:</label>
                                    <input class="form-control" name="endereco" id="endereco" <?php if (isset($edicao)) echo 'value="' . $parceiro->endereco . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>

                                <div class="form-group">
                                    <label>CEP:</label>
                                    <input class="form-control cep" name="cep" id="cep" <?php if (isset($edicao)) echo 'value="' . $parceiro->cep . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <div class="form-group">
                                    <label>Tipo de Empresa</label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="construtora" id="construtora" <?php if(isset($edicao) && $parceiro->construtora == 1) echo 'checked'; ?> <?php if (isset($disable)) echo 'disabled'; ?>>Construtora
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="gerenciadora" id="gerenciadora" <?php if(isset($edicao) && $parceiro->gerenciadora == 1) echo 'checked'; ?> <?php if (isset($disable)) echo 'disabled'; ?>>Gerenciadora
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="calculista" id="calculista" <?php if(isset($edicao) && $parceiro->calculista == 1) echo 'checked'; ?> <?php if (isset($disable)) echo 'disabled'; ?>>Calculista
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="detalhamento" id="detalhamento" <?php if(isset($edicao) && $parceiro->detalhamento == 1) echo 'checked'; ?> <?php if (isset($disable)) echo 'disabled'; ?>>Detalhamento
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="montagem" id="montagem" <?php if(isset($edicao) && $parceiro->montagem == 1) echo 'checked'; ?> <?php if (isset($disable)) echo 'disabled'; ?>>Montagem
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Outro</label>
                                    <input class="form-control" name="outro" id="outro" <?php if (isset($edicao)) echo 'value="' . $parceiro->outro . '"' ?> <?php if (isset($disable)) echo 'disabled'; ?>>
                                </div>
                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="clienteID" id="clienteID" value="<?=$clienteID;?>">
                                <?php } ?>
                                <?php if (isset($disable)) { ?>
                                <a href="<?=base_url() . 'saas/contatos/editar/' . $clienteID?>" type="button" class="btn btn-primary btn-block">Editar</a>
                                <?php } else { ?>
                                <button type="submit" class="btn btn-primary btn-block">Gravar</button>
                                <?php } ?>

                            </form>
                        </div>
                        <!-- /.col-lg-12 (nested) -->
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
        </div>s
        <div class="col-lg-4 hidden" id="tipoSuccess">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>O contato foi gravado com sucesso e já pode ser utilizado!</p>
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
                    <p>O contato não pôde ser gravado, tente novamente mais tarde!</p>
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
                    <p>O contato não pôde ser gravado, possivelmente já existe!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>
<script type="text/javascript" src="<?=base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script type="text/javascript">
   function search_cities(estadoID){
        $.post("<?=base_url();?>service/enderecos/cidades", {
            estadoID : estadoID
        }, function(data){
            $('#cidade').html(data);
        });
    };
</script>