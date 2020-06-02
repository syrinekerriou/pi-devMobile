<?php

namespace EtudesBundle\Controller;

use MyBundle\Entity\Cours;
use Symfony\Component\HttpFoundation\Request;
use MyBundle\Entity\Formation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyBundle\Form\FormationType;
use Symfony\Component\HttpFoundation\Response;

class FormationController extends Controller
{

    public function AffichageFormationAdminAction(){


        $em= $this->getDoctrine()->getManager();
        $formation =$em->getRepository('MyBundle:Formation')->findAll();
        return $this->render('@Etudes/Formation/AffichageFormationAdmin.html.twig',array(
            'Formation'=> $formation));
    }

    public function AjoutAction(Request $request)

    {
        $formation = new Formation();

        $form = $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $matiere=$formation->getMatiere();
            $em = $this->getDoctrine()->getManager();
            $array_foramtaion = $em->getRepository(Cours::class)->findByMatiere($matiere);
            if($array_foramtaion!=null)
            {
                $one_formation_objet=$array_foramtaion[0];
                $formation->setCoursId($one_formation_objet);
                $em->persist($formation);
                $em->flush();
                $this->addFlash('info', 'Created Successfully !');
                return $this->redirectToRoute('affichageformationadmin');
            }else
            {
                return new Response('erreur lors l affectation de cette matiere');
            }


        }


        return $this->render('@Etudes/Formation/AjouterFormation.html.twig',array(
            'Form'=> $form->createView()));
    }

    public function SupprimerFormationAction($qdt)
    {

        $em= $this->getDoctrine()->getManager();
        $formation =$em->getRepository('MyBundle:Formation')->find($qdt);
        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute('affichageformationadmin');


    }
    public function ModifierFormationAction(Request $request,$id)
    {

        $em=$this->getDoctrine()->getManager();
        $formation= $em->getRepository('MyBundle:Formation')->find($id);
        $form=$this->createForm(FormationType::class,$formation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formation);
            $em->flush();
            $this->addFlash('info', 'Created Successfully !');
            return $this->redirectToRoute('affichageformationadmin');
        }


        return $this->render('@Etudes/Formation/ModifierFormation.html.twig',array(
            'Form'=> $form->createView()));


    }
}
