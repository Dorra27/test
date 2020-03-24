<?php

namespace EmployeBundle\Controller;

use EmployeBundle\Entity\Employe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Employee controller.
 *
 * @Route("employee")
 */
class employeeController extends Controller
{
    /**
     * Lists all employee entities.
     *
     * @Route("/", name="employee_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository('EmployeBundle:Employe')->findAll();

        return $this->render('@Employe/Employee/index_two.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new employee entity.
     *
     * @Route("/new", name="employee_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Employe();

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

//    /**
//     * Finds and displays a employee entity.
//     *
//     * @Route("/{id}", name="employee_show")
//     * @Method("GET")
//     */
//    public function showAction(Employe $employee)
//    {
//        $deleteForm = $this->createDeleteForm($employee);
//
//        return $this->render('employee/show.html.twig', array(
//            'employee' => $employee,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }

    /**
     * Displays a form to edit an existing employee entity.
     *
     * @Route("/{id}/edit", name="employee_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employe $employee)
    {
//        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createFormBuilder($employee)
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
                    'Maybe' => null,
                    'Yes' => true,
                    'No' => false,
                ],
            ])
//            ->add('dueDate')
            ->getForm();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employee_index');
        }

        return $this->render('@Employe/employee/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a employee entity.
     *
     * @Route("/{id}", name="employee_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employe $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        }

        return $this->redirectToRoute('employee_index');
    }

    /**
     * Creates a form to delete a employee entity.
     *
     * @param Employe $employee The employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
//    private function createDeleteForm(Employe $employee)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('employee_delete', array('id' => $employee->getIdEmp())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
    /**
     * @Route("/delete/{id}", name="employee_delete", methods={"GET"})
     */
    public function delete(Request $request, Employe $employe, $id)
    {
            $entityManager = $this->getDoctrine()->getManager();
            $employes = $entityManager->getRepository('EmployeBundle:Employe')->find($id);
                $entityManager->remove($employes);
                $entityManager->flush();





        return $this->redirectToRoute('employee_index');
    }
}
