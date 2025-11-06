<?php
	//var_dump($arrError);
	// Affichage des erreurs selon le tableau $arrError
	if (isset($arrError) && count($arrError) > 0){
		echo "<div class='alert alert-danger'>";
		foreach ($arrError as $strError){
			echo "<p>".$strError."</p>";
		}
		echo "</div>";
	}
	
	// Affichage des messages en session
	if (isset($_SESSION['message'])){
		echo "<div class='alert alert-success'>";
		echo "<p>".$_SESSION['message']."</p>";
		echo "</div>";
		// une fois affiché, on enlève le message de la session
		unset($_SESSION['message']);
	}
	