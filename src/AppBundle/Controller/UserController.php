<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/login2", name="login_page")
     */
    public function indexAction()
    {
        return $this->render('userform/login.html.twig');
    }
}
