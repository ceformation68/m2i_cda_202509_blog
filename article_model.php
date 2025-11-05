<?php	
	
	function findAll($intLimit = 0, $strKeywords = "", $intAuthor = 0, 
						$intPeriod = 0, $strDate = "", $strStartDate = "", $strEndDate = ""){
		//var_dump($_GET);
		// Récupérer les Articles
		require("connexion.php");
		
		$strQuery		= "SELECT articles.*, users.user_name, users.user_firstname	 
							FROM articles 
								INNER JOIN users ON article_creator = user_id";
		
		$strWhereAnd	= " WHERE ";
		// Traitement des mots clés
		//$strKeywords	= $_GET['keywords']??'';
		if ($strKeywords != ""){
			$strQuery	.= $strWhereAnd." (article_title LIKE '%".$strKeywords."%' 
								OR article_content LIKE '%".$strKeywords."%') ";
			$strWhereAnd	= " AND ";								
		}
		// Traitement du créateur
		if ($intAuthor > 0){
			$strQuery	.= $strWhereAnd." user_id = ".$intAuthor;
			$strWhereAnd	= " AND ";			
		}
		// Traitement de date exacte
		if ($intPeriod == 0 && $strDate != ""){
			$strQuery	.= $strWhereAnd." article_createdate = '".$strDate."'";
			$strWhereAnd	= " AND ";
		}
		
		// Traitement de période de date
		if ($intPeriod == 1 && $strStartDate != "" && $strEndDate != ""){
			$strQuery	.= $strWhereAnd." article_createdate 
											BETWEEN '".$strStartDate."'
											AND '".$strEndDate."' ";
			$strWhereAnd	= " AND ";
		}		
		
		$strQuery	.= " ORDER BY article_createdate DESC";
		if ($intLimit > 0){
			$strQuery	.= " LIMIT ".$intLimit;
		}
		//var_dump($strQuery);
		$arrArticles	= $db->query($strQuery)->fetchAll();
		return $arrArticles;
	}