<?php
    require("models/article_model.php");
    require("entities/article_entity.php");
/**
 * Controller des articles
 */
    class ArticlesCtrl extends MotherCtrl {

        /**
         * Page d'accueil
         * @return void
         */
        public function home(){
            // Création des variables d'affichage
            $this->_arrData['strTitle']		= "Accueil";
            $this->_arrData['strH1']		= "Accueil";
            $this->_arrData['strMetaDesc'] 	= "Découvrez les derniers articles sur le développement web : JavaScript, HTML, CSS, PHP et bases de données. Tutoriels et conseils pour développeurs.";
            $this->_arrData['strDesc']		= "Découvrez nos derniers articles sur le développement web";

            // Variable technique
            $this->_arrData['strPage']		= "index";

            $objArticleModel                = new Article_model();

            $arrArticles                    = $objArticleModel->findAll(4);

            // On parcourt le tableau pour créer des objets
            $arrArticlesToDisplay           = array();
            foreach($arrArticles as $arrDetArticle){
                $objArticle = new Article();
                $objArticle->hydrate($arrDetArticle);
                $arrArticlesToDisplay[] = $objArticle;
            }

            $this->_arrData['arrArticles'] = $arrArticlesToDisplay;

            $this->_display("home");

        }

        /**
         * Page blog
         * @return void
         */
        public function blog(){
            // Création des variables d'affichage
            $this->_arrData['strTitle'] 	= "Blog - Tous les articles";
            $this->_arrData['strH1'] 		= "Mon blog";
            $this->_arrData['strMetaDesc'] 	= "Découvrez qui nous sommes : notre équipe passionnée de développement web, notre mission et nos valeurs. Formations et expertise en programmation.";
            $this->_arrData['strDesc']		= "Découvrez notre histoire, notre équipe et notre passion pour le développement web";

            // Variable technique
            $this->_arrData['strPage']		= "blog";

            $objArticleModel    = new Article_model();

            $objArticleModel->_arrSearch = array(
                'strKeywords'	=> $_POST['keywords']??'',
                'intAuthor'		=> $_POST['author']??0,
                'intPeriod'		=> $_POST['period']??0,
                'strDate'		=> $_POST['date']??"",
                'strStartDate'	=> $_POST['startdate']??"",
                'strEndDate'	=> $_POST['enddate']??"");

            // Récupération des articles
            $arrArticles                    = $objArticleModel->findAll();

            // On parcourt le tableau pour créer des objets
            $arrArticlesToDisplay           = array();
            foreach($arrArticles as $arrDetArticle){
                $objArticle = new Article();
                $objArticle->hydrate($arrDetArticle);
                $arrArticlesToDisplay[] = $objArticle;
            }

            $this->_arrData['arrArticles']  = $arrArticlesToDisplay;

            $this->_arrData['arrSearch']	= $objArticleModel->_arrSearch;

            // Récupération des utilisateurs
            require("models/user_model.php");
            $objUserModel = new User_model();
            $this->_arrData['arrUsers'] 		= $objUserModel->findAllUser();

            $this->_display("blog");

        }


    }
