<!DOCTYPE html>
<html lang="pt-BR">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Vitor Henckel">
    <link rel="icon" type="image/ico" href="<?=base_url();?>assets/img/steel4web.ico">
    <title><?=$titulo;?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?=base_url();?>assets/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="<?=base_url();?>assets/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <!-- DataTables Responsive CSS -->
    <link href="<?=base_url();?>assets/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <?php if (isset($timeline) && $timeline == 1) { ?>
    <!-- Timeline CSS -->
    <link href="<?=base_url();?>assets/dist/css/timeline.css" rel="stylesheet">
    <?php } ?>
    <!-- Custom CSS -->
    <link href="<?=base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">
     <?php if (isset($grafico) && $grafico == 1) { ?>
    <!-- Morris Charts CSS -->
    <link href="<?=base_url();?>assets/bower_components/morrisjs/morris.css" rel="stylesheet">
    <?php } ?>
    <!-- Custom Fonts -->
    <link href="<?=base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">