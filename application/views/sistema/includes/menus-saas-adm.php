<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=base_url('saas/admin')?>">
            <img src="<?=base_url('assets/img/logo-Steel4web.png');?>" alt="Stell4Web">
        </a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <?php
            if(!empty($this->session->flashdata('toConvert'))){
                echo "<p id='needToConvert' class='hidden'>".$this->session->flashdata('toConvert')."</p>";

            }
            if($this->session->userdata('converting') == 'converting'){
        ?>
            <div class='panel panel-primary' style='display:inline-block !important;padding:10px;margin-bottom:0'>
                <img style="width:5%;height:80;margin-bottom: 2px;padding-right:5px;float:left"src="<?=base_url('assets/img/ajax-loader.gif');?>">
                Executando Conversão de arquivo ifc. <span style='color:#A92E2E'><strong>Não Saia Desta Página!</strong></span></div>
        <?php
            }elseif($this->session->userdata('converting') == 'success'){
                $this->session->set_userdata('converting', false);
        ?>
        <div class='panel panel-success' id='convertSuccess' style='display:inline-block !important;padding:10px;margin-bottom:0'><i style='color:green' class="fa fa-check"></i>&ensp;Conversão realizada com sucesso &ensp;&ensp;&ensp; <span id='xsuccess' style='margin-left:10px;padding:1px 3px '><i class="fa fa-times-circle"></i></span>&ensp;</div>
        <?php
            }elseif($this->session->userdata('converting') == 'error'){
                $this->session->set_userdata('converting', false);
        ?>
        <div class='panel panel-danger' style='display:inline-block !important;padding:10px;margin-bottom:0' id='convertError'><i style='color:red' class="fa fa-exclamation-triangle"></i>&ensp;Falha na Conversão. &ensp;&ensp;&ensp;<span id='xerro' style='margin-left:10px;padding:1px 3px '><i class="fa fa-times-circle"></i></span>&ensp;</div>
        <?php
            }
        ?>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php
                    $nomeUsuario = $this->session->userdata('nomeUsuario');
                    echo $nomeUsuario;
                ?>
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?=base_url('saas/profile/ver');?>"><i class="fa fa-user fa-fw"></i> Perfil do usuário</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configurações</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?=base_url('logout');?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="<?=base_url('saas/admin');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?=base_url('saas/clientes/listar');?>"><i class="fa fa-users fa-fw"></i> Clientes</a>
                </li>
                <li>
                    <a href="<?=base_url('saas/obras/listar');?>"><i class="fa fa-building-o fa-fw"></i> Obras</a>
                </li>
                <li>
                    <a href="<?=base_url('saas/contatos/listar');?>"><i class="fa fa-phone fa-fw"></i> Contatos</a>
                </li>
                <li>
                    <a href="<?=base_url('saas/usuarios/listar');?>"><i class="fa fa-user fa-fw"></i> Usuários</a>
                </li>
                <li>
                    <a href="http://steel4web.com.br/dev/gestor-de-lotes/public/lotes"><i class="fa fa-home fa-fw"></i> Gestor de Lotes</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-print fa-fw"></i> Relatórios</a>
                </li>
                <?php if($this->session->userdata('tipoUsuarioID') == 1){ ?>
                <li>
                    <a href="<?=base_url('saas/logs/listar');?>"><i class="fa fa-eye fa-fw"></i> Logs</a>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>