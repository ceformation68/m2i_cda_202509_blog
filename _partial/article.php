<article class="col-md-6 mb-4">
	<div class="row g-0 border rounded overflow-hidden flex-md-row shadow-sm h-md-250 position-relative">
		<div class="col p-4 d-flex flex-column position-static">
			<h3 class="mb-2"><?php echo $arrDetArticle['article_title']; ?></h3>
			<div class="mb-2 text-body-secondary">
				<time datetime="<?php echo $arrDetArticle['article_createdate']; ?>">
					<?php echo $strDate; ?>
				</time>
				<span aria-label="Auteur"> - <?php echo $strCreatorName; ?></span>
			</div>
			<p class="mb-auto"><?php echo $strSummary; ?></p>
			<a href="article-javascript.html" class="icon-link gap-1 icon-link-hover stretched-link" aria-label="Lire l'article complet sur le devenir du JavaScript">
				Lire la suite
				<i class="fas fa-arrow-right" aria-hidden="true"></i>
			</a>
		</div>
		<div class="col-auto d-none d-lg-block">
			<img class="bd-placeholder-img" width="200" height="250" src="assets/images/<?php echo $arrDetArticle['article_img']; ?>" alt="<?php echo $arrDetArticle['article_title']; ?>" loading="lazy">
		</div>
	</div>
</article>