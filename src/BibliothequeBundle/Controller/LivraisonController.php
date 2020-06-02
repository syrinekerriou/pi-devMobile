<?php

namespace BibliothequeBundle\Controller;

use MyBundle\Entity\Commande;
use MyBundle\Entity\Livraison;
use MyBundle\Entity\Livre;
use MyBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LivraisonController extends Controller
{
    public function livrerAction(Request $request,$idcommande)
    {
        $user=$this->getUser();
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $id=$u->getId();
        $liv = new Livraison();
        $com=$this->getDoctrine()->getRepository(Commande::class)->find($idcommande);
        $liv->setIdcommande($com);
        $liv->setIdUser($id);


        $em = $this->getDoctrine()->getManager();
        $em->persist($liv);


   $prix=$liv->getIdcommande()->getIdlivre()->getPrixlivre();
   $titre=$liv->getIdcommande()->getIdlivre()->getNomlivre();
      $em->flush();
       $basic  = new \Nexmo\Client\Credentials\Basic('c8febd5f', '1NuY5EfzhWPG7G3s');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '21651872468',
            'from' => 'Ingen school',
            'text' => 'Votre Livre: '.$titre.' au prix de'.$prix.'millimes a éte payer avec succes'
        ]);




        return $this->redirectToRoute('frontshowlivre');

    }




    public function annulerlivAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $v=$em->getRepository(Livraison::class)->find($request->get('idlivraison'));
        $em->remove($v);
        $em->flush();
        return $this->redirectToRoute('showlivraison');
    }

    public function showlivraisonAction()
    {
        $em = $this->getDoctrine();
        $livraison=$em->getRepository(Livraison::class)->findAll();
        return $this->render('@Bibliotheque/Bibilotheque/Livre/showlivraison.html.twig', array('livraison'=>$livraison));
    }

}
