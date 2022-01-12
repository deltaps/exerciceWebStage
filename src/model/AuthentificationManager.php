<?php

class AuthentificationManager{
    private $comptes;

    public function __construct($comptes){
        $this->comptes = $comptes;
    }

    public function connectUser($login,$password){
        $hash = password_hash("$password", PASSWORD_BCRYPT);
        foreach ($this->comptes as $compte) {
            if($compte->getLogin() === $login){
                if(password_verify($password, $compte->getMdp())) {
                    $_SESSION['user'] = $compte;
                    return true;
                }
            }
        }
        return false;
    }
    public function getUserName(){
        return $_SESSION['user']->getNom();
    }
    public function disconnectUser(){
        session_destroy();
        unset($_SESSION);
    }

}