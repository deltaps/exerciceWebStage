<?php
include_once 'model/AccountStorageMySQL.php';
class Controller{
    protected $view;
    protected $accountStorage;

    public function __construct($view,$accountStorage){
        $this->view = $view;
        $this->accountStorage = $accountStorage;
    }

    public function showWelcomPage(){
        $this->view->makeWelcomPage();
    }
    public function makeLoginFormPage(){
        $this->view->makeLoginFormPage();
    }
    public function login($data){
        if($data != null){
            if($this->accountStorage->checkAuth($data['login'],$data['password'])){
                $this->view->makeWelcomPage();
            }
            else{
                $this->view->makeLoginErrorPage("Erreur, votre login ou passsword est incorect");
            }
        }
        else{
            $this->view->makeWelcomPage();
        }
    }
    public function disconnection(){
        $this->accountStorage->disconnect();
        $this->view->makeWelcomPage();
    }
    public function creationAccount($data){
        if($data != null){
            $loginAlreadyTaken = false;
            foreach ($this->accountStorage->getTableauCompte() as $compte) {
                if($compte->getLogin() === $data['login']){
                    $this->view->makeCreationAccountPage("le login appartient déjà a quelqu'un");
                    $loginAlreadyTaken = true;
                }
            }
            if(!$loginAlreadyTaken){
                if($data['login'] != "" && $data['password'] != ""){
                    $this->accountStorage->creationAccount($data);
                    $this->view->makeLoginErrorPage("Votre compte a été crée avec succées, veuillé vous connecter");
                }
                else{
                    $this->view->makeCreationAccountPage("il faut que les deux champs sois remplie");
                }
            }
        }
        else{
            $this->view->makeWelcomPage();
        }
    }
    public function sendContact($data){
        if($data != null){

        }
    }

}