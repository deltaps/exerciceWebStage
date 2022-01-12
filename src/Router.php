<?php
include_once 'view/View.php';
include_once 'control/Controller.php';
class Router{

    public function main(){
        $affiche = new View($this);
        $controller = new Controller($affiche);
        $controller->showWelcomPage();
    }

    public function getLogin(){
        return "?login";
    }
    public function getCreationAccount(){
        return "?creationAccount";
    }
}