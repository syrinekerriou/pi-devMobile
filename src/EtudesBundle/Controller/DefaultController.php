<?php

namespace EtudesBundle\Controller;

use MyBundle\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function etudesAction()
    {
        return $this->render('@Etudes/Default/etudes.html.twig');
    }
    public function coursAction()
    {
        $cours=$this->getDoctrine()->getRepository(Cours::class)->findAll();
        return $this->render('@Etudes/Default/cours.html.twig',array(
            'Cours'=>$cours
        ));
    }
}

