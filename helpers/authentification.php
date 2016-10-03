<?php
namespace exmsl;

require_once(dirname(__DIR__) . '/config/initialize.php');

class Authentification {

    public function islogged(){
        if(!isset($_SESSION['adminId'])){
            $app = new App();
            $app->redirect('../public/index.php');
        }
    }
}