<?php

namespace MobileBundle\Controller;

use MyBundle\Entity\Evenement;
use MyBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
class DiversController extends Controller
{
    public function showEventAction(Request $request)
    {
        $token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $events = $entitymanager->getRepository('MyBundle:Evenement')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($events);
        return new JsonResponse($formatted);


    }
    public function showOffreAction(Request $request)
    {
        $token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $events = $entitymanager->getRepository('MyBundle:Offre')->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($events);
        return new JsonResponse($formatted);


    }
    public function participerAction(Request $request)
    {

        $id = $request->get('idEvent');
        $iduser=$request->get('idUser');
        //$token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $event = $entitymanager->getRepository(Evenement::class)->find($id);
        //$user = $entitymanager->getRepository(User::class)->find($token);


        $com= new Participation();

        $com->setIdUser($iduser);
        $com->setIdEvent($event);
        $entitymanager->persist($com);
        $entitymanager->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($com);
        return new JsonResponse($formatted);

    }
}
