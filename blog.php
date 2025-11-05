<?php
	// Création des variables d'affichage
	$strTitle 		= "Blog - Tous les articles";
	$strH1 			= "Mon blog";
	$strMetaDesc 	= "Découvrez qui nous sommes : notre équipe passionnée de développement web, notre mission et nos valeurs. Formations et expertise en programmation.";
	$strDesc		= "Découvrez notre histoire, notre équipe et notre passion pour le développement web";
	
	// Variable technique
	$strPage		= "blog";
	
	require("_partial/header.php");
	
	require("article_model.php");	
	
	$strKeywords	= $_GET['keywords']??'';
	$intAuthor		= $_GET['author']??0;
	// Récupération des articles
	$arrArticles 	= findAll(0, $strKeywords, $intAuthor);
	
	// Récupération des utilisateurs
	require("user_model.php");
	$arrUsers 		= findAllUser();
//	var_dump($arrUsers);

?>
        <!-- Formulaire de recherche -->
        <section class="mb-5" aria-labelledby="search-heading">
            <form name="formSearch" method="get" action="#" class="border rounded p-4 bg-light">
                <h3 id="search-heading" class="h4 mb-4">
                    <i class="fas fa-search me-2" aria-hidden="true"></i>
                    Rechercher des articles
                </h3>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="keywords" class="form-label">Mots-clés</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="keywords" 
                            name="keywords"
                            placeholder="Ex: JavaScript, CSS..."
                            aria-describedby="keywords-help"
							value="<?php echo $strKeywords; ?>">
                        <small id="keywords-help" class="form-text text-muted">
                            Recherchez dans les titres et contenus
                        </small>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="author" class="form-label">Auteur</label>
                        <select class="form-select" id="author" name="author">
                            <option value="0">Tous les auteurs</option>
							<?php foreach($arrUsers as $arrDetUser){ ?>
								<option value="<?php echo $arrDetUser['user_id']; ?>"><?php echo $arrDetUser['user_name'].' '.$arrDetUser['user_firstname']; ?></option>
							<?php } ?>
                        </select>
                    </div>
                    
                    <div class="col-12">
                        <fieldset>
                            <legend class="form-label">Type de recherche par date</legend>
                            <div class="form-check form-check-inline">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="period" 
                                    id="period-exact" 
                                    value="0" 
                                    checked
                                    aria-controls="date-exact date-range">
                                <label class="form-check-label" for="period-exact">
                                    Date exacte
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="period" 
                                    id="period-range" 
                                    value="1"
                                    aria-controls="date-exact date-range">
                                <label class="form-check-label" for="period-range">
                                    Période
                                </label>
                            </div>
                        </fieldset>
                    </div>
                    
                    <div class="col-md-6" id="date-exact">
                        <label for="date" class="form-label">Date</label>
                        <input 
                            type="date" 
                            class="form-control" 
                            id="date" 
                            name="date"
                            aria-describedby="date-help">
                        <small id="date-help" class="form-text text-muted">
                            Format: JJ/MM/AAAA
                        </small>
                    </div>
                    
                    <div id="date-range" style="display: none;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="startdate" class="form-label">Date de début</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="startdate" 
                                    name="startdate">
                            </div>
                            <div class="col-md-6">
                                <label for="enddate" class="form-label">Date de fin</label>
                                <input 
                                    type="date" 
                                    class="form-control" 
                                    id="enddate" 
                                    name="enddate">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search me-2" aria-hidden="true"></i>
                            Rechercher
                        </button>
                        <button type="reset" class="btn btn-secondary ms-2">
                            <i class="fas fa-redo me-2" aria-hidden="true"></i>
                            Réinitialiser
                        </button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Liste des articles -->
        <section aria-labelledby="articles-heading">
            <h3 id="articles-heading" class="visually-hidden">Liste des articles</h3>
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