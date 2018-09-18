<?php

namespace BCS\UserManagerBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserRegister;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BCSRegistrationController extends Controller
{

    /**
     * @Route("/registrousuario", name="bcs_registro_page")
     */
    public function indexAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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

        return $this->render('registration/register.html.twig', array('form'=>$form->createView()));
    }
}
