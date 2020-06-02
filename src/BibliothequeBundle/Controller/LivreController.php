<?php

namespace BibliothequeBundle\Controller;
use FOS\UserBundle\Model\UserInterface;
use MyBundle\Entity\User;
use BibliothequeBundle\Repository\BibliothequeRepository;
use Symfony\Component\Form\Form;
use BibliothequeBundle\Form\LivreType;
use Symfony\Component\HttpFoundation\Request;
use MyBundle\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class LivreController extends Controller
{
    public function addAction(Request $request)
    {
        $livre = new Livre();

        $form = $this->createForm(LivreType::class,$livre);

        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($livre);

            $entityManager->flush();

            return $this->redirectToRoute('showlivre');

        }

        return $this->render('@Bibliotheque/Bibilotheque/Livre/add.html.twig', array('form'=> $form->createView()));
    }

    public function editAction(Request $request,$idlivre)
    {

        $formation=$this->getDoctrine()->getRepository(Livre::class)->find($idlivre);

        $form = $this->createForm(LivreType::class,$formation);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();




            $entityManager->flush();

            return $this->redirectToRoute('showlivre');

        }

        return $this->render('@Bibliotheque/Bibilotheque/Livre/edit.html.twig', array('form'=> $form->createView()));

    }

    public function deleteAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $v=$em->getRepository(Livre::class)->find($request->get('idlivre'));
        $em->remove($v);
        $em->flush();
        return $this->redirectToRoute('showlivre');
    }

    public function showAction(Request $request)
    {
        $em = $this->getDoctrine();
        $livre=$em->getRepository(Livre::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator =$this->get('knp_paginator');
        $listlivre = $paginator->paginate(
            $livre,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render('@Bibliotheque/Bibilotheque/Livre/show.html.twig', array('livre'=>$listlivre));
    }

    public function frontshowAction(Request $request)
    {
        $em = $this->getDoctrine();
        $livre=$em->getRepository(Livre::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator =$this->get('knp_paginator');
        $listlivre = $paginator->paginate(
            $livre,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',3)
        );
        return $this->render('@Bibliotheque/Bibilotheque/Livre/frontshow.html.twig', array('livre'=>$listlivre));
    }


    public function detailAction($idlivre)
    {
        $livre=$this->getDoctrine()->getRepository(Livre::class)->find($idlivre);

        return $this->render('@Bibliotheque/Bibilotheque/Livre/detail.html.twig', array('livre'=>$livre));

    }
    public function detaillivreAction($idlivre)
    {
        $livre=$this->getDoctrine()->getRepository(Livre::class)->find($idlivre);

        return $this->render('@Bibliotheque/Bibilotheque/Livre/detaillivre.html.twig', array('livre'=>$livre));

    }

    public function supprimerAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $v=$em->getRepository(Livre::class)->find($request->get('idlivre'));
        $em->remove($v);
        $em->flush();
        return $this->redirectToRoute('showlivre');
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
    public function getRealEntities($livre){
        foreach ($livre as $livre){
            $realEntities[$livre->getIdlivre()] = [$livre->getNomLivre(), $livre->getAuteurlivre(), $livre->getDatelivre(), $livre->getPrixlivre(),$livre->getContenu(),$livre->getImageName()];
        }
        return $realEntities;
    }
    public function sortAction($sort)
    {
        $user=$this->getUser();

        if( !is_object($user) || !$user instanceof UserInterface  ) {
            return $this->redirectToRoute('fos_user_security_login');
        }
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);

        $entityManager = $this->getDoctrine()->getManager();

        if ($sort=='ASC'){
            $query = $entityManager->createQuery(
                'SELECT p
    FROM MyBundle:Livre p
    ORDER BY p.prixlivre ASC'
            );
        }else {
            $query = $entityManager->createQuery(
                'SELECT p
    FROM MyBundle:Livre p
    ORDER BY p.prixlivre  DESC'
            );
        }



        $livre = $query->getResult();

        return $this->render('@Bibliotheque/Bibilotheque/Livre/sort.html.twig', array('livre'=>$livre));
    }
    /**
     * @Route("/send-notification", name="send_notification")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function sendNotification(Request $request)
    {
        $manager = $this->get('mgilet.notification');
        $notif = $manager->createNotification('Hello world !');
        $notif->setMessage('This a notification.');
        $notif->setLink('http://symfony.com/');
        // or the one-line method :
        // $manager->createNotification('Notification subject','Some random text','http://google.fr');

        // you can add a notification to a list of entities
        // the third parameter ``$flush`` allows you to directly flush the entities
        $manager->addNotification(array($this->getUser()), $notif, true);

        return $this->redirectToRoute('homepage');
    }



}
