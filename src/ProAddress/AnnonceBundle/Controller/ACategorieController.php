<?php

namespace ProAddress\AnnonceBundle\Controller;

use ProAddress\AnnonceBundle\Entity\ACategorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Acategorie controller.
 *
 * @Route("admin/acategorie")
 */
class ACategorieController extends Controller
{
    /**
     * Lists all aCategorie entities.
     *
     * @Route("/", name="admin_acategorie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $aCategories = $em->getRepository('ProAddressAnnonceBundle:ACategorie')->findAll();

        return $this->render('acategorie/index.html.twig', array(
            'aCategories' => $aCategories,
        ));
    }

    /**
     * Creates a new aCategorie entity.
     *
     * @Route("/new", name="admin_acategorie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $aCategorie = new Acategorie();
        $form = $this->createForm('ProAddress\AnnonceBundle\Form\ACategorieType', $aCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aCategorie);
            $em->flush();

            return $this->redirectToRoute('admin_acategorie_show', array('id' => $aCategorie->getId()));
        }

        return $this->render('acategorie/new.html.twig', array(
            'aCategorie' => $aCategorie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a aCategorie entity.
     *
     * @Route("/{id}", name="admin_acategorie_show")
     * @Method("GET")
     */
    public function showAction(ACategorie $aCategorie)
    {
        $deleteForm = $this->createDeleteForm($aCategorie);

        return $this->render('acategorie/show.html.twig', array(
            'aCategorie' => $aCategorie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing aCategorie entity.
     *
     * @Route("/{id}/edit", name="admin_acategorie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ACategorie $aCategorie)
    {
        $deleteForm = $this->createDeleteForm($aCategorie);
        $editForm = $this->createForm('ProAddress\AnnonceBundle\Form\ACategorieType', $aCategorie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_acategorie_edit', array('id' => $aCategorie->getId()));
        }

        return $this->render('acategorie/edit.html.twig', array(
            'aCategorie' => $aCategorie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a aCategorie entity.
     *
     * @Route("/{id}", name="admin_acategorie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ACategorie $aCategorie)
    {
        $form = $this->createDeleteForm($aCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aCategorie);
            $em->flush();
        }

        return $this->redirectToRoute('admin_acategorie_index');
    }

    /**
     * Creates a form to delete a aCategorie entity.
     *
     * @param ACategorie $aCategorie The aCategorie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ACategorie $aCategorie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_acategorie_delete', array('id' => $aCategorie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
