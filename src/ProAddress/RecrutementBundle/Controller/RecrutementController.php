<?php

namespace ProAddress\RecrutementBundle\Controller;

use ProAddress\RecrutementBundle\Entity\Recrutement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Recrutement controller.
 *
 * @Route("admin/recrutement")
 */
class RecrutementController extends Controller
{
    /**
     * Lists all recrutement entities.
     *
     * @Route("/", name="admin_recrutement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recrutements = $em->getRepository('ProAddressRecrutementBundle:Recrutement')->findAll();

        return $this->render('recrutement/index.html.twig', array(
            'recrutements' => $recrutements,
        ));
    }

    /**
     * Creates a new recrutement entity.
     *
     * @Route("/new", name="admin_recrutement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $recrutement = new Recrutement();
        $form = $this->createForm('ProAddress\RecrutementBundle\Form\RecrutementType', $recrutement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recrutement);
            $em->flush();

            return $this->redirectToRoute('admin_recrutement_show', array('id' => $recrutement->getId()));
        }

        return $this->render('recrutement/new.html.twig', array(
            'recrutement' => $recrutement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recrutement entity.
     *
     * @Route("/{id}", name="admin_recrutement_show")
     * @Method("GET")
     */
    public function showAction(Recrutement $recrutement)
    {
        $deleteForm = $this->createDeleteForm($recrutement);

        return $this->render('recrutement/show.html.twig', array(
            'recrutement' => $recrutement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recrutement entity.
     *
     * @Route("/{id}/edit", name="admin_recrutement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Recrutement $recrutement)
    {
        $deleteForm = $this->createDeleteForm($recrutement);
        $editForm = $this->createForm('ProAddress\RecrutementBundle\Form\RecrutementType', $recrutement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_recrutement_edit', array('id' => $recrutement->getId()));
        }

        return $this->render('recrutement/edit.html.twig', array(
            'recrutement' => $recrutement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recrutement entity.
     *
     * @Route("/{id}", name="admin_recrutement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Recrutement $recrutement)
    {
        $form = $this->createDeleteForm($recrutement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recrutement);
            $em->flush();
        }

        return $this->redirectToRoute('admin_recrutement_index');
    }

    /**
     * Creates a form to delete a recrutement entity.
     *
     * @param Recrutement $recrutement The recrutement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Recrutement $recrutement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_recrutement_delete', array('id' => $recrutement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
