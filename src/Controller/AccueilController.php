<?php

namespace Mvc\Controller;


use Mvc\Model\AccueilModel;
use Config\Controller;
use Twig\Environment;

class AccueilController extends Controller
{

    private AccueilModel $accueilModel;

    public function displayAccueil() {
        
        echo $this->twig->render('accueil.html.twig');
        var_dump($_SESSION["user"]);

    }
}