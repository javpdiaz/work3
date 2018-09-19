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
}
