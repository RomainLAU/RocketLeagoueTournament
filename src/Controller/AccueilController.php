<?php

namespace Mvc\Controller;

use Config\Controller;
use Twig\Environment;

class AccueilController extends Controller
{

    public function displayAccueilUnconnected() {
        
        echo $this->twig->render('accueil.html.twig');

    }

    public function displayAccueilUserConnected() {
        
        echo $this->twig->render('user/accueil.html.twig');

    }

    public function displayAccueilAdminConnected() {
        
        echo $this->twig->render('admin/accueil.html.twig');

    }
}