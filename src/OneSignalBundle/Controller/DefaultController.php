<?php

namespace OneSignalBundle\Controller;

use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DefaultController extends Controller
{
    public function indexAction()
    {


        try{

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"app_id\": \"253ac335-60e8-481d-8b7d-dd74c1905e42\",\n\"contents\": {\"en\": \"nouveau offre envoye a ingenschool\"},\n\"included_segments\": [\"Subscribed Users\"]}");

            $headers = array();
            $headers[] = 'Content-Type: application/json; charset=utf-8';
            $headers[] = 'Authorization: Basic Y2MwOTFlZjctNjgwOC00ZTNiLWE2YWItM2E1NDRkMjBmZTQ3';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);


        }catch(\Exception $e) {


    }

        return $this->redirectToRoute('offreback');

    }


    public function BuyfrontAction()
    {


        try{

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"app_id\": \"253ac335-60e8-481d-8b7d-dd74c1905e42\",\n\"contents\": {\"en\": \"vous avez achetez une offre \"},\n\"included_segments\": [\"Subscribed Users\"]}");

            $headers = array();
            $headers[] = 'Content-Type: application/json; charset=utf-8';
            $headers[] = 'Authorization: Basic Y2MwOTFlZjctNjgwOC00ZTNiLWE2YWItM2E1NDRkMjBmZTQ3';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);


        }catch(\Exception $e) {


        }
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('MyBundle:Offre')->findAll();
        return $this->render('@Divers/Divers/front/notif.html.twig', array(
            'offre' => $offre));

    }
    public function BuyMobileAction()
    {


        try{

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://onesignal.com/api/v1/notifications');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"app_id\": \"253ac335-60e8-481d-8b7d-dd74c1905e42\",\n\"contents\": {\"en\": \"vous avez participer a un evenement \"},\n\"included_segments\": [\"Subscribed Users\"]}");

            $headers = array();
            $headers[] = 'Content-Type: application/json; charset=utf-8';
            $headers[] = 'Authorization: Basic Y2MwOTFlZjctNjgwOC00ZTNiLWE2YWItM2E1NDRkMjBmZTQ3';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);


        }catch(\Exception $e) {


        }
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($result);
        return new JsonResponse($formatted);


    }







}
