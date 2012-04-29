<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title><?php echo $title; ?></title>
<link href="<?php echo base_url()?>assets/jquery-ui-1.8.18.custom/css/custom-theme/jquery-ui-1.8.19.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/page_garde.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/apps.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/fiche.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url()?>assets/js/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/jquery-ui-1.8.18.custom/js/jquery-ui-1.8.19.custom.min.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/utilitaires.js" tyoe="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/notifier.min.js" type="text/javascript"></script>

</head>

<body>
<div id="background"></div>
<div id="apps_mini">
	<div class='bouton_app'><a href="/index.php"><img src="<?php echo base_url()?>assets/imgs/home.png" /></a></div>
    <div class='bouton_app'><a href="/index.php/pages/view_profil"><img src="<?php echo base_url()?>assets/imgs/profile.png" /></a></div>
    <div class='bouton_app'><a href="/index.php/etablissement/view"><img src="<?php echo base_url()?>assets/imgs/etab.png" /></a></div>
    <div class='bouton_app'><a href="/index.php/commandes/view" ><img src="<?php echo base_url()?>assets/imgs/cmd.png" /></a></div> <!-- peut etre pas necessaire -->
    <div id="mini_product" class='bouton_app'><a href="/index.php/pages/ajouter_produit"><img src="<?php echo base_url()?>assets/imgs/add_product.png" /></a></div> <!-- caché par défaut -->
    <div id="mini_news" class='bouton_app'><a href="/index.php/pages/ajouter_news"><img src="<?php echo base_url()?>assets/imgs/news.png" /></a></div> <!-- caché par défaut -->
    <div class='bouton_app'><a href="/index.php/users/logout"><img src="<?php echo base_url()?>assets/imgs/exit.png" /></a></div>
</div>
<div id="page">

