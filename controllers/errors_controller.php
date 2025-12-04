<?php

    class ErrorsCtrl {


        public function error_404(){
            // Création des variables d'affichage
            $strTitle 		= "Erreur 404";
            $strH1 			= "Erreur 404";
            $strMetaDesc 	= "Erreur 404";
            $strDesc		= "La page n'existe pas";

            // Variable technique
            $strPage		= "error_404";

            require("views/_partial/header.php");
            include("views/error_404.php");
            require("views/_partial/footer.php");
        }

        public function error_403(){
            // Création des variables d'affichage
            $strTitle 		= "Erreur 403";
            $strH1 			= "Erreur 403";
            $strMetaDesc 	= "Erreur 403";
            $strDesc		= "Vous devez vous connecter pour accéder à ces informations";

            // Variable technique
            $strPage		= "error_403";

            require("views/_partial/header.php");
            include("views/error_403.php");
            require("views/_partial/footer.php");
        }


    }
