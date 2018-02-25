<?php
	// Error Reporting
	ini_set('display_error', 'On');
	error_reporting(E_ALL);
	
	//Connection & Configration
	include 'config.php';

	// Check if there is Session
	$sessionUser = '';
	if (isset($_SESSION['normaluser'])) {
		$sessionUser = $_SESSION['normaluser'];
	}

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