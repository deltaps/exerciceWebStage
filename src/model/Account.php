<?php

class Account{
    protected $login;
    protected $mdp;

    public function __construct($login, $mdp){
        $this->login = $login;
        $this->mdp = $mdp;
    }


    public function getLogin()
    {
        return $this->login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

}