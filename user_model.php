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
	
	function getUserByMailAndPwd($strMail, $strPwd){
		// Récupérer l'utilisateur
		require("connexion.php");
		
		$strQuery	= "SELECT user_id, user_name, user_firstname
						FROM users
						WHERE user_mail = :mail
							AND user_pwd = :pwd
						";
						
		$rqPrepare	= $db->prepare($strQuery);
		$rqPrepare->bindValue(":mail", $strMail, PDO::PARAM_STR);
		$rqPrepare->bindValue(":pwd", $strPwd, PDO::PARAM_STR);
		
		$rqPrepare->execute();
		return $rqPrepare->fetch();
	}
	
	function getUserById($intId){
		// Récupérer l'utilisateur
		require("connexion.php");
		
		$strQuery	= "SELECT user_id, user_name, user_firstname, user_mail
						FROM users
						WHERE user_id = :id
						";
						
		$rqPrepare	= $db->prepare($strQuery);
		$rqPrepare->bindValue(":id", $intId, PDO::PARAM_INT);
		
		$rqPrepare->execute();
		return $rqPrepare->fetch();		
	}
	
	function addUser($strName, $strFirstname, $strMail, $strPwd){
		// Ajouter un utilisateur en BDD
		require("connexion.php");
		
		$strQuery	= "INSERT INTO users (user_name, user_firstname, 
						user_mail, user_pwd)
						VALUES (:name, :firstname, :mail, :pwd)";
		
		$rqPrepare	= $db->prepare($strQuery);
		$rqPrepare->bindValue(":name", $strName, PDO::PARAM_STR);
		$rqPrepare->bindValue(":firstname", $strFirstname, PDO::PARAM_STR);
		$rqPrepare->bindValue(":mail", $strMail, PDO::PARAM_STR);
		$rqPrepare->bindValue(":pwd", $strPwd, PDO::PARAM_STR);
		
		return $rqPrepare->execute();
	}
	
	function editUser($strName, $strFirstname, $strMail, $strPwd){
		// Modifier un utilisateur en BDD
		require("connexion.php");
		
		$strQuery	= "UPDATE users 
						SET user_name = :name
							, user_firstname = :firstname
							, user_mail = :mail";
		if ($strPwd != ""){
			$strQuery	.= " , user_pwd = :pwd";
		}			
							
		$strQuery	.= " WHERE user_id = :id	";
		
		$rqPrepare	= $db->prepare($strQuery);
		$rqPrepare->bindValue(":name", $strName, PDO::PARAM_STR);
		$rqPrepare->bindValue(":firstname", $strFirstname, PDO::PARAM_STR);
		$rqPrepare->bindValue(":mail", $strMail, PDO::PARAM_STR);
		$rqPrepare->bindValue(":id", $_SESSION['user']['user_id'], PDO::PARAM_INT);
		if ($strPwd != ""){
			$rqPrepare->bindValue(":pwd", $strPwd, PDO::PARAM_STR);
		}
		
		return $rqPrepare->execute();
	}	