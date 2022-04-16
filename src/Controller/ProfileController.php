<?php

namespace Mvc\Controller;

use Config\Controller;
use Twig\Environment;

class PRofileController extends Controller
{

    public function displayProfile() {
        
        echo $this->twig->render('/user/profile.html.twig');
    }
}