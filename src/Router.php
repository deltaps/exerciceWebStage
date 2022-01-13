<?php
include_once 'view/View.php';
include_once 'control/Controller.php';
class Router{

    public function main($accountStorage,$bd){
        session_start();
        $affiche = new View($this);
        $controller = new Controller($affiche,$accountStorage,$bd);
        if(array_key_exists("login",$_GET)){
            $controller->makeLoginFormPage();
        }
        elseif(array_key_exists("loginSend",$_GET)){
            $controller->login($_POST);
        }
        elseif(array_key_exists("disconnect",$_GET)){
            $controller->disconnection();
        }
        elseif(array_key_exists("creationAccount",$_GET)){
            $affiche->makeCreationAccountPage("");
        }
        elseif(array_key_exists("accountSend",$_GET)){
            $controller->creationAccount($_POST);
        }
        elseif(array_key_exists("contact",$_GET)){
            $affiche->makeContactPage("","");
        }
        elseif(array_key_exists("contactSend",$_GET)){
            $controller->sendContact($_POST);
        }
        else {
            $controller->showWelcomPage();
        }
    }

    public function getLogin(){
        return "?login";
    }
    public function getLoginSend(){
        return "?loginSend";
    }
    public function getDisconnectUser(){
        return "?disconnect";
    }
    public function getCreationAccount(){
        return "?creationAccount";
    }
    public function getAccountSend(){
        return "?accountSend";
    }
    public function getContactPage(){
        return "?contact";
    }
    public function getContactSend(){
        return "?contactSend";
    }
}