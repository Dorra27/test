<?php

namespace ServiceApresVenteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@ServiceApresVente/Default/index.html.twig');


    }


}
