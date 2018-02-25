<?php
	//Connection & Configration
	include 'config.php';

	//Routes
	$tpl	= 'includes/tpls/'; //Templets Directory
	$lang	= 'includes/langs/';//Languages Directory
	$func	= 'includes/func/';//Functions Directory
	$css	= 'layout/css/'; //CSS Directory
	$js 	= 'layout/js/'; //JavaScript Directory
	

	//Include the files
	include $func . 'functions.php';
	include $lang . 'en.php'; 
	include $tpl . 'header.php';

	//Include The Navbar on pages without noNavbar variable
	if(!isset($noNavbar)){include $tpl . 'navbar.php';}