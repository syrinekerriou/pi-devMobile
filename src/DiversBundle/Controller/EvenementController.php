<?php

namespace DiversBundle\Controller;

use MyBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Twilio\Rest\Client;
/**
 * Evenement controller.
 *
 * @Route("admin/backoffice/evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     * @Route("/", name="evenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('MyBundle:Evenement')->findAll();

        return $this->render('@Divers/Divers/evenement/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }



    /**
     * Lists all evenement entities.
     *
     * @Route("/tri", name="evenement_tri")
     * @Method("GET")
     */
    public function indextriAction()
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('MyBundle:Evenement')->findAllTri();

        return $this->render('@Divers/Divers/evenement/index.html.twig', array(
            'evenements' => $evenements,
        ));
    }



    /**
     * Lists all evenement entities.
     *
     * @Route("/notification", name="notification")
     * @Method("GET")
     */
    public function notifiAction()
    {
        try{



            $sid    = "ACba92ed763071c116e9908993587d5403";
            $token  = "b5e7207b3e3ed39aaf2d3ddd7e6439c1";
            $twilio = new Client($sid, $token);

            $message = $twilio->messages
                ->create("+15558675310", // to
                    array("from" => "+15017122661", "body" => "body")
                );

            print($message->sid);

        }catch(\Exception $e) {


        }

       return $this->render('@Divers/Divers/evenement/index.html.twig');
    }












    public function displayAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT a FROM MyBundle:Evenement a";
        $query = $em->createQuery($dql);
       // $evenements = $em->getRepository('MyBundle:Evenement')->findAll();
        $paginator = $this->get('knp_paginator');
        $evenements = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('@Divers/Divers/front/evenement.html.twig', array(
            'evenements' => $evenements,
        ));
    }










    /**
     * Creates a new evenement entity.
     *
     * @Route("/new", name="evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createForm('DiversBundle\Form\EvenementType', $evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_show', array('id' => $evenement->getId()));
        }

        return $this->render('@Divers/Divers/evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/{id}", name="evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('@Divers/Divers/evenement/show.html.twig', array(
            'evenement' => $evenement,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     * @Route("/{id}/edit", name="evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('DiversBundle\Form\EvenementType', $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_edit', array('id' => $evenement->getId()));
        }

        return $this->render('@Divers/Divers/evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenement entity.
     *
     * @Route("/delete/{id}", name="evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction($id)
    {

        $em= $this->getDoctrine()->getManager();
        $evenement =$em->getRepository('MyBundle:Evenement')->find($id);
        $em->remove($evenement);
        $em->flush();
        return $this->redirectToRoute('evenement_index');
    }



    /**
     * Creates a form to delete a evenement entity.
     *
     * @param Evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenement_delete', array('id' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }



}
