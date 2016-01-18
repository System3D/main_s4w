<!-- Navigation -->
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=base_url('sistema/dashboard')?>">
            <img src="<?=base_url('assets/img/logo-Steel4web.png');?>" alt="Stell4Web">
        </a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php
                    $nomeUsuario = $this->session->userdata('nomeUsuario');
                    echo $nomeUsuario;
                ?>
                <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil do usuário</a>
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
                    <a href="<?=base_url('sistema/dashboard');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="<?=base_url('sistema/locatarios/listar');?>"><i class="fa fa-users fa-fw"></i> Locatários</a>
                </li>
                <li>
                    <a href="<?=base_url('sistema/usuarios/listar');?>"><i class="fa fa-user fa-fw"></i> Admin</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>