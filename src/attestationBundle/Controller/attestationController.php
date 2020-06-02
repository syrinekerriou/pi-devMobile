<?php

namespace attestationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use MyBundle\Entity\attestation;
use MyBundle\Entity\User;
use attestationBundle\Form\attestationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class attestationController extends Controller
{
    public function addatAction(Request $request)
    {
        $user=$this->getUser();
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $rec=new attestation();

        $rec->setIdUser($user);
        $form=$this->createForm(attestationType::class,$rec);
        $form=$form->handleRequest($request);
        if($form->isValid() )
        {
            $rec->setTypea($form['typea']->getData());
            $rec->setLangue($form['langue']->getData());
            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('attestation_addat');
        }
        $form=$this->createForm(attestationType::class,null);
        $list=$this->getDoctrine()->getRepository(attestation::class)->findAll();
        return $this->render('@attestation/attestation/addat.html.twig',array(
            'form'=>$form->createView(),
            'list'=>$list,
            'u'=>$u
        ));

    }
}
