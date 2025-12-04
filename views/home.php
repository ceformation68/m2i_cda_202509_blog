        <section aria-label="Articles récents">
            <h2 class="visually-hidden">Les 4 derniers articles</h2>
            <div class="row mb-2">
			<?php 
				foreach ($arrArticles as $objArticle){
					// Inclure le template de l'article
					include("_partial/article.php");
				}
			?>
            </div>
        </section>
