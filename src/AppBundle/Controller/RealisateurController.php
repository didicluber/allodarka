<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Realisateur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Realisateur controller.
 *
 * @Route("realisateur")
 */
class RealisateurController extends Controller
{
    /**
     * Lists all realisateur entities.
     *
     * @Route("/", name="realisateur_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $realisateurs = $em->getRepository('AppBundle:Realisateur')->findAll();

        return $this->render('realisateur/index.html.twig', array(
            'realisateurs' => $realisateurs,
        ));
    }

    /**
     * Creates a new realisateur entity.
     *
     * @Route("/new", name="realisateur_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $realisateur = new Realisateur();
        $form = $this->createForm('AppBundle\Form\RealisateurType', $realisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($realisateur);
            $em->flush();

            return $this->redirectToRoute('realisateur_show', array('id' => $realisateur->getId()));
        }

        return $this->render('realisateur/new.html.twig', array(
            'realisateur' => $realisateur,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a realisateur entity.
     *
     * @Route("/{id}", name="realisateur_show")
     * @Method("GET")
     */
    public function showAction(Realisateur $realisateur)
    {
        $deleteForm = $this->createDeleteForm($realisateur);

        return $this->render('realisateur/show.html.twig', array(
            'realisateur' => $realisateur,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing realisateur entity.
     *
     * @Route("/{id}/edit", name="realisateur_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Realisateur $realisateur)
    {
        $deleteForm = $this->createDeleteForm($realisateur);
        $editForm = $this->createForm('AppBundle\Form\RealisateurType', $realisateur);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('realisateur_edit', array('id' => $realisateur->getId()));
        }

        return $this->render('realisateur/edit.html.twig', array(
            'realisateur' => $realisateur,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a realisateur entity.
     *
     * @Route("/{id}", name="realisateur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Realisateur $realisateur)
    {
        $form = $this->createDeleteForm($realisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($realisateur);
            $em->flush();
        }

        return $this->redirectToRoute('realisateur_index');
    }

    /**
     * Creates a form to delete a realisateur entity.
     *
     * @param Realisateur $realisateur The realisateur entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Realisateur $realisateur)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('realisateur_delete', array('id' => $realisateur->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
