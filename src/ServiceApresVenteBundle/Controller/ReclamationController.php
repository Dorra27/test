<?php

namespace ServiceApresVenteBundle\Controller;

use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Entity\Reclamation;
use ServiceApresVenteBundle\Form\FeedbackType;
use ServiceApresVenteBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServiceApresVenteBundle:Default:index.html.twig');
    }

    //-----------------------Read Reclamations---------------------------------
    public function readReclamationAction() {
        $reclamations=$this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();
        return $this->render('@ServiceApresVente/Reclamation/readReclamation.html.twig',array("reclamations"=>$reclamations));
    }

    //-----------------------Create Reclamations---------------------------------
    public function createReclamationAction(Request $request)
    {
        $reclamations = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamations);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('kernel.project_dir').'/web/uploads/reclamation_image',$filename);


            $reclamations->setImage($filename);
            $reclamations->setDate(new \DateTime('now'));


            $em->persist($reclamations);
            $em->flush();

            $this->addFlash('info', 'Envoyer réclamation avec succés !');


            return $this->redirectToRoute("read_reclamation");
        }
        return $this->render("@ServiceApresVente/Reclamation/createReclamation.html.twig", array("form" => $form->createView()));
    }
    //--------------------------------------------------------


}
