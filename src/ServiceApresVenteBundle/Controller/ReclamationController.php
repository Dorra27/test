<?php

namespace ServiceApresVenteBundle\Controller;

use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Entity\RecFeedCat;
use ServiceApresVenteBundle\Entity\Reclamation;
use ServiceApresVenteBundle\Form\FeedbackType;
use ServiceApresVenteBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class ReclamationController extends Controller
{
    public function indexAction()
    {
        return $this->render('ServiceApresVenteBundle:Default:index.html.twig');
    }


    //----------------------Traiter Etat---------------------------------------

    public function traiterEtatAction(Request $request) {
        $id = $request->get('idRec');

        $em = $this->getDoctrine()->getManager();
        $etat = $em
            ->getRepository(Reclamation::class)
            ->confirmer($id);
        $em->flush();
        return $this->redirectToRoute('admin_read_reclamation');
    }



    //-----------------------Read Reclamations---------------------------------
    public function readReclamationAction() {
        $reclamations=$this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();
        $count = $this->getDoctrine()->getRepository(Reclamation::class)->calculerTotalReclamation();

        if($count==0)
            $this->addFlash('info', 'Vous n"avez aucun Réclamation envoyée :) !');




        return $this->render('@ServiceApresVente/Reclamation/readReclamation.html.twig',
            array("reclamations"=>$reclamations,
                "count"=>$count));
    }

    //-----------------------Create Reclamations---------------------------------
    public function createReclamationAction(Request $request,RecFeedCat $id)
    {
        $id=$this->getDoctrine()->getManager()->getRepository(RecFeedCat::class)->find($id);
        $reclamations = new Reclamation();
        $form = $this->createForm(ReclamationType::class, $reclamations);
        $user = $this->getUser();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('kernel.project_dir').'/web/uploads/reclamation_image',$filename);

            $reclamations->setIdc($id);
            $reclamations->setImage($filename);
            $reclamations->setDate(new \DateTime('now'));

            $reclamations->setEtat(0);
            $reclamations->setId(1);
            $em->persist($reclamations);
            $em->flush();

            $this->addFlash('info', 'Envoyer réclamation avec succés !');


            return $this->redirectToRoute("read_reclamation");
        }
        return $this->render("@ServiceApresVente/Reclamation/createReclamation.html.twig", array("form" => $form->createView()));
    }
    //--------------------------------------------------------

    public function updateReclamationAction(Request $request ,$id)
    {
        $reclamation = $this->getDoctrine()->getManager()->getRepository(Reclamation::class)->find($id);
        $form = $this->createForm(ReclamationType::class, $reclamation);

//        if($reclamation->getEtat()==1) {
//            $this->addFlash('info', 'Réclamation etait traiter par admin vous n"avez pas le droit de le modifier :) !');
//
//        }

        $form->handleRequest($request);
        if ($form->isValid()) {

            $file = $reclamation->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('kernel.project_dir').'/web/uploads/reclamation_image',$filename);
            $reclamation->setImage($filename);
            $reclamation->setDate(new \DateTime('now'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('read_reclamation');

        }
        return $this->render("@ServiceApresVente/Reclamation/updateReclamation.html.twig", array("form" => $form->createView()));
    }

    public function listReclamationAction() {
        $reclamations=$this->getDoctrine()->getManager()->getRepository(Reclamation::class)->findAll();
        $count = $this->getDoctrine()->getRepository(Reclamation::class)->calculerTotalReclamation();
        if($count==0)
            $this->addFlash('info', 'Vous n"avez aucun Reclamation recu :) !');




        return $this->render('@ServiceApresVente/Admin/readReclamation.html.twig',array("reclamations"=>$reclamations,"count"=>$count));
    }


    public function showdetailedAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $f=$em->getRepository(Reclamation::class)->find($id);
        return $this->render('@ServiceApresVente/Reclamation/showDetaillOne.html.twig', array(
            'date'=>$f->getDate(),
            'image'=>$f->getImage(),
            'objet'=>$f->getObjet(),
            'descripion'=>$f->getDescription(),
            'categorie'=>$f->getIdc(),
            'id'=>$f->getIdRec()
        ));
    }


}
