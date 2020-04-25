<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\NoteProduit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use VenteBundle\Entity\Produit;

class VitrineController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Achat/Default/index.html.twig');
    }

    public function readProduitAction() {
        $produits=$this->getDoctrine()->getManager()->getRepository('VenteBundle:Produit')->findAll();
        return $this->render("@Achat/Vitrine/vitrine.html.twig",array("produits"=>$produits));

    }

    public function showdetailedAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $f = $em->getRepository(Produit::class)->find($id);
        $note = $em->getRepository(NoteProduit::class)->find($id);

        return $this->render('@Achat/Vitrine/detail.html.twig', array(
            'libelle' => $f->getLibelle(),
            'photo' => $f->getPhoto(),
            'description' => $f->getDesription(),
            'poids' => $f->getPoids(),
            'prix' => $f->getPrix(),
            'etat' => $f->getEtat(),
            'user' => $f->getIdUser(),
            'cat' => $f->getIdCat(),
            'id' => $f->getId(),
         //   'note'=>$note,
            'quantite' => $f->getQuantite(),

        ));
    }


}
