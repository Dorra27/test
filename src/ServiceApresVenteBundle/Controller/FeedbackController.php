<?php

namespace ServiceApresVenteBundle\Controller;

use ServiceApresVenteBundle\Entity\Feedback;
use ServiceApresVenteBundle\Form\FeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;

class FeedbackController extends Controller
{

    public function readFeedbackAction() {
        $feedbacks=$this->getDoctrine()->getManager()->getRepository(Feedback::class)->findAll();
        return $this->render('@ServiceApresVente/Feedback/readFeedback.html.twig',array("feedbacks"=>$feedbacks));
    }

    //--------------------------------------------------------
    public function createFeedbackAction(Request $request)
    {
        $feedback = new Feedback();
        $form = $this->createForm(FeedbackType::class, $feedback);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['image']->getData();
            $filename = md5(uniqid()) . '.' . $uploadedFile->guessExtension();
            $uploadedFile->move($this->getParameter('kernel.project_dir').'/web/uploads/feedback_image',$filename);


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
    public function deleteFeedbackAction($id) {
        $el=$this->getDoctrine()->getManager();
        $em=$el->getRepository(Feedback::class)->find($id);
        $el->remove($em);
        $el->flush();

        return $this->redirectToRoute('read_feedback');
    }

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
        $an = $em->getRepository(Feedback::class)->find($id);


        return $this->render('@Annonce/Default/showDetaillOne.html.twig', array(
            'description' => $an->getDescription(),
            'note' => $an->getNote(),
            'id', $an->getId(),
            'idCommande' => $an,

            'image' => $an->getImage(), 'id_feed' => $id
        ));
    }




}
