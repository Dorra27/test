<?php

namespace ServiceApresVenteBundle\Controller;

use blackknight467\StarRatingBundle\Form\RatingType;
use blackknight467\StarRatingBundle\StarRatingBundle;
use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Entity\RecFeedCat;
use ServiceApresVenteBundle\Form\FeedbackType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TresorerieBundle\Entity\FactureAchat;
use TresorerieBundle\Form\RecouvrementClientChequeType;
use VenteBundle\Entity\Categorie;

class FeedbackController extends Controller
{

    public function indexAction() {
        return $this->render('@ServiceApresVente/Default/index.html.twig');

    }

    public function readFeedbackAction() {
        $feedbacks=$this->getDoctrine()->getManager()->getRepository(Feedback::class)->findAll();
        $count = $this->getDoctrine()->getRepository(Feedback::class)->calculerTotalFeedback();
        if($count==0)
            $this->addFlash('info', 'Vous n"avez aucun Feedbacks envoyée :) !');

        return $this->render('@ServiceApresVente/Feedback/readFeedback.html.twig',array("feedbacks"=>$feedbacks,"count"=>$count));
    }


    //--------------------------------------------------------
    public function createFeedbackAction(Request $request,RecFeedCat $id)
    {
        $cat =$this->getDoctrine()->getManager()->getRepository(RecFeedCat::class)->find($id);

        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('kernel.project_dir').'/web/uploads/feedback_image',$filename);
            $feedback->setIdc($cat);



            $feedback->setImage($filename);
            $feedback->setDatefeedback(new \DateTime('now'));




            $em->persist($feedback);
            $em->flush();

            $this->addFlash('info', 'Création avec succés !');


            return $this->redirectToRoute("read_feedback");
        }
        return $this->render("@ServiceApresVente/Feedback/createFeedback.html.twig", array("form" => $form->createView()));
    }
    //--------------------------------------------------------
    public function updateFeedbackAction(Request $request ,$id)
    {

        $feedback = $this->getDoctrine()->getManager()->getRepository(Feedback::class)->find($id);
        $form = $this->createForm(FeedbackType::class, $feedback);

        $form->handleRequest($request);
        if ($form->isValid()) {

            $file = $feedback->getImage();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('kernel.project_dir').'/web/uploads/feedback_image',$filename);
            $feedback->setImage($filename);
            $feedback->setDatefeedback(new \DateTime('now'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($feedback);
            $em->flush();

            return $this->redirectToRoute('read_feedback');

        }
        return $this->render("@ServiceApresVente/Feedback/updateFeedback.html.twig", array("form" => $form->createView()));
    }



//    public function deleteFeedbackAction($id) {
//        $el=$this->getDoctrine()->getManager();
//        $em=$el->getRepository(Feedback::class)->find($id);
//        $el->remove($em);
//        $el->flush();
//
//        return $this->redirectToRoute('read_feedback');
//    }

//
//
//    public function AjouterRateAction($idu, $idp, $value)
//    {
//        $rate = new Rate();
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository(User::class)->find($idu);
//        $produit = $em->getRepository(Produit::class)->find($idp);
//        $rate->setIduser($user->getId());
//        $rate->setIdproduit($produit->getId());
//        $rate->setValue($value);
//        $em->persist($rate);
//        $em->flush();
//        $serializer = new Serializer([new ObjectNormalizer()]);
//        $formatted = $serializer->normalize($rate);
//        return new JsonResponse($formatted);
//
//    }


    public function ShowdetailedanAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository(Feedback::class)->find($id);


             return $this->render('ServiceAprésVenteBundle/Admin/readFeedback.html.twig', array(
                 'entity'      => $entity,
        ));
    }

    public function listFeedbackAction() {
        $feedbacks=$this->getDoctrine()->getManager()->getRepository(Feedback::class)->findAll();
        $count = $this->getDoctrine()->getRepository(Feedback::class)->calculerTotalFeedback();
        if($count==0)
            $this->addFlash('info', 'Vous n"avez aucun Feedbacks recu :) !');




        return $this->render('@ServiceApresVente/Admin/readFeedback.html.twig',array("feedbacks"=>$feedbacks,"count"=>$count));
    }









}
