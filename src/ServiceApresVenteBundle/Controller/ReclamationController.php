<?php

namespace ServiceApresVenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ReclamationController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServiceApresVenteBundle:Default:index.html.twig');
    }



}
