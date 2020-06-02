<?php

namespace MobileBundle\Controller;
use MyBundle\Entity\attestation;
use MyBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AttestationController extends Controller
{
    public function addAttestationAction(Request $request)
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $ida=$request->get('ida');
        $type=$request->get('type');
        $langue=$request->get('langue');
        $idu=$request->get('idUser');
        $entitymanager2=$this->getDoctrine()->getManager();
        $iduser=$entitymanager2->getRepository(User::class)->find($idu);

        $attestation = new attestation();
        $attestation->getIda($ida);
        $attestation->setTypea($type);
        $attestation->setlangue($langue);
        $attestation->setIdUser($iduser);
        $entitymanager->persist($attestation);
        $entitymanager->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($attestation);
        return new JsonResponse($formatted);
    }
    public function showAttestationAction(Request $request)
    {
        $entityManage = $this->getDoctrine()->getManager();
        $attestation=$entityManage->getRepository(attestation::class)->findattestation();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($attestation);
        return new JsonResponse($formatted);
    }
}
