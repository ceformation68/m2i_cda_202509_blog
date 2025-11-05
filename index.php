<?php
	// Création des variables d'affichage
	$strTitle 		= "Accueil";
	$strH1 			= "Accueil";
	$strMetaDesc 	= "Découvrez les derniers articles sur le développement web : JavaScript, HTML, CSS, PHP et bases de données. Tutoriels et conseils pour développeurs.";
	$strDesc		= "Découvrez nos derniers articles sur le développement web";
	
	// Variable technique
	$strPage		= "index";
	
	require("_partial/header.php");
	
	// Récupérer les Articles
	try{
		// Connexion à la base de données
		$db= new PDO(
			"mysql:host=localhost;dbname=blog_php", // Serveur et BDD
			"root", //Nom d'utilisateur de la base de données
			"",// Mot de passe de la base de données
			array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC) // Mode de renvoi
		);
		// Pour résoudre les problèmes d’encodage
		$db->exec("SET CHARACTER SET utf8");
		// Configuration des exceptions
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo"Échec : " . $e->getMessage();
	}
	
	$strQuery		= "SELECT articles.*, users.user_name, users.user_firstname	 
						FROM articles 
							INNER JOIN users ON article_creator = user_id;";
	$arrArticles	= $db->query($strQuery)->fetchAll();
	//var_dump($arrArticles);
	
?>
        <section aria-label="Articles récents">
            <h2 class="visually-hidden">Les 4 derniers articles</h2>
            <div class="row mb-2">
			<?php 
				foreach ($arrArticles as $arrDetArticle){
					//var_dump($arrDetArticle);
					// Traitement de date
					$objDate			= new DateTime($arrDetArticle['article_createdate']);
					$objDateFormatter	= new IntlDateFormatter(
												"fr_FR", // langue
												IntlDateFormatter::LONG,  // format de date
												IntlDateFormatter::NONE, // format heure
												);
					//$strDate 		= $objDate->format("d/m/Y");
					$strDate 		= $objDateFormatter->format($objDate);
					// Traitement du créateur
					$strCreatorName = $arrDetArticle['user_name'].' '.$arrDetArticle['user_firstname'];
					// Traitement du résumé
					$strLength		= 45;
					$strSummary		= substr($arrDetArticle['article_content'], 0, $strLength).((strlen($arrDetArticle['article_content'])>$strLength)?"...":"");
					// Inclure le template de l'article
					include("_partial/article.php");
				}
			?>

            </div>
        </section>
<?php
	require("_partial/footer.php");
?>