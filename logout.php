<?php
	/*
	session_start();
	session_destroy();

	// nouvelle session
	session_start();
	*/
	
	session_start();
	unset($_SESSION['user']);
	
	$_SESSION['message'] = "Vous êtes déconnecté";
	header("Location:index.php");
	exit;
	
	