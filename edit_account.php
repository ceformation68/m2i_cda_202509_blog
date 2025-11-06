 <?php
	session_start();
	
 	if(!isset($_SESSION['user'])){ // utilisateur non connecté
		header("Location:error_403.php");
		exit;
	}	
	
	
	// Récupérer les données de l'utilisateur
	require("user_model.php");
	$arrUser	= getUserById($_SESSION['user']['user_id']);
	
	$strName		= $_POST['name']??$arrUser['user_name']??"";
	$strFirstname	= $_POST['firstname']??$arrUser['user_firstname']??"";
	$strMail		= $_POST['mail']??$arrUser['user_mail']??"";
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

		if ($strPwd != ""){
			if ($strPwd != $_POST['confirm_pwd']){
				$arrError['pwd'] = "Le mot de passe doit être identique à sa confirmation";
			}
		}
		
		// Si pas d'erreur => modification en bdd
		if (count($arrError) == 0){
			require_once("user_model.php"); // par sécurité si pas déjà inclus
			$boolUpdate = editUser($strName, $strFirstname, $strMail, $strPwd);
			if ($boolUpdate){
				// Si modification ok => on informe
				$_SESSION['message'] = "Les modificiations ont bien été effectuées";
				// Mettre à jour la session
				$_SESSION['user']['user_name']	= $strName;
				$_SESSION['user']['user_firstname']	= $strFirstname;
			}else{
				$arrError[] = "Un erreur s'est produite, contactez l'administrateur";
			}
		}
	}
 
	// Création des variables d'affichage
	$strTitle 		= "Modifier son compte";
	$strH1 			= "Modifier son compte";
	$strMetaDesc 	= "Modifier son compte";
	$strDesc		= "Page de modification de son compte";
	
	// Variable technique
	$strPage		= "edit_account";
	
	require("_partial/header.php");
	//var_dump($arrError);
	/*if (count($arrError) > 0){
		echo "<div class='alert alert-danger'>";
		foreach ($arrError as $strError){
			echo "<p>".$strError."</p>";
		}
		echo "</div>";
	}*/
	
	
?>

<form method="post" class="row">
	<div class="mb-2 col-6">
		<label>Nom</label>
		<input type="text" name="name" value="<?php echo $strName; ?>" 
			class="form-control  <?php if(isset($arrError['name'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Prénom</label>
		<input type="text" name="firstname"  value="<?php echo $strFirstname; ?>"
			class="form-control  <?php if(isset($arrError['firstname'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-12">
		<label>Mail</label>
		<input type="text" name="mail"  value="<?php echo $strMail; ?>"
			class="form-control  <?php if(isset($arrError['mail'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Mot de passe</label>
		<input type="password" name="pwd" 
			class="form-control  <?php if(isset($arrError['pwd'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Confirmation du mot de passe</label>
		<input type="password" name="confirm_pwd" class="form-control" />
	</div>
	<div class="mb-2 col-12">
		<input class="btn btn-primary" type="submit" />
	</div>

</form>


<?php
	require("_partial/footer.php");
?>