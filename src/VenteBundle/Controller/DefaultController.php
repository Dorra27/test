<?php

namespace VenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VenteBundle:Default:index.html.twig');
    }
}
