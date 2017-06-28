<?php

namespace KWTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use wowarmoryapi;

class KWTController extends Controller
{
    public function indexAction()
    {
        return $this->render('KWTBundle:Site:index.html.twig');
    }

    public function membreAction()
    {
    	//Récupération de données via API Blizzard


        return $this->render('KWTBundle:Site:membre.html.twig');
    }
}
