<?php
include_once 'model/AccountStorageMySQL.php';
class Controller{
    protected $view;
    protected $accountStorage;
    protected $bd;

    public function __construct($view,$accountStorage,$bd){
        $this->view = $view;
        $this->accountStorage = $accountStorage;
        $this->bd = $bd;
    }

    public function showWelcomPage(){
        $this->view->makeWelcomPage("");
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
            $error = array('nom' => '', 'prenom' => '' , 'mail' => '', 'sujet' => '', 'text' => '');
            $inerror = false;
            if($data["name"] === ""){
                $error['nom'] = "Un nom est obligatoire";
                $inerror = true;
            }
            if($data["firstname"] === ""){
                $error['prenom'] = "Un prenom est obligatoire";
                $inerror = true;
            }
            if($data["email"] === ""){
                $error['mail'] = "Une adresse mail est obligatoire";
                $inerror = true;
            }
            if($data["subject"] === ""){
                $error['sujet'] = "Un sujet est obligatoire";
                $inerror = true;
            }
            if($data["message"] === ""){
                $error['text'] = "Un message est obligatoire";
                $inerror = true;
            }
            if($inerror){
                $this->view->makeContactPage($error,$data);
            }
            else{
                $requete = "INSERT INTO contact VALUES (:nom,:prenom,:mail,:sujet,:texte)";
                $stmt = $this->bd->prepare($requete);
                $newData = array(':nom' => $data["name"], ':prenom' => $data["firstname"], ':mail' => $data["email"], ':sujet' => $data["subject"],':texte' => $data["message"]);
                $stmt->execute($newData);
                $this->view->makeWelcomPage("Message envoyé!");
            }
        }
    }

}