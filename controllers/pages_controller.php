<?php

    class PagesCtrl {


        public function about(){
            include("views/about.php");
        }

        public function contact(){
            include("views/contact.php");
        }

        public function mentions(){
            include("views/mentions.php");
        }

    }
