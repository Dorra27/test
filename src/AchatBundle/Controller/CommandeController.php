<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{
    public function indexAction()
    {
        return $this->render('AchatBundle:Default:index.html.twig');
    }

}
