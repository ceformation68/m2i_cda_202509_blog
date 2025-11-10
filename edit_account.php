 <?php
	session_start();
	
 	if(!isset($_SESSION['user'])){ // utilisateur non connecté
		header("Location:error_403.php");
		exit;
	}	
	
	// Récupérer les données de l'utilisateur
	require("models/user_model.php");
	$objUserModel	= new User_model();
	$arrUser		= $objUserModel->getUserById($_SESSION['user']['user_id']);
	
	require("entities/user_entity.php");
	$objUser		= new User();
	$objUser->hydrate($arrUser);

	$strPseudo		= $_POST['pseudo']??$_COOKIE["pseudo"]??"";
	
	$arrError 		= array();
	if (count($_POST) > 0){ // Le formulaire est envoyé
		$objUser->hydrate($_POST);
	
		// Tester les données reçues
		if ($objUser->getName() == ""){
			$arrError['name'] = "Le nom est obligatoire";
		}
		if ($objUser->getFirstname() == ""){
			$arrError['firstname'] = "Le prénom est obligatoire";
		}	
		if ($objUser->getMail() == ""){
			$arrError['mail'] = "Le mail est obligatoire";
		}else if (!filter_var($objUser->getMail(), FILTER_VALIDATE_EMAIL)){
			$arrError['mail'] = "Le mail est invalide";
		}

		if ($objUser->getPwd() != ""){
			if ($objUser->getPwd() != $_POST['confirm_pwd']){
				$arrError['pwd'] = "Le mot de passe doit être identique à sa confirmation";
			}
		}
		
		// Si pas d'erreur => modification en bdd
		if (count($arrError) == 0){
			//require_once("user_model.php"); // par sécurité si pas déjà inclus
			$boolUpdate = $objUserModel->editUser($objUser);
			if ($boolUpdate){
				// Si modification ok => on informe
				$_SESSION['message'] = "Les modifications ont bien été effectuées";
				// Mettre à jour la session
				$_SESSION['user']['user_name']		= $objUser->getName();
				$_SESSION['user']['user_firstname']	= $objUser->getFirstname();
				// Mettre à jour le pseudo si renseigné
				if ($strPseudo != ""){
					setcookie("pseudo", $strPseudo, time()+365*24*3600);
				}else if (isset($_COOKIE['pseudo'])){
					setcookie("pseudo", "", -1);
				}
				// Actualise l'entête
				header("Refresh:5");
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
?>

<form method="post" class="row">
	<div class="mb-2 col-6">
		<label>Nom</label>
		<input type="text" name="name" value="<?php echo $objUser->getName(); ?>" 
			class="form-control  <?php if(isset($arrError['name'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Prénom</label>
		<input type="text" name="firstname"  value="<?php echo $objUser->getFirstname(); ?>"
			class="form-control  <?php if(isset($arrError['firstname'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Mail</label>
		<input type="text" name="mail"  value="<?php echo $objUser->getMail(); ?>"
			class="form-control  <?php if(isset($arrError['mail'])) { echo "is-invalid"; } ?>" />
	</div>
	<div class="mb-2 col-6">
		<label>Pseudo</label>
		<input type="text" name="pseudo"  value="<?php echo $strPseudo; ?>" class="form-control" />
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