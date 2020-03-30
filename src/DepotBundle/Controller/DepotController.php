<?php

namespace DepotBundle\Controller;

use DepotBundle\Entity\Depot;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Depot controller.
 *
 * @Route("depot")
 */
class DepotController extends Controller
{
    /**
     * Lists all depot entities.
     *
     * @Route("/", name="depot_index")
     * @Method("GET")
     */
    public function indexAction()
    {


        return $this->render('@Depot/index.html.twig');
    }

    /**
     *
     * @Route("/new", name="depot_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Depot();

        $form = $this->createFormBuilder($employee)
            ->add('CIN', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre CV',

                ],
            ])
            ->add('ADRESSE', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Adresse',

                ],
            ])
            ->add('USERNAME', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Nom',

                ],
            ])
            ->add('EMAIL', TextType::class,[
                'attr' => [
                    'error_bubbling' => true,
                    'placeholder' => 'Entrer Votre Eamil',

                ],
            ])
            ->add('PRENOM', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Prénom',

                ],
            ])
            ->add('DATENAISSANCE',DateType::class,[
                'widget' => 'single_text',
            ])
            ->add('Telephone', TextType::class,[
                'attr' => [
                    'placeholder' => 'Entrer Votre Télephone',

                ],
            ])
            ->add('MISSION',ChoiceType::class, [
                'choices'  => [
                    'Livreur' => 'Livreur',
                    'Techniciens' => 'Techniciens',
                    'Ouvrier' => 'Ouvrier',
                    'Ingénieur' => 'Ingénieur',
                ],
            ])
//            ->add('dueDate')
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $employee->setRoles('EMPLOYE');
            $em = $this->getDoctrine()->getManager();

            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employee_index');
            echo 'ok';
        }

        return $this->render('@Employe/employee/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }


}
