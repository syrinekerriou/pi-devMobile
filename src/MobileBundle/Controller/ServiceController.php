<?php

namespace MobileBundle\Controller;

use MyBundle\Entity\Service;
use MyBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ServiceController extends Controller
{
    public function showServiceAction(Request $request)
    {
        $token = $request->get('idUser');
        $entitymanager = $this->getDoctrine()->getManager();
        $events = $entitymanager->getRepository('MyBundle:Service')->findService();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($events);
        return new JsonResponse($formatted);


    }
    public function addServiceAction(Request $request)
    {
        $entitymanager = $this->getDoctrine()->getManager();
       // $ids=$request->get('ids');
        $description=$request->get('description');
        $date = new \Datetime('now');
        $ida=$request->get('Attestation');
        $idu=$request->get('idUser');
        $entitymanager1 = $this->getDoctrine()->getManager();
        $attestation=$entitymanager1->getRepository('MyBundle:attestation')->findOneBy(array("typea"=>$ida));
        $entitymanager2=$this->getDoctrine()->getManager();
        $iduser=$entitymanager2->getRepository(User::class)->find($idu);


        $Service = new Service();

        $Service->setDescription($description);
        $Service->setDate($date);
        $Service->setIda($attestation);
        $Service->setIduser($iduser);

        $entitymanager->persist($Service);
        $entitymanager->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Service);
        return new JsonResponse($formatted);
    }
}
