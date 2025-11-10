 <?php
	session_start();
	
	if(isset($_SESSION['user'])){ // utilisateur connecté
		$_SESSION['message'] = "Vous êtes déjà connecté";
		header("Location:edit_account.php");
		exit;
	}
	// Récupérer les données du formulaire
	$strMail		= $_POST['mail']??"";
	$strPwd			= $_POST['pwd']??"";
	
	$arrError 		= array();
	if (count($_POST) > 0){ // Le formulaire est envoyé
		if ($strMail == ""){
			$arrError['mail'] = "Le mail est obligatoire";
		}else if (!filter_var($strMail, FILTER_VALIDATE_EMAIL)){
			$arrError['mail'] = "Le mail est invalide";
		}
		if ($strPwd == ""){
			$arrError['pwd'] = "Le mot de passe est obligatoire";
		}	

		// Si pas d'erreur => vérification de l'utilisateur en BDD
		if (count($arrError) == 0){
			require("models/user_model.php");
			$objUserModel	= new User_model();
			$arrUser		= $objUserModel->getUserByMailAndPwd($strMail, $strPwd);
			if($arrUser === false){ // utilisateur non trouvé !$arrUser
				$arrError[] = "Erreur de connexion";
			}else{ // utilisateur trouvé
				$_SESSION['user'] 	= $arrUser;
				header("Location:index.php");
				exit;
			}
		}
	}
	// Création des variables d'affichage
	$strTitle 		= "Se connecter";
	$strH1 			= "Se connecter";
	$strMetaDesc 	= "Se connecter";
	$strDesc		= "Page de se connecter";
	
	// Variable technique
	$strPage		= "login";
	
	require("_partial/header.php");
?>

<form method="post" class="row">
	<div class="mb-2 col-6">
		<label>Mail</label>
		<input type="text" name="mail"  value="<?php echo $strMail??''; ?>"
			class="form-control  <?php if(isset($arrError['mail'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Mot de passe</label>
		<input type="password" name="pwd" 
			class="form-control  <?php if(isset($arrError['pwd'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-12">
		<input class="btn btn-primary" type="submit" />
	</div>

</form>


<?php
	require("_partial/footer.php");
?>