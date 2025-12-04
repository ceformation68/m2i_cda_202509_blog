<nav class="col-4 d-flex justify-content-end align-items-center" aria-label="Connexion utilisateur">
	<?php 
		if(isset($_SESSION['user'])){ // utilisateur connecté
	?>
	<a class="btn btn-sm" href="index.php?ctrl=users&action=edit_account" title="Modifier mon compte" aria-label="Modifier mon compte">
		Bonjour <?php echo $_COOKIE["pseudo"]??$_SESSION['user']['user_firstname']; ?>
		<span class="visually-hidden">Mon compte</span>
	</a>
	<span aria-hidden="true">|</span>
	<a class="btn btn-sm" href="index.php?ctrl=users&action=logout" title="Se déconnecter" aria-label="Se déconnecter">
		<i class="fas fa-sign-out-alt" aria-hidden="true"></i>
		<span class="visually-hidden">Se déconnecter</span>
	</a>
	<?php 
		}else{ // utilisateur non connecté
	?>
	<a class="btn btn-sm" href="index.php?ctrl=users&action=create_account" title="Créer un compte" aria-label="Créer un compte">
		<i class="fas fa-user" aria-hidden="true"></i>
		<span class="visually-hidden">Créer un compte</span>
	</a>
	<span aria-hidden="true">|</span>
	<a class="btn btn-sm" href="index.php?ctrl=users&action=login" title="Se connecter" aria-label="Se connecter">
		<i class="fas fa-sign-in-alt" aria-hidden="true"></i>
		<span class="visually-hidden">Se connecter</span>
	</a>
	<?php 
		}
	?>
</nav>
