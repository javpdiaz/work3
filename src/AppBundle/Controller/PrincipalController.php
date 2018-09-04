<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends Controller
{
    /**
     * @Route("/", name="princ_page")
     */
    public function indexAction()
    {
        return $this->render('princ/princ.html.twig');
    }
}
