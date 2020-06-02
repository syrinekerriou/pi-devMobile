<?php

namespace DiversBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use MyBundle\Entity\Offre;
use DiversBundle\Form\OffreType;
use Symfony\Component\HttpFoundation\Response;

class OffreController extends Controller
{

    public function showAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
       // $offre = $em->getRepository('MyBundle:Offre')->findAll();
        $dql   = "SELECT a FROM MyBundle:Offre a";
        $query = $em->createQuery($dql);
        $paginator = $this->get('knp_paginator');
        $offre = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            2 /*limit per page*/
        );

        // paramet
        return $this->render('@Divers/Divers/front/offre.html.twig', array(
            'offre' => $offre));
    }


    public function showbackAction()
    {
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('MyBundle:Offre')->findAll();
        return $this->render('@Divers/Divers/back/offre.html.twig', array(
            'offre' => $offre));
    }




    public function showbacktriAction()
    {
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('MyBundle:Offre')->findAllTri();
        return $this->render('@Divers/Divers/back/offre.html.twig', array(
            'offre' => $offre));
    }





    public function addAction(Request $request)
    {
        $offre = new offre();
        $form = $this->createForm(OffreType::class,$offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $offre->getPhoto();
            $filename= md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $filename);
            $offre->setPhoto($filename);

            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush();
            $this->addFlash('info', 'Created Successfully !');
            return $this->redirectToRoute('offreback');
        }


        return $this->render('@Divers/Divers/back/offreadd.html.twig',array(
            'Form'=> $form->createView()));

    }


    public function editAction(Request $request,$id)
    {
        $offre = new offre();
        $em=$this->getDoctrine()->getManager();
        $offre= $em->getRepository('MyBundle:Offre')->find($id);
        $form=$this->createForm(OffreType::class,$offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $file = $offre->getPhoto();
            $filename= md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('photos_directory'), $filename);
            $offre->setPhoto($filename);

            $em->persist($offre);
            $em->flush();
            $this->addFlash('info', 'update Successfully !');
            return $this->redirectToRoute('offreback');
        }


        return $this->render('@Divers/Divers/back/offreadd.html.twig',array(
            'Form'=> $form->createView()));

    }


    public function deleteAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $offre =$em->getRepository('MyBundle:Offre')->find($id);
        $em->remove($offre);
        $em->flush();
        return $this->redirectToRoute('offreback');
    }



    public function searchAction(Request $request)
    {
        //$k = new offre();
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $k = $em->getRepository('MyBundle:Offre')->findByNom($requestString);
        if(!$k) {
            $result['offre'] = "Offre Not found :( ";
        } else {
            foreach($k as $z) {
            $result['id'] = $z->getId();
            $result['Prix'] = $z->getPrix();
            $result['DateF'] = $z->getDateFin();
            $result['DateD'] = $z->getDateDebut();
            $result['DESCRIPTION'] = $z->getDescription();
            }
        }
        return new Response(json_encode($result));
    }



}
