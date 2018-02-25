<?php
	
	session_start(); //Start The Session
	session_unset(); //Unset The Session
	session_destroy(); //Destroy the Session

	header('Location: index.php'); //Redirect To th Main Page
	exit();