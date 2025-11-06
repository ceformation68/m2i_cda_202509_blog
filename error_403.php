<?php
	// Création des variables d'affichage
	$strTitle 		= "Erreur 403";
	$strH1 			= "Erreur 403";
	$strMetaDesc 	= "Erreur 403";
	$strDesc		= "Vous devez vous connecter pour accéder à ces informations";
	
	// Variable technique
	$strPage		= "error_403";
	
	require("_partial/header.php");
?>
<p>Merci de <a href="create_account.php" >créer un compte</a> ou vous <a href="login.php">connecter</a></p>

<?php
	require("_partial/footer.php");
?>
