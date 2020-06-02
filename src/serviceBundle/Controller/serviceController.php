<?php

namespace serviceBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use MyBundle\Entity\Service;
use MyBundle\Entity\attestation;
use MyBundle\Entity\User;
use serviceBundle\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Dompdf\Dompdf;
use Dompdf\Options;
require 'C:\wamp64\www\pi-dev\vendor\autoload.php';


class serviceController extends Controller
{
    public function addServiceAction(Request $request )
    {
        $user=$this->getUser();
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $se=new Service();
        $date=new \DateTime();
        $se->setDate($date);
        $se->setIduser($user);
        $attestation=$this->getDoctrine()->getRepository(attestation::class)->findAll();
        $form=$this->createForm(ServiceType::class,$se);
        $form=$form->handleRequest($request);
        if($form->isValid() )
        {
            $se->setDescription($form['description']->getData());

            $em=$this->getDoctrine()->getManager();
            $em->persist($se);
            $em->flush();
            return $this->redirectToRoute('service_addService');
        }
        $form=$this->createForm(ServiceType::class,null);
        $list=$this->getDoctrine()->getRepository(Service::class)->findAll();

        return $this->render('@service/service/addService.html.twig',array(
            'form'=>$form->createView(),
            'list'=>$list,
            'u'=>$u
        ));
    }


    public function deleteAction($id)
    {
        $user=$this->getUser();


        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $se=$this->getDoctrine()->getRepository(Service::class)->find($id);
        if($se->getIdUser() == $u){

            $em = $this->getDoctrine()->getManager();
            $em->remove($se);
            $em->flush();
        }
        return $this->redirectToRoute('service_affichage');

    }

    public function deletesAction($id)
    {
        $user=$this->getUser();


        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $se=$this->getDoctrine()->getRepository(Service::class)->find($id);
        if($se->getIdUser() == $u) {

            $em = $this->getDoctrine()->getManager();
            $em->remove($se);
            $em->flush();
        }
        return $this->redirectToRoute('service_affichagee');

    }
    public function affichageAction()
    {
        $em=$this->getDoctrine()->getRepository(Service::class)->findAll();
        return $this->render('@service/service/affichageService.html.twig',array(
            're'=>$em

        ));
    }

    public function affichageeAction()
    {
        $em=$this->getDoctrine()->getRepository(Service::class)->findAll();


        return $this->render('@service/service/affichage.html.twig',array(
            're'=>$em

        ));

    }
    public function pdfAction()
    { $dompdf = new Dompdf();
        $dompdf->loadHtml('Attestation de travail');

// (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
        $dompdf->render();

// Output the generated PDF to Browser
        $dompdf->stream();

    }
    public function getRealEntities($service){
        foreach ($service as $service){
            $realEntities[$service->getIds()] = [$service->getDescription(), $service->getDate(), $service->getIdUser()];
        }
        return $realEntities;
    }
    public function searchAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $service = $em->getRepository('MyBundle:Service')->findEntitiesByString($requestString);
        if(!$service)
        {
            $result['service']['error']="service introuvable :( ";

        }else{
            $result['service']=$this->getRealEntities($service);
        }

        return new Response(json_encode($result));

    }


    public function sortAction($sort)
    {
        $user=$this->getUser();

        if( !is_object($user) || !$user instanceof UserInterface ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);

        $entityManager = $this->getDoctrine()->getManager();

        if ($sort=='ASC'){

                $query = $entityManager->createQuery(
                'SELECT s
    FROM MyBundle:Service s
    ORDER BY s.date ASC'
            );
        }else {
            $query = $entityManager->createQuery(
                'SELECT s
    FROM MyBundle:Service s
    ORDER BY s.date  DESC'
            );
        }



        $x = $query->getResult();

        return $this->render('@service/service/sort.html.twig', array('service'=>$x));
    }


}
