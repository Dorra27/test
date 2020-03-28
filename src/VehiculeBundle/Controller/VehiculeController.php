<?php

namespace VehiculeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use VehiculeBundle\Entity\Vehicule;
use VehiculeBundle\Form\VehiculeType;
use Symfony\Component\HttpFoundation\Request;
class VehiculeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Vehicule/frontend/vehicule/indexx.html.twig');
    }
    // Admin
    public function afficheAction ()
    {
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();
        return $this->render( '@Vehicule/backend/AffichageVehicule.html.twig', array('v'=>$Vehicule));
    }
    // affichage d'une vehicule par son matricule pour l'admin
    public function afficheVehiculeeAction($matricule)
    {
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->find($matricule);
        return($this->render("@Vehicule/backend/detailsVehicule.html.twig",array('v'=>$Vehicule)));
    }
    public function ajoutVehiculeAction(Request $request)
    {
        $Vehicule = new Vehicule();
        $form= $this->createForm(VehiculeType::class, $Vehicule);
        $form= $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $Vehicule->UploadProfilePicture();
            $em ->persist($Vehicule);
            $em->flush();
            return $this->redirectToRoute('vehicules_Admin_affiche');

        }
        return
            $this->render("@Vehicule/backend/ajoutvehicule.html.twig",
                array('f'=> $form->createView()));
    }
    public function updateAction(Request $request, $matricule)
    {
        $em = $this->getDoctrine()->getManager();
        $Vehicule = $em->getRepository( Vehicule::class)->find($matricule);
        $form= $this->createForm(VehiculeType::class, $Vehicule);
        $form= $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $Vehicule->UploadProfilePicture();
            $em->flush();
            return $this->redirectToRoute('vehicules_Admin_affiche');

        }
        return
            $this->render("@Vehicule/backend/updateVehicule.html.twig",
                array('f'=> $form->createView()));
    }
    public function deleteAction($matricule)
    {
        $em = $this->getDoctrine()->getManager();
       $Vehicule = $em->getRepository(Vehicule::class)->find($matricule);
        $em-> remove($Vehicule );
        $em->flush();
        return $this->redirectToRoute("vehicules_Admin_affiche") ;
    }



    //client
    // Affichage de vehicules dont l'etat est disponible
    public function readAction ()
    {
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->findBy(array('etat'=>'disponible'));
        return $this->render( '@Vehicule/frontend/read.html.twig', array('v'=>$Vehicule));
    }
    public function afficheCAction($matricule)
    {
        $Vehicule = $this->getDoctrine()->getRepository(Vehicule::class)->find($matricule);
        return($this->render("@Vehicule/frontend/location.html.twig",array('v'=>$Vehicule)));
    }
}
