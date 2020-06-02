<?php

namespace MobileBundle\Controller;

use FOS\UserBundle\Model\User;
use MyBundle\Entity\Livraison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use MyBundle\Entity\Livre;
use MyBundle\Entity\Commande;

class BibliothequeController extends Controller
{

    public function showLivreAction(Request $request)
    {
        $token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $events = $entitymanager->getRepository('MyBundle:Livre')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($events);
        return new JsonResponse($formatted);


    }
    public function showLivreDetailsAction(Request $request)
    {
        $token = $request->get('idlivre');
        $entitymanager = $this->getDoctrine()->getManager();
        $events = $entitymanager->getRepository('MyBundle:Livre')->find($token);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($events);
        return new JsonResponse($formatted);


    }
    public function CommenderAction(Request $request)
    {

        $id = $request->get('idlivre');
        $iduser=$request->get('idUser');
        //$token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $livre = $entitymanager->getRepository(Livre::class)->find($id);
        //$user = $entitymanager->getRepository(User::class)->find($token);
        $livre->setQuantitelivre($livre->getQuantitelivre()-1);
        $date = new \Datetime('now');
        $date->format('Y-m-d');
        $com= new Commande();
        $com->setIdlivre($livre);
        $com->setIdUser($iduser);
        $com->setDatecommande($date);
        $entitymanager->persist($com);
        $entitymanager->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);

    }
    public function LivrerAction(Request $request)
    {

        $id = $request->get('idcommande');
        //$token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $com= $entitymanager->getRepository(Commande::class)->find($id);

        $liv= new Livraison();
        $liv->setIdcommande($com);
        $liv->setIdUser(1);

        $entitymanager->persist($liv);
        $entitymanager->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($liv);
        return new JsonResponse($formatted);

    }

    public function showCommandeAction(Request $request)
    {

        $token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $events = $entitymanager->getRepository('MyBundle:Commande')->findLogByID($token);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($events);
        return new JsonResponse($formatted);
    }
    public function deleteComAction(Request $request)
    {
        $token = $request->get('idcommande');
        $em=$this->getDoctrine()->getManager();
        $com=$this->getDoctrine()->getRepository(Commande::class)->find($token);
        $em->remove($com);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);
    }
    public function searchAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $livre = $em->getRepository('MyBundle:Livre')->findEntitiesByString($requestString);
        if(!$livre)
        {
            $result['livre']['error']="livre introuvable :( ";

        }else{
            $result['livre']=$this->getRealEntities($livre);
        }
        return new Response(json_encode($result));

    }
    public function showprofileAction(Request $request)
    {

        $token = $request->get('id');
        $entitymanager = $this->getDoctrine()->getManager();
        $user = $entitymanager->getRepository('MyBundle:User')->findProfile($token);

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }
    public function addbookAction(Request $request)
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $titre=$request->get('nomlivre');
        $auteur=$request->get('auteur');
        $prix=$request->get('prix');
        $contenu=$request->get('contenu');
        $quantite=$request->get('quantite');
        $img=$request->get('img');
        $date = new \Datetime('now');

        $livre = new Livre();
        $livre->setNomlivre($titre);
        $livre->setAuteurlivre($auteur);
        $livre->setPrixlivre($prix);
        $livre->setQuantitelivre($quantite);
        $livre->setContenu($contenu);
        $livre->setImageName($img);
        $livre->setDatelivre($date);
        $entitymanager->persist($livre);
        $entitymanager->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($livre);
        return new JsonResponse($formatted);
    }
}
