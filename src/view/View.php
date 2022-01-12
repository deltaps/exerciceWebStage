<?php

class View{
    private $menu;
    private $router;
    private $title;
    private $content;

    public function __construct($router){
        $this->router = $router;
        $this->menu = array('connexion' => $this->router->getLogin(), 'deconnexion' => $this->router->getDisconnectUser(), 'inscription' => $this->router->getCreationAccount(), 'contact' => $this->router->getContactPage());
    }

    public function render(){
        echo("
        <!doctype html>
        <html lang=\"fr\">
            <head>
              <meta charset=\"utf-8\">
              <title>". $this->title ."</title>
            </head>
            <body>
                <nav>
                    <h1>MON SUPER SITE</h1>
                    <ul class='menu'>
                        ");
        foreach ($this->menu as $key => $value) {
            if(empty($_SESSION['user'])){
                if($key === "deconnexion"){
                    continue;
                }
            }
            else{
                if($key === 'connexion'){
                    continue;
                }
                if($key === "inscription"){
                    continue;
                }
            }
            echo("<li>
                           <a href='" . $value . "'>". $key . "</a>
                        </li>
                        "); // Je ne comprend pas pourquoi, mais c'est le seule moyen de faire une belle indentation dans le code source de la page
        }
        echo("</ul>
                </nav>
                <h1>". $this->title ."</h1>
                <div>
                    " . $this->content . "
                </div>
                <hr>
                <footer>
                    <span>Copyright © 2021 Mon-super-site.fr</span>
                    <p class='foot'>Site réalisé par Pronost Sacha</p>
                </footer>
            </body>
        </html>
        ");
    }

    public function makeWelcomPage(){
        $this->title = "Accueil";
        $this->content = "<section>
        <article>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus architecto quod ex aliquam placeat inventore amet pariatur voluptatibus quisquam dolorum et beatae cupiditate, fugiat ipsa enim. Voluptatum, consequuntur accusamus.</article>
        <article>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus architecto quod ex aliquam placeat inventore amet pariatur voluptatibus quisquam dolorum et beatae cupiditate, fugiat ipsa enim. Voluptatum, consequuntur accusamus.</article>
        <article>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus architecto quod ex aliquam placeat inventore amet pariatur voluptatibus quisquam dolorum et beatae cupiditate, fugiat ipsa enim. Voluptatum, consequuntur accusamus.</article>
        <article>Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus doloribus architecto quod ex aliquam placeat inventore amet pariatur voluptatibus quisquam dolorum et beatae cupiditate, fugiat ipsa enim. Voluptatum, consequuntur accusamus.</article>
        </section>";
        $this->render();
    }

    public function makeLoginFormPage(){
        $this->title = "Connexion";
        $this->content = "<form method='POST' action=". $this->router->getLoginSend().">
        <label>Login : <input type='text' name='login' /></label>
        <label>Mot de passe : <input type='password' name='password' /></label>
        <button>Se connecter</button>
        </form>";
        $this->render();
    }

    public function makeLoginErrorPage($error){
        $this->title = "Connexion";
        $this->content = "<p>" . $error ."</p>
        <form method='POST' action=". $this->router->getLoginSend().">
        <label>Nom : <input type='text' name='login' /></label>
        <label>Mot de passe : <input type='password' name='password' /></label>
        <button>Se connecter</button>
        </form>";
        $this->render();
    }

    public function makeCreationAccountPage($error){
        $this->title = "Création de compte";
        if($error === ""){
            $this->content = "<form method='POST' action=". $this->router->getAccountSend().">
            <div>
                <label for='login'>Identifiant :</label>
                <input type='text' id='login' name='login'>
            </div>
            <div>
                <label for='password'>Mot de passe :</label>
                <input type='password' id='password' name='password'>
            </div>
            <div>
              <button type='submit'>Envoyer </button>
            </div>
            </form>";
        }
        else{
            $this->content = "<p>Erreur : ". $error ."</p>
            <form method='POST' action=". $this->router->getAccountSend().">
            <div>
                <label for='login'>Identifiant :</label>
                <input type='text' id='login' name='login'>
            </div>
            <div>
                <label for='password'>Mot de passe :</label>
                <input type='text' id='password' name='password'>
            </div>
            <div>
              <button type='submit'>Envoyer </button>
            </div>
            </form>";
        }
        $this->render();
    }
    public function makeContactPage(){
        $this->title = "Contact";
        $this->content = "<form method='POST' action=". $this->router->getContactSend().">
            <div>
                <label class='required' for='name'>Nom :</label><br/>
                <input type='text' id='name' name='name'>
            </div>
            <div>
                <label class='required' for='firstname'>Prénom :</label><br/>
                <input type='text' id='firstname' name='firstname'>
            </div>
            <div>
                <label class='required' for='email'>Adresse mail :</label><br/>
                <input type='text' id='email' name='email'>
            </div>
            <div>
                <label class='required' for='subject'>Sujet :</label><br/>
                <input type='text' id='subject' name='subject'>
            </div>
            <div>
                <label class='required' for='message'>Message :</label><br/>
                <textarea id='message' class='input' name='message' row='7' cols='30'></textarea>
            </div>
            <div>
              <button type='submit'>Envoyer </button>
            </div>
            </form>";
        $this->render();
    }


}