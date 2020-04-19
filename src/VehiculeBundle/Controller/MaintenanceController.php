<?php

namespace VehiculeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VehiculeBundle\Entity\MaintenaceVehicule;
use VehiculeBundle\Entity\Vehicule;
use VehiculeBundle\Form\MaintenaceVehiculeType;

class MaintenanceController extends Controller
{
    public function indexAction()
    {
        return $this->render('VehiculeBundle:Default:index.html.twig');
    }
    public function maintenirAction(Request $request,$matricule)
    {
        $MaintenaceVehicule =new MaintenaceVehicule();
        $form = $this->createForm(MaintenaceVehiculeType::class,$MaintenaceVehicule);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $Vehicule = $em->getRepository(Vehicule::class)->find($matricule);
            $MaintenaceVehicule->setVehicule($Vehicule);

            $em->persist($MaintenaceVehicule);
            $em->flush();
            $this->addFlash('info', 'Vehicule maintenue avec succes');

            return $this->redirectToRoute('vehicules_Admin_vehiculesmaintenues');
        }
        return
            $this->render("@Vehicule/backend/maintenirvehicule.html.twig",
                array('f' => $form->createView()));

    }
    public function VehiculeMaintenuesAction(Request $request)
    {
        $maintenu = $this->getDoctrine()->resetManager()->getRepository(MaintenaceVehicule::class)->findAll();
        /**
         * @var  $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result= $paginator->paginate(
            $maintenu,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',5 )

        );

        return $this->render('@Vehicule/backend/VehiculeMaintenues.html.twig', array('m' => $result));
    }
    public function RechercherVMAction($matricule)
    {
        $maintenu = $this->getDoctrine()->resetManager()->getRepository(MaintenaceVehicule::class)->find($matricule);
        return $this->render('@Vehicule/backend/VehiculeMaintenues.html.twig', array('m' => $maintenu));
    }
}
