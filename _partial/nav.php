<nav class="nav-scroller py-1 mb-3 border-bottom" aria-label="Navigation principale">
	<ul class="nav nav-underline justify-content-between">
		<li class="nav-item">
			<a class="nav-link link-body-emphasis <?php if ($strPage == "index") { echo "active"; } ?> " 
				href="index.php" <?php if ($strPage == "index") { echo "aria-current='page'"; } ?> >Accueil</a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-body-emphasis <?php if ($strPage == "about") { echo "active"; } ?>" 
				href="about.php" <?php if ($strPage == "about") { echo "aria-current='page'"; } ?> >À propos</a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-body-emphasis <?php if ($strPage == "blog") { echo "active"; } ?>" 
				href="blog.php" <?php if ($strPage == "blog") { echo "aria-current='page'"; } ?> >Blog</a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-body-emphasis <?php if ($strPage == "contact") { echo "active"; } ?>"
				href="contact.php" <?php if ($strPage == "contact") { echo "aria-current='page'"; } ?>>Contact</a>
		</li>
	</ul>
</nav>