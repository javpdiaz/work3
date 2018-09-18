<?php

namespace BCS\UserManagerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/usermanager", name="usermanager_page")
     */
    public function indexAction()
    {
        return $this->render('@BCSUserManager/Default/index.html.twig');
    }
}
