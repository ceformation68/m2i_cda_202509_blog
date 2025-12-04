<?php

    class PagesCtrl {


        public function about(){	// Création des variables d'affichage
            $strTitle 		= "À propos";
            $strH1 			= "À propos";
            $strMetaDesc 	= "Découvrez qui nous sommes : notre équipe passionnée de développement web, notre mission et nos valeurs. Formations et expertise en programmation.";
            $strDesc		= "Découvrez notre histoire, notre équipe et notre passion pour le développement web";

            // Variable technique
            $strPage		= "about";

            require("views/_partial/header.php");
            include("views/about.php");
            require("views/_partial/footer.php");
        }

        public function contact(){
            // Création des variables d'affichage
            $strTitle 		= "Contact";
            $strH1 			= "Contact";
            $strMetaDesc 	= "Découvrez qui nous sommes : notre équipe passionnée de développement web, notre mission et nos valeurs. Formations et expertise en programmation.";
            $strDesc		= "Contactez-nous pour toute question";

            // Variable technique
            $strPage		= "contact";

            require("views/_partial/header.php");
            include("views/contact.php");
            require("views/_partial/footer.php");
        }

        public function mentions(){
            // Création des variables d'affichage
            $strTitle 		= "Mentions légales";
            $strH1 			= "Mentions légales";
            $strMetaDesc 	= "Découvrez qui nous sommes : notre équipe passionnée de développement web, notre mission et nos valeurs. Formations et expertise en programmation.";
            $strDesc		= "Informations légales et politique de confidentialité";

            // Variable technique
            $strPage		= "mentions";

            require("views/_partial/header.php");
            include("views/mentions.php");
            require("views/_partial/footer.php");
        }

    }
