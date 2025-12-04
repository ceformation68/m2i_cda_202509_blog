<?php
	class User_model extends Model_mother{
		
		public function findAllUser(){
			// Récupérer les Utilisateurs
			$strQuery	= "SELECT user_id, user_name, user_firstname
							FROM users
							ORDER BY user_name, user_firstname";
			$arrUsers	= $this->_db->query($strQuery)->fetchAll();
			return $arrUsers;
		}
		
		function getUserByMailAndPwd($strMail, $strPwd){
			// Récupérer l'utilisateur
			$strQuery	= "SELECT user_id, user_name, user_firstname
							FROM users
							WHERE user_mail = :mail
								AND user_pwd = :pwd
							";
							
			$rqPrepare	= $this->_db->prepare($strQuery);
			$rqPrepare->bindValue(":mail", $strMail, PDO::PARAM_STR);
			$rqPrepare->bindValue(":pwd", $strPwd, PDO::PARAM_STR);
			
			$rqPrepare->execute();
			return $rqPrepare->fetch();
		}
		
		function getUserById($intId){
			// Récupérer l'utilisateur
			$strQuery	= "SELECT user_id, user_name, user_firstname, user_mail
							FROM users
							WHERE user_id = :id
							";
							
			$rqPrepare	= $this->_db->prepare($strQuery);
			$rqPrepare->bindValue(":id", $intId, PDO::PARAM_INT);
			
			$rqPrepare->execute();
			return $rqPrepare->fetch();		
		}
		
		function addUser($objUser){
			// Ajouter un utilisateur en BDD
			$strQuery	= "INSERT INTO users (user_name, user_firstname, 
							user_mail, user_pwd)
							VALUES (:name, :firstname, :mail, :pwd)";
			
			$rqPrepare	= $this->_db->prepare($strQuery);
			$rqPrepare->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
			$rqPrepare->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
			$rqPrepare->bindValue(":mail", $objUser->getMail(), PDO::PARAM_STR);
			$rqPrepare->bindValue(":pwd", $objUser->getPwd(), PDO::PARAM_STR);
			
			return $rqPrepare->execute();
		}
		
		function editUser($objUser){
			// Modifier un utilisateur en BDD
			$strQuery	= "UPDATE users 
							SET user_name = :name
								, user_firstname = :firstname
								, user_mail = :mail";
			if ($objUser->getPwd() != ""){
				$strQuery	.= " , user_pwd = :pwd";
			}			
								
			$strQuery	.= " WHERE user_id = :id	";
			
			$rqPrepare	= $this->_db->prepare($strQuery);
			$rqPrepare->bindValue(":name", $objUser->getName(), PDO::PARAM_STR);
			$rqPrepare->bindValue(":firstname", $objUser->getFirstname(), PDO::PARAM_STR);
			$rqPrepare->bindValue(":mail", $objUser->getMail(), PDO::PARAM_STR);
			$rqPrepare->bindValue(":id", $_SESSION['user']['user_id'], PDO::PARAM_INT);
			if ($objUser->getPwd() != ""){
				$rqPrepare->bindValue(":pwd", $objUser->getPwd(), PDO::PARAM_STR);
			}
			
			return $rqPrepare->execute();
		}	
	}
