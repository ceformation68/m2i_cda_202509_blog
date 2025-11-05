 <?php
	// Récupérer les données du formulaire
	$strName		= $_POST['name']??"";
	$strFirstname	= $_POST['firstname']??"";
	$strMail		= $_POST['mail']??"";
	$strPwd			= $_POST['pwd']??"";
	
	$arrError 		= array();
	if (count($_POST) > 0){ // Le formulaire est envoyé
		// Filtrer les données 
		$strName		= htmlspecialchars(trim($strName));
	
		// Tester les données reçues
		if ($strName == ""){
			$arrError['name'] = "Le nom est obligatoire";
		}
		if ($strFirstname == ""){
			$arrError['firstname'] = "Le prénom est obligatoire";
		}	
		if ($strMail == ""){
			$arrError['mail'] = "Le mail est obligatoire";
		}else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)){
			$arrError['mail'] = "Le mail est invalide";
		}
		if ($strPwd == ""){
			$arrError['pwd'] = "Le mot de passe est obligatoire";
		}else if ($strPwd != $_POST['confirm_pwd']){
			$arrError['pwd'] = "Le mot de passe doit être identique à sa confirmation";
		}
		
		// Si pas d'erreur => insertion en bdd
		if (count($arrError) == 0){
			require("user_model.php");
			$boolInsert = addUser($strName, $strFirstname, $strMail, $strPwd);
			if ($boolInsert){
				// Si insertion ok => redirection login.php
				header("Location:login.php");
				exit; // par sécurité arrêter l'exécution
			}else{
				$arrError[] = "Un erreur s'est produite, contactez l'administrateur";
			}
		}
	}
 
	// Création des variables d'affichage
	$strTitle 		= "Créer un compte";
	$strH1 			= "Créer un compte";
	$strMetaDesc 	= "Créer un compte";
	$strDesc		= "Page de création de compte";
	
	// Variable technique
	$strPage		= "create_account";
	
	require("_partial/header.php");
	//var_dump($arrError);
	if (count($arrError) > 0){
		echo "<div class='alert alert-danger'>";
		foreach ($arrError as $strError){
			echo "<p>".$strError."</p>";
		}
		echo "</div>";
	}
	
	
?>


<form method="post">
	<p>
		<label>Nom</label>
		<input type="text" name="name" value="<?php echo $strName; ?>" 
			class="form-control  <?php if(isset($arrError['name'])) { echo "is-invalid"; } ?>" />
	</p>
	<p>
		<label>Prénom</label>
		<input type="text" name="firstname"  value="<?php echo $strFirstname; ?>"/>
	</p>
	<p>
		<label>Mail</label>
		<input type="text" name="mail"  value="<?php echo $strMail; ?>"/>
	</p>
	<p>
		<label>Mot de passe</label>
		<input type="password" name="pwd" />
	</p>
	<p>
		<label>Confirmation du mot de passe</label>
		<input type="password" name="confirm_pwd" />
	</p>
	<p>
		<input type="submit" />
	</p>

</form>


<?php
	require("_partial/footer.php");
?>