<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Conjuntos</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Apontador de Lotes
                </div>
                <?php 
                if (!empty($conjuntos)) { ?>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <nav class="navbar navbar-static-top" role="navigation">
                        <form method="POST" action="http://steel4web.com.br/dev/gestor-de-lotes/public/lotes" accept-charset="UTF-8" class="form-inline" role="form" id="createLoteForm">
        <div class="navbar-form navbar-left">
            <div class="form-group">
                <label class="" for="">Obra: </label>
                <select id="inputObra" class="form-control" required="required" name="obra">
                    <option>Escolha Uma Obra</option>
                    <?php foreach ($obras as $obra) { ; ?>
                    <option value="<?= $obra->obraID ?>"><?= $obra->nome ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group inputetapa hidden">
                <label class="" for=""> Etapa: </label>
                <select id="inputEtapa" class="form-control" required="required" name="etapa">
                </select>
            </div>
            <div class="form-group inputlote hidden">
                <label class="" for=""> Lote: </label>
                <select id="inputEtapa" class="form-control" required="required" name="etapa">
                </select>
            </div>
            <div class="form-group">
                <div class="loading hidden"></div>
            </div>
        </div>
        </form>

                    </nav>
               <!--     <button id="formButton">Enviar</button> -->
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered  dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="lotPointer">
                            <thead>
                                <tr>
                                    <th>Cod</th>
                                    <th>Lote</th>
                                    <th>Conjunto</th>
                                    <th>Desenho</th>
                                    <th>Qtd.</th>
                                    <th>Descricao</th>
                                    <th>Tratamento</th>

                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($conjuntos as $im) {
                             ?>
                                
                                <tr>
                                    <td><a href="#" class="username" data-type="text" data-name='user' data-pk="1" data-title="Enter username">superuser</a></td>
                                    <td>
                                        <a href="#" class="dob" data-type="combodate" data-pk="1" data-value="2015-05-15" data-title="Select date"></a>
                                    </td>
                                    <td><a href="<?=base_url() . 'saas/estagio/voltar/' . $im->MAR_PEZ?>">VOLTAR</a> </td>
                                    <td><a href="<?=base_url() . 'saas/estagio/avancar/' . $im->MAR_PEZ?>">AVANCAR</a></td>
                                    <td><input type="date" id="row-1-age" name="row-1-age" style='line-height:15px' value='<?= date("Y-m-j") ?>'></td>
                                    <td><input type="text" id="row-1-position" name="row-1-position" value="System Architect"></td>
                                    <td><select size="1" id="row-1-office" name="row-1-office">
                    <option value="Edinburgh" selected="selected">
                        Edinburgh
                    </option>
                    <option value="London">
                        London
                    </option>
                    <option value="New York">
                        New York
                    </option>
                    <option value="San Francisco">
                        San Francisco
                    </option>
                    <option value="Tokyo">
                        Tokyo
                    </option>
                </select></td>
                                </tr>
                                <?php
                                 } ?>
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
        <!-- /.col-lg-12 -->
        <div class="col-lg-6 col-md-6">
            <a href="javascript:history.back()" type="button" class="btn btn-default"><< Voltar</a>
        </div>
        <div class="col-lg-6 col-md-6 text-right">
           <a href="<?=base_url('saas/obras/cadastrar/');?>" type="button" class="btn btn-primary">Cadastrar Obra</a>
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