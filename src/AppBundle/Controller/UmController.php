<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Um;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Um controller.
 *
 * @Route("um")
 */
class UmController extends Controller
{
    /**
     * Lists all um entities.
     *
     * @Route("/", name="um_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ums = $em->getRepository('AppBundle:Um')->findAll();

        return $this->render('um/index.html.twig', array(
            'ums' => $ums,
        ));
    }

    /**
     * Creates a new um entity.
     *
     * @Route("/new", name="um_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $um = new Um();
        $form = $this->createForm('AppBundle\Form\UmType', $um);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($um);
            $em->flush();

            //return $this->redirectToRoute('um_show', array('id' => $um->getId()));
            return $this->redirectToRoute('um_index', array('id' => $um->getId()));
        }

        return $this->render('um/new.html.twig', array(
            'um' => $um,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a um entity.
     *
     * @Route("/{id}", name="um_show")
     * @Method("GET")
     */
    public function showAction(Um $um)
    {
        $deleteForm = $this->createDeleteForm($um);

        return $this->render('um/show.html.twig', array(
            'um' => $um,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing um entity.
     *
     * @Route("/{id}/edit", name="um_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Um $um)
    {
        $deleteForm = $this->createDeleteForm($um);
        $editForm = $this->createForm('AppBundle\Form\UmType', $um);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('um_edit', array('id' => $um->getId()));
            return $this->redirectToRoute('um_index', array('id' => $um->getId()));
        }

        return $this->render('um/edit.html.twig', array(
            'um' => $um,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a um entity.
     *
     * @Route("/{id}", name="um_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Um $um)
    {
        $form = $this->createDeleteForm($um);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($um);
            $em->flush();
        }

        return $this->redirectToRoute('um_index');
    }

    /**
     * Creates a form to delete a um entity.
     *
     * @param Um $um The um entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Um $um)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('um_delete', array('id' => $um->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
