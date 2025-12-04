<?php
    require("models/article_model.php");

    class ArticlesCtrl {


        public function home(){
            // Création des variables d'affichage
            $strTitle 		= "Accueil";
            $strH1 			= "Accueil";
            $strMetaDesc 	= "Découvrez les derniers articles sur le développement web : JavaScript, HTML, CSS, PHP et bases de données. Tutoriels et conseils pour développeurs.";
            $strDesc		= "Découvrez nos derniers articles sur le développement web";

            // Variable technique
            $strPage		= "index";

            require("views/_partial/header.php");

            $objArticleModel    = new Article_model();

            $arrArticles = $objArticleModel->findAll(4);

            include("views/home.php");

            require("views/_partial/footer.php");

        }

        public function blog(){
            // Création des variables d'affichage
            $strTitle 		= "Blog - Tous les articles";
            $strH1 			= "Mon blog";
            $strMetaDesc 	= "Découvrez qui nous sommes : notre équipe passionnée de développement web, notre mission et nos valeurs. Formations et expertise en programmation.";
            $strDesc		= "Découvrez notre histoire, notre équipe et notre passion pour le développement web";

            // Variable technique
            $strPage		= "blog";

            require("views/_partial/header.php");


            $objArticleModel    = new Article_model();

            $strKeywords	= $_GET['keywords']??'';
            $intAuthor		= $_GET['author']??0;
            $intPeriod		= $_GET['period']??0;
            $strDate		= $_GET['date']??"";
            $strStartDate	= $_GET['startdate']??"";
            $strEndDate		= $_GET['enddate']??"";
            // Récupération des articles
            $arrArticles 	= $objArticleModel->findAll(0, $strKeywords, $intAuthor, $intPeriod, $strDate, $strStartDate, $strEndDate);

            // Récupération des utilisateurs
            require("models/user_model.php");
            $objUserModel = new User_model();
            $arrUsers 		= $objUserModel->findAllUser();
            //	var_dump($arrUsers);

            include("views/blog.php");

            require("views/_partial/footer.php");
        }


    }
