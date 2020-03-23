<?php

namespace ServiceApresVenteBundle\Controller;

use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Entity\RecFeedCat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RecFeedCatController extends Controller
{



    public function showAction() {
        $categories=$this->getDoctrine()->getManager()->getRepository(RecFeedCat::class)->findAll();
        return $this->render('@ServiceApresVente/Categorie/showCategorie.html.twig',array("categories"=>$categories));
    }

}
