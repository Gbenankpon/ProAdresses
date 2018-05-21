<?php

namespace ProAddress\AppBundle\Controller;

use ProAddress\AppBundle\Entity\Pays;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pay controller.
 *
 * @Route("admin/pays")
 */
class PaysController extends Controller
{
    /**
     * Lists all pay entities.
     *
     * @Route("/", name="admin_pays_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pays = $em->getRepository('ProAddressAppBundle:Pays')->findAll();

        return $this->render('pays/index.html.twig', array(
            'pays' => $pays,
        ));
    }

    /**
     * Creates a new pay entity.
     *
     * @Route("/new", name="admin_pays_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pay = new Pay();
        $form = $this->createForm('ProAddress\AppBundle\Form\PaysType', $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pay);
            $em->flush();

            return $this->redirectToRoute('admin_pays_show', array('id' => $pay->getId()));
        }

        return $this->render('pays/new.html.twig', array(
            'pay' => $pay,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pay entity.
     *
     * @Route("/{id}", name="admin_pays_show")
     * @Method("GET")
     */
    public function showAction(Pays $pay)
    {
        $deleteForm = $this->createDeleteForm($pay);

        return $this->render('pays/show.html.twig', array(
            'pay' => $pay,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pay entity.
     *
     * @Route("/{id}/edit", name="admin_pays_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Pays $pay)
    {
        $deleteForm = $this->createDeleteForm($pay);
        $editForm = $this->createForm('ProAddress\AppBundle\Form\PaysType', $pay);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_pays_edit', array('id' => $pay->getId()));
        }

        return $this->render('pays/edit.html.twig', array(
            'pay' => $pay,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pay entity.
     *
     * @Route("/{id}", name="admin_pays_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Pays $pay)
    {
        $form = $this->createDeleteForm($pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pay);
            $em->flush();
        }

        return $this->redirectToRoute('admin_pays_index');
    }

    /**
     * Creates a form to delete a pay entity.
     *
     * @param Pays $pay The pay entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Pays $pay)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_pays_delete', array('id' => $pay->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
