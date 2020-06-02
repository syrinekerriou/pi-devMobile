<?php

namespace EtudesBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use MyBundle\Entity\User;
use MyBundle\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;


use MyBundle\Form\CoursType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\HttpFoundation\Response;
use MyBundle\Repository\CoursRepository;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class CoursController extends Controller
{
    public function AffichageAdminAction(){


        $em= $this->getDoctrine()->getManager();
        $cours =$em->getRepository('MyBundle:Cours')->findAll();
        return $this->render('@Etudes/Cours/AffichageAdmin.html.twig',array(
            'Cours'=> $cours));
    }

    public function AjoutAction(Request $request)

    {
        $user=$this->getUser();

        if( !is_object($user) || !$user instanceof UserInterface  ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $cours = new Cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();

            //ici l'envoi du mail
            $message = \Swift_Message::newInstance()
                ->setSubject('Nouveau vour disponnible')
                ->setFrom('dragozoudo@gmail.com')
                ->setTo($user->getEmailCanonical())
                ->setCharset('utf-8')
                ->setContentType('text/html')
                ->setBody($this->renderView('@Etudes/Cours/email.html.twig'));

            $this->addFlash('info', 'Created Successfully !');
            return $this->redirectToRoute('affichagecoursadmin');
        }


        return $this->render('@Etudes/Cours/Ajout.html.twig',array(
            'Form'=> $form->createView()));
    }

    public function SupprimerCoursAction($qdt)
    {

        $em= $this->getDoctrine()->getManager();
        $Cours =$em->getRepository('MyBundle:Cours')->find($qdt);
        $em->remove($Cours);
        $em->flush();
        return $this->redirectToRoute('affichagecoursadmin');


    }

    public function ModifierCoursAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $cours= $em->getRepository('MyBundle:cours')->find($id);
        $form=$this->createForm(CoursType::class,$cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();
            $this->addFlash('info', 'Created Successfully !');
            return $this->redirectToRoute('affichagecoursadmin');
        }


        return $this->render('@Etudes/Cours/ModifierCours.html.twig',array(
            'Form'=> $form->createView()));




    }

    public function frontshowcoursAction(Request $request){


        $em= $this->getDoctrine()->getManager();
        $cours =$em->getRepository('MyBundle:Cours')->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator =$this->get('knp_paginator');
        $listcours = $paginator->paginate(
            $cours,
            $request->query->getInt('page',2),
            $request->query->getInt('limit',2)
        );



        return $this->render('@Etudes/Cours/frontshow.html.twig',array(
            'Cours'=> $listcours));
    }




    public function getRealEntities($entities){

        foreach ($entities as $Cours){
            $realEntities[$Cours->getId()] = [$Cours->getTitreCours(), $Cours->getMatiere(), $Cours->getDuree(), $Cours->getPDFName(),$Cours->getImageName()];        }

        return $realEntities;
    }


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $requestString = $request->get('q');

        $entities =  $em->getRepository('MyBundle:Cours')->findEntitiesByString($requestString);

        if(!$entities) {
            $result['entities']['error'] = "Aucun cours trouvée";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }


    public function sortAction($sort)
    {
        $user=$this->getUser();

        if( !is_object($user) || !$user instanceof UserInterface  ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);

        $entityManager = $this->getDoctrine()->getManager();

        if ($sort=='ASC'){
            $query = $entityManager->createQuery(
                'SELECT c
    FROM MyBundle:Cours c
    ORDER BY c.titreCours ASC'
            );
        }else {
            $query = $entityManager->createQuery(
                'SELECT c
    FROM MyBundle:Cours c
    ORDER BY c.titreCours  DESC'
            );
        }



        $Cours = $query->getResult();

        return $this->render('@Etudes/Cours/sort.html.twig', array('Cours'=>$Cours));
    }


}
