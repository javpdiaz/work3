<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\UserLogin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{

    /**
     * @Route("/login", name="login")
     */
    public function LoginAction(Request $request, AuthenticationUtils $authenticationUtils)
    {
        $user = new User();
        $form = $this->createForm(UserLogin::class, $user);

        $error = $authenticationUtils->getLastAuthenticationError();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('princ_page');
        }

        return $this->render('login/login.html.twig', array('form'=>$form->createView(), 'error'=>$error));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function LogoutAction(){
//        return $this->redirect('/login');
    }
}
