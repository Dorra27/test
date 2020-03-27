<?php

namespace ServiceApresVenteBundle\Controller;

use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Entity\RecFeedCat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class RecFeedCatController extends Controller
{



    public function showAction() {


    }
    public function nameAction($nom,SessionInterface $session) {
        $categories=$this->getDoctrine()->getManager()->getRepository(RecFeedCat::class)->findAll();

        $type=$session->get('type',[]);
        if(!empty($type[$nom])) {
            new Response('empty nom');
        }
        if($nom == "Feedback")
        {

        $session->set('type',$nom);
        dump($session->get('type'));
        }
        else {
            $session->set('type',"Reclamation");
            dump($session->get('type'));
        }
        return $this->render('@ServiceApresVente/Categorie/showCategorie.html.twig',array("categories"=>$categories,'type'=>$nom));


    }

}
