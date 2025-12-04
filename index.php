<?php
    $ctrl   = $_GET['ctrl']??'articles';
    $action = $_GET['action']??'home';

    $bool404 = false;
    $strCtrlFile = 'controllers/'.$ctrl.'_controller.php';
    if (file_exists($strCtrlFile)) {
        require_once($strCtrlFile);
        $strCtrlName    = ucfirst($ctrl).'Ctrl';
        if (class_exists($strCtrlName)) {
            $objCtrl = new $strCtrlName();
            if (method_exists($objCtrl, $action)) {
                $objCtrl->$action();
            }else{
                $bool404 = true;
            }
        }else{
            $bool404 = true;
        }
    }else{
        $bool404 = true;
    }

    if ($bool404) {
        header("Location:index.php?ctrl=errors&action=error_404");
    }
