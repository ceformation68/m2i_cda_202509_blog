<?php	
	
	function findAllUser(){
		// Récupérer les Utilisateurs
		require("connexion.php");
		
		$strQuery	= "SELECT user_id, user_name, user_firstname
						FROM users
						ORDER BY user_name, user_firstname";
		$arrUsers	= $db->query($strQuery)->fetchAll();
		return $arrUsers;
	}