<?php

class Controller{
    protected $view;

    public function __construct($view){
        $this->view = $view;
    }

    public function showWelcomPage(){
        $this->view->makeWelcomPage();
    }

}