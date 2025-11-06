 <?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	session_start();
	
 	if(isset($_SESSION['user'])){ // utilisateur connecté
		$_SESSION['message'] = "Vous êtes déjà connecté";
		header("Location:edit_account.php");
		exit;
	}

	include "config.php"; 
	
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
				// Si insertion ok 
				// => Envoyer le mail de demande de confirmation du compte
				// A déporter dans un autre fichier pour réutiliser
				require 'libs/PHPMailer/Exception.php';
				require 'libs/PHPMailer/PHPMailer.php';
				require 'libs/PHPMailer/SMTP.php';
				$objMail = new PHPMailer();
				$objMail->IsSMTP();
				$objMail->CharSet 		= PHPMailer::CHARSET_UTF8;
				$objMail->Mailer 		= "smtp";
				$objMail->SMTPDebug		= 0;
				$objMail->SMTPAuth		= TRUE;
				$objMail->SMTPSecure	= "tls";
				$objMail->Port 			= 587;
				$objMail->Host 			= MAIL_HOST;
				$objMail->Username		= MAIL_USER;
				$objMail->Password		= MAIL_PWD;
				$objMail->IsHTML(true);
				// Expéditeur
				$objMail->setFrom('contact@ce-formation.com', 'christel');
				// Destinataire
				$objMail->addAddress($strMail, $strName);
				// Sujet
				$objMail->Subject	= "Création du compte - confirmation";
				// Contenu du mail
				$objMail->Body 	= "Merci de confirmer la création de votre compte à l'aide du lien suivant
								...								
								";
				// Envoi du mail avec vérification
				if (!$objMail->send()) {
					$arrErrors[] = 'Erreur de Mailer : ' . $objMail->ErrorInfo;
				} else{
					$_SESSION['message'] 	= "Votre compte a bien été créé";
					// => redirection login.php
					header("Location:login.php");
					exit; // par sécurité arrêter l'exécution
				}
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
	
	require("_partial/message.php");

	
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