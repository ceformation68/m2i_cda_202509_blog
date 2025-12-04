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
					$strSummary		= substr($arrDetArticle['article_content'], 0, $strLength) . ((strlen($arrDetArticle['article_content']) > $strLength) ? "..." : "");
					// Inclure le template de l'article
					include("_partial/article.php");
				}
			?>
            </div>
        </section>
