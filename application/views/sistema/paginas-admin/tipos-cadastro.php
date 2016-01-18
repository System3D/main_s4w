<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Cadastro de Tipos de Clientes</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tipos de Clientes
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php
                            if (isset($edicao)) {
                                $name = 'form-tipo-edita';
                            } else {
                                $name = 'form-tipo';
                            }

                            ?>
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8" method="" action="">
                                <div class="form-group">
                                    <label>Tipo do cliente:</label>
                                    <input class="form-control" name="tipo-cliente" id="tipo-cliente" <?php if (isset($edicao)) echo 'value="' . $tipoCliente->nome . '"' ?>>
                                    <?php if (isset($edicao)) { ?>
                                    <input type="hidden" name="idtipo-cliente" id="idtipo-cliente" value="<?=$tipoClienteID;?>">
                                    <?php } ?>
                                </div>
                                <button type="submit" class="btn btn-default">Gravar</button>
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
        <div class="col-lg-4 hidden" id="tipoSuccess">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>Tipo de cliente foi gravado com sucesso e já pode ser utilizado!</p>
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
                    <p>O tipo de cliente não pôde ser gravado, tente novamente mais tarde!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <!-- /.row -->
</div>