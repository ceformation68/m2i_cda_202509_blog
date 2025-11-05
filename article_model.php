<?php	
	
	function findAll($intLimit = 0, $strKeywords = "", $intAuthor = 0){
		var_dump($_GET);
		// Récupérer les Articles
		require("connexion.php");
		
		$strQuery		= "SELECT articles.*, users.user_name, users.user_firstname	 
							FROM articles 
								INNER JOIN users ON article_creator = user_id";
		
		// Traitement des mots clés
		//$strKeywords	= $_GET['keywords']??'';
		if ($strKeywords != ""){
			$strQuery	.= " WHERE (article_title LIKE '%".$strKeywords."%' 
								OR article_content LIKE '%".$strKeywords."%') ";						
		}
		// Traitement du créateur
		if ($intAuthor > 0){
			$strQuery	.= " WHERE user_id = ".$intAuthor;						
		}
								
		$strQuery	.= " ORDER BY article_createdate DESC";
		if ($intLimit > 0){
			$strQuery	.= " LIMIT ".$intLimit;
		}
		var_dump($strQuery);
		$arrArticles	= $db->query($strQuery)->fetchAll();
		return $arrArticles;
	}