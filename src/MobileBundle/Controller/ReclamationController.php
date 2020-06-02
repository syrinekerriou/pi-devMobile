<?php

namespace MobileBundle\Controller;
use MyBundle\Entity\Reclamation;
use MyBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use DateTime;


class ReclamationController extends Controller
{
    public function addReclamationAction(Request $request)
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $idr = $request->get('idr');
        $nomr = $request->get('nomr');
        $sujetr = $request->get('sujetr');
        $date = new Datetime('now');
        $idu=$request->get('idUser');
        $entitymanager2=$this->getDoctrine()->getManager();
        $iduser=$entitymanager2->getRepository(User::class)->find($idu);


        $Reclamation = new Reclamation();
        $Reclamation->getIdr($idr);
        $Reclamation->setNomr($nomr);
        $Reclamation->setSujetr($sujetr);
        $Reclamation->setDater($date);
        $Reclamation->setIduser($iduser);

        $entitymanager->persist($Reclamation);
        $entitymanager->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Reclamation);
        return new JsonResponse($formatted);
    }
}
