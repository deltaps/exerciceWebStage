<?php

class View{
    private $menu;
    private $router;
    private $title;
    private $content;

    public function __construct($router){
        $this->router = $router;
        $this->menu = array('connexion' => $this->router->getLogin(), 'inscription' => $this->router->getCreationAccount());
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

}