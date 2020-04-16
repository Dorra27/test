<?php


namespace VenteBundle\Controller;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use VenteBundle\Entity\Categorie;
use VenteBundle\Entity\Produit;

use VenteBundle\Form\ProduitType;

class ProduitController extends Controller
{
        public function AjouterAction(Request $request, Categorie $id)

    {

        $id=$this->getDoctrine()->getManager()->getRepository(Categorie::class)->find($id);
        $user=$this->getUser();
        $Produit= new Produit();
        $form=$this->createForm( ProduitType::class,$Produit);
        $form=$form->handleRequest($request);


        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $uploadedFile = $form['photo']->getData();

              $fileName=md5(uniqid()).'.'.$uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('kernel.project_dir').'/web/uploadsProduit/produit_image'
                        ,$fileName);

            $Produit->setIdcat($id);//jarb testi
            $Produit->setPhoto($fileName);
            $Produit->setEtat('disponible');
            $Produit->setIdDepot(1);
            $Produit->setIdUser($user);

                      $em->persist($Produit);
            $em->flush();
            return $this->redirectToRoute('affiche');
        }
        return $this->render('@Vente/Produit/Ajouter.html.twig' ,array(
            'Form'=> $form->createView(),"id"=>$id));

    }

 public function modAction(Request $request,$id)
    {

        $em = $this->getDoctrine()->getManager();
        $Produit =$em-> getRepository(Produit::class)->find($id);
        $form=$this->createForm( ProduitType::class,$Produit);
        $form=$form->handleRequest($request);
        if($form->isSubmitted() and $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $uploadedFile = $form['photo']->getData();

            $fileName=md5(uniqid()).'.'.$uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('kernel.project_dir').'/web/uploadsProduit/produit_image'
                ,$fileName);
            $Produit->setPhoto($fileName);
            $em->flush();


                       return $this->redirectToRoute('affiche');
        }
        return $this->render('@Vente/Produit/Ajouter1.html.twig' ,array(
            'Form'=> $form->createView()));
    }





    public function sortByPAction(Request $request)
    {

        $em= $this->getDoctrine()->getManager();
        $listproduit =$em->getRepository('VenteBundle:Produit')->findbyMe3();

        var_dump($listproduit);die();
        return $this->render('@Vente/Produit/Afficher2.html.twig',array(
            'listproduit'=>$listproduit));

    }




    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('q');

        $entities =  $em->getRepository('VenteBundle:Produit')->findEntitiesByString($requestString);

        if(!$entities) {
            $result['entities']['error'] = "Produit n'existe pas";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }


    public function getRealEntities($entities){

        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = [$entity->getPhoto(),$entity->getLibelle()];
        }

        return $realEntities;
    }

    public function sortByPdAction(Request $request)
    {

        $em= $this->getDoctrine()->getManager();
        $listproduit =$em->getRepository('VenteBundle:Produit')->findbyMeAsc();
        return $this->render('@Vente/Produit/Afficher2.html.twig',array(
            'listproduit'=>$listproduit));

    }

    public function afficher1Action(Request $request)
    { $user = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();
        $listproduit= $em->getRepository('VenteBundle:Produit')->findProduitByUser($user);
        return ($this->render('@Vente/Produit/Afficher.html.twig',array('listproduit'=>$listproduit)));

    }


    public function showByPAction(Request $request)
    {
        $min = $request->request->get('min');
        $max = $request->request->get('max');
        $em= $this->getDoctrine()->getManager();
        $car =$em->getRepository('VenteBundle:Produit')->findbyMe2($min,$max);
        $car1 =$em->getRepository('VenteBundle:Categorie')->findAll();
        return $this->render('@Vente/Produit/test.html.twig',array(
            'car'=> $car1,'cat'=>$car ));

    }
    public function detail1Action($id)
    {
        $repository =$this->getDoctrine()->getManager()->getRepository(Produit::class);
        $Produit=$repository->findbyMe($id);
        return ($this->render('@Vente/Produit/detail.html.twig',array('Produit'=>$Produit)));

    }
    public function supprimerAction($id)
    {   $em = $this->getDoctrine()->getManager();
        $Produit = $this->getDoctrine()->getRepository(Produit::class)->find($id);
        $em->remove($Produit);
        $em->flush();

        return $this->redirectToRoute("affiche");
    }
}