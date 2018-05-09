<?php

namespace ProAddress\ServiceBundle\Controller;

use ProAddress\ServiceBundle\Entity\SCategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Scategorie controller.
 *
 * @Route("admin/scategorie")
 */
class SCategorieController extends Controller
{
    /**
     * Lists all sCategorie entities.
     *
     * @Route("/", name="admin_scategorie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sCategories = $em->getRepository('ProAddressServiceBundle:SCategorie')->findAll();

        return $this->render('scategorie/index.html.twig', array(
            'sCategories' => $sCategories,
        ));
    }

    /**
     * Creates a new sCategorie entity.
     *
     * @Route("/new", name="admin_scategorie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $sCategorie = new Scategorie();
        $form = $this->createForm('ProAddress\ServiceBundle\Form\SCategorieType', $sCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sCategorie);
            $em->flush();

            return $this->redirectToRoute('admin_scategorie_show', array('id' => $sCategorie->getId()));
        }

        return $this->render('scategorie/new.html.twig', array(
            'sCategorie' => $sCategorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sCategorie entity.
     *
     * @Route("/{id}", name="admin_scategorie_show")
     * @Method("GET")
     */
    public function showAction(SCategorie $sCategorie)
    {
        $deleteForm = $this->createDeleteForm($sCategorie);

        return $this->render('scategorie/show.html.twig', array(
            'sCategorie' => $sCategorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sCategorie entity.
     *
     * @Route("/{id}/edit", name="admin_scategorie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SCategorie $sCategorie)
    {
        $deleteForm = $this->createDeleteForm($sCategorie);
        $editForm = $this->createForm('ProAddress\ServiceBundle\Form\SCategorieType', $sCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_scategorie_edit', array('id' => $sCategorie->getId()));
        }

        return $this->render('scategorie/edit.html.twig', array(
            'sCategorie' => $sCategorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sCategorie entity.
     *
     * @Route("/{id}", name="admin_scategorie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SCategorie $sCategorie)
    {
        $form = $this->createDeleteForm($sCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sCategorie);
            $em->flush();
        }

        return $this->redirectToRoute('admin_scategorie_index');
    }

    /**
     * Creates a form to delete a sCategorie entity.
     *
     * @param SCategorie $sCategorie The sCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SCategorie $sCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_scategorie_delete', array('id' => $sCategorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
