<?php
    if (isset($edicao)) {
        $name = 'form-admin-edita';
        $title = 'Edição';
    } else {
        $name = 'form-admin';
        $title = 'Cadastro';
    }
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><?=$title;?> de Usuário</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?=$title;?> de usuário
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" name="<?=$name;?>" id="<?=$name;?>" accept-charset="utf-8">
                                <div class="form-group">
                                    <label>Nome:</label>
                                    <input class="form-control" name="nome" id="nome" <?php if (isset($edicao)) echo 'value="' . $usuario->nome . '"' ?>>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input class="form-control" name="email" id="email" <?php if (isset($edicao)) echo 'value="' . $usuario->email . '"' ?>>
                                </div>
                                 <div class="form-group">
                                    <label>Senha:</label>
                                    <input class="form-control" name="senha" id="senha" value="">
                                </div>

                                <?php if (isset($edicao)) { ?>
                                <input type="hidden" name="usuarioAdminID" id="usuarioAdminID" value="<?=$usuario->usuarioAdminID;?>">
                                <?php } ?>

                                <button type="submit" class="btn btn-primary btn-block">Gravar</button>

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
        <div class="col-lg-6 hidden" id="tipoSuccess">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Gravado com sucesso!
                </div>
                <div class="panel-body">
                    <p>O usuário foi gravado com sucesso e já pode ser utilizado!</p>
                </div>
             </div>
            <!-- /.panel -->
        </div>
        <div class="col-lg-6 hidden" id="tipoError">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>O usuário não pôde ser gravado, tente novamente mais tarde!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
        <div class="col-lg-6 hidden" id="tipoError2">
            <div class="panel panel-red">
                <div class="panel-heading">
                    Erro ao gravar!
                </div>
                <div class="panel-body">
                    <p>O usuário não pôde ser gravado, veja se o email já não existe!</p>
                </div>
            </div>
            <!-- /.col-lg-4 -->
        </div>
    </div>
    <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
    <!-- /.row -->
    <br /><hr /><br />
</div>