<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Cadastro de Locatário</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Cadastrar locatário
                </div>
                <div class="panel-body">
                    <div class="row">

                        <?php
                        if (isset($edicao)) {
                            $name = 'form-locatario-edita';
                        } else {
                            $name = 'form-locatario';
                        }

                        ?>
                        <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Razão Social:</label>
                                    <input class="form-control" name="razao" id="razao" <?php if (isset($edicao)) echo 'value="' . $locatario->razao . '"' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Nome Fantasia:</label>
                                    <input class="form-control" name="fantasia" id="fantasia" <?php if (isset($edicao)) echo 'value="' . $locatario->fantasia . '"' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" name="email" id="email" <?php if (isset($edicao)) echo 'value="' . $locatario->email . '"' ?>>
                                </div>
                                 <div class="form-group">
                                    <label>Tipo de Locatário:</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                        <option value="0">Físico</option>
                                        <option value="1">Jurídico</option>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Documento:</label>
                                    <input class="form-control documento" name="documento" id="documento"  <?php if (isset($edicao)) echo 'value="' . $locatario->documento . '"' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Inscrição Estadual:</label>
                                    <input class="form-control" name="inscricao" id="inscricao"  <?php if (isset($edicao)) echo 'value="' . $locatario->inscricao . '"' ?>>
                                </div>
                                 <div class="form-group">
                                    <label>Telefone:</label>
                                    <input class="form-control telefone" name="telefone" id="telefone" <?php if (isset($edicao)) echo 'value="' . $locatario->fone . '"' ?>>
                                </div>
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="estado">Seu Estado</label>
                                    <select class="form-control" id="estado" name="estado"  onchange='search_cities($(this).val())'>
                                        <option>Selecione...</option>
                                         <?php
                                            foreach ($estados as $estado) {
                                        ?>
                                        <option value="<?= $estado->estadoID; ?>"><?= $estado->nome . ' - ' . $estado->uf; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="cidade">Sua Cidade</label>
                                     <select class="form-control" id="cidade" name="cidade">
                                        <option>Selecione o Estado...</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Endereço:</label>
                                    <input class="form-control" name="endereco" id="endereco" <?php if (isset($edicao)) echo 'value="' . $locatario->endereco . '"' ?>>
                                </div>

                                <div class="form-group">
                                    <label>CEP:</label>
                                    <input class="form-control cep" name="cep" id="cep" <?php if (isset($edicao)) echo 'value="' . $locatario->cep . '"' ?>>
                                </div>

                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="locatarioID" id="locatarioID" value="<?=$locatarioID;?>">
                                <?php } ?>

                                <button type="submit" class="btn btn-primary btn-block">Gravar</button>

                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </form>
                    </div>
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-4 -->
        <div class="col-lg-4 hidden" id="tipoSuccess">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>O locatário foi gravado com sucesso e já pode ser utilizado!</p>
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
                    <p>O locatário não pôde ser gravado, tente novamente mais tarde!</p>
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
                    <p>O locatário não pôde ser gravado, veja se já não está cadastrado!</p>
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