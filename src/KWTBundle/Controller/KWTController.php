<?php

namespace KWTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class KWTController extends Controller
{
    public function indexAction()
    {
        return $this->render('KWTBundle:Site:index.html.twig');
    }

    public function membreAction()
    {
        return $this->render('KWTBundle:Site:membre.html.twig');
    }
}
