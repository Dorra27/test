<?php

namespace ServiceApresVenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ServiceApresVente/Default/material.html.twig');
    }
}
