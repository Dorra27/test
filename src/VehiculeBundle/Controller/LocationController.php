<?php

namespace VehiculeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LocationController extends Controller
{
    public function indexAction()
    {
        return $this->render('VehiculeBundle:Default:index.html.twig');
    }
    public function louerAction()
    {
        return $this->render('@Vehicule/frontend/location.html.twig');
    }
}
