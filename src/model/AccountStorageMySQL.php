<?php
include_once 'model/Account.php';
include_once 'model/AuthentificationManager.php';
class AccountStorageMySQL{
    private $authManager;
    private $tableauCompte;
    private $bd;

    public function __construct($bd){
        $this->bd = $bd;
        $requete = "SELECT Login,Password FROM comptes";
        $response = $this->bd->query($requete);
        $this->tableauCompte = array();
        foreach ($response->fetchALL() as $listeCompte) {
            $compte = new Account($listeCompte["Login"],$listeCompte["Password"]);
            array_push($this->tableauCompte,$compte);
        }
        $this->authManager = new AuthentificationManager($this->tableauCompte);
    }


    public function checkAuth($login, $psw){
        return $this->authManager->connectUser($login,$psw);
    }

    public function disconnect(){
        $this->authManager->disconnectUser();
    }

    public function creationAccount($data){
        $hash = password_hash($data["password"], PASSWORD_BCRYPT);
        $requete = "INSERT INTO comptes VALUES (:name,:login,:password,:status)";
        $stmt = $this->bd->prepare($requete);
        $newData = array(':name' => $data["login"], ':login' => $data["login"], ':password' => $hash, ':status' => "none");
        $stmt->execute($newData);
        array_push($this->tableauCompte,new Account($data["login"],$hash));
    }

    public function deleteAccount($login){
        $requete = "DELETE FROM comptes WHERE login=:login";
        $stmt = $this->bd->prepare($requete);
        $data = array(':login' => $login);
        $stmt->execute($data);
        foreach ($this->tableauCompte as $key => $value) {
            if($value->getLogin() === $login){
                $trueKey = $key;
            }
        }
        unset($this->tableauCompte[$trueKey]);
    }

    public function getTableauCompte(){
        return $this->tableauCompte;
    }
}