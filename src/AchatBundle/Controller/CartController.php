<?php

namespace AchatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AchatBundle\Entity\CommandeVente;
use AchatBundle\Entity\LigneCommande;
use VenteBundle\Entity\Produit;
use AchatBundle\Form\CommandeVenteType;

class CartController extends Controller
{


    public function indexAction(SessionInterface $session) {
//        return $this->render('@Achat/Produit/index.html.twig');
        $panier = $session->get('panier', []);
        $panierWithData= [];
        $i = 0;

        foreach ($panier as $id=>$qunatiteEnStock) {
            $panierWithData[] = [
                'produit'=>$this->getDoctrine()->getManager()->getRepository(Produit::class)->find($id),
                'quantite'=>$qunatiteEnStock,
                //'quantite'=> isset($panier[$i]['quantite']) ? $panier[$i]['quantite'] : 0


            ];
            $i++;
        }


        $total=0;

        foreach ($panierWithData as $items) {
            $totalItem = $items['produit']->getPrix() * $items['quantite'];
            $total+=$totalItem;

            
        }
        return $this->render('@Achat/Produit/index.html.twig', [
            'items'=>$panierWithData,
            'total'=>$total
        ]);
    }

    public function createCartAction(SessionInterface $session,$id,Request $request) {


        if($request->isMethod('post'))
        $value = $request->request->get('quantite');
            new Response("hii");
        $panier = $session->get('panier', []);
        if(!empty($panier[$id]) ) {

            $panier[$id]=$panier[$id]++;
        }else
        $panier[$id]=1;


        $session->set('panier',$panier);
        return $this->redirectToRoute('index');

    }

    public function readProduitAction() {
        $produits=$this->getDoctrine()->getManager()->getRepository('AchatBundle:Produit')->findAll();
        return $this->render("@Achat/Vitrine/vitrine.html.twig",array("produits"=>$produits));

    }


        public function removeCartAction($id,SessionInterface $session) {
            $panier = $session->get('panier', []);

            if(!empty($panier[$id])) {
                unset($panier[$id]);
            }
            $session->set('panier',$panier);
            return $this->redirectToRoute('index');
    //        $em = $this->getDoctrine()->getManager();
    //        $em->remove($panier[$id]);
    //        $em->flush();

        }




}
