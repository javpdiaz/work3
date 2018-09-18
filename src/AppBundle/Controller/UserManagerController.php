<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserRegister;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
    public function editAction(Request $request, User $user){

        $editForm = $this->createForm(UserRegister::class, $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()){
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usermanager_index_page');
        }

        return $this->render('usermanager/edituser.html.twig', array(

            'edit_form'=>$editForm->createView()
        ));

    }
}
