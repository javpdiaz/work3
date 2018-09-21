<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserRegister;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Clase de control de usuarios registrados
 *
 * @Route("usermanager")
 */

class UserManagerController extends Controller
{
    /**
     * @Route("/", name="usermanager_index_page")
     */
    public function indexAction()
    {

        $registerUser = $this->getDoctrine()->getManager()
            ->getRepository(User::class)
            ->findAll();

        return $this->render('usermanager/usermanager.html.twig', array('registerUser' => $registerUser));
    }


    /**
     * @Route("/{id}/edit", name="usermanager_edit")
     */
    public function editAction(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder){

        $editForm = $this->createForm(UserRegister::class, $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()){


            if (!is_null($user->getPlainPassword())) { //para evitar que cambie la contraseña en caso de editar y el campo esté vacio
                $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
                $user->setPassword($password);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('usermanager_index_page');
        }

        return $this->render('usermanager/edituser.html.twig', array(

            'edit_form'=>$editForm->createView()
        ));

    }


    /**
     * @Route("/new", name="usermanager_new")
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserRegister::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('princ_page');
        }

        return $this->render('usermanager/newuser.html.twig', array('new_form'=>$form->createView()));
    }


    /**
     * @Route("/{id}", name="usermanager_delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $salv = $this->getDoctrine()->getRepository(User::class)->find($id);
        $salv->setHide(true);

        $em->persist($salv);
        $em->flush();


        return $this->redirectToRoute('usermanager_index_page');
    }
}
