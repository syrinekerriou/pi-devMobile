<?php

namespace ForumBundle\Controller;

use ForumBundle\Form\CommentaireType;
use ForumBundle\Form\PublicationType;
use FOS\UserBundle\Model\UserInterface;
use MyBundle\Entity\Commentaire;
use MyBundle\Entity\Publication;
use MyBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ForumController extends Controller
{

    public function addPublicationAction(Request $request)
    {
        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        if($u->getNbp()==NULL)
        {
            $u->setNbp(1);

        }
        else
        {
            $u->setNbp($u->getNbp()+1);
        }
        $pub=new Publication();
        $date=new \DateTime();
        $pub->setDatep($date);
        $pub->setIdUser($u);
        $form=$this->createForm(PublicationType::class,$pub);
        $form=$form->handleRequest($request);
        if($form->isValid() )
        {
            $pub->setDescriptionp($form['descriptionp']->getData());
            $pub->setTypep($form['typep']->getData());
            $pub->setImage($request->get('image'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($pub);
            $em->flush();
            return $this->redirectToRoute('publication_addPublication');
        }
        $com=new Commentaire();
        $date=new \DateTime();
        $com->setDatec($date);
        $com->setIduser($user);

        if($request->isMethod('POST') )
        {
            $com->setDescriptionc($request->get('description'));
            $pu=$this->getDoctrine()->getRepository(Publication::class)->find($request->get('id1'));
            $com->setIdpublication($request->get('id1'));
            $em=$this->getDoctrine()->getManager();

            $em->persist($com);
            $em->flush();
            return $this->redirectToRoute('publication_addPublication');
        }

        $list=$this->getDoctrine()->getRepository(Publication::class)->findAll();

        $list1=$this->getDoctrine()->getRepository(Commentaire::class)->findAll();
        return $this->render('@Forum/Publication/addPublication.html.twig',array(
            'form'=>$form->createView(),
            'list1'=>$list1,
            'list'=>$list,
            'u'=>$u
        ));
    }

    public function AjouterPubMobileAction(Request $request) {
        $pub = new Publication();

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($request->get("idUser"));
        $pub->setIdUser($user);
        $pub->setTypep($request->get("type"));
        $pub->setDescriptionp($request->get("description"));
        $date=new \DateTime();
        $pub->setDatep($date);
        $em->persist($pub);
        $em->flush();
        return new JsonResponse("ok");
    }

    public function SupprimerPubMobileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository(Publication::class)->find($request->get("idPub"));
        $em->remove($p);
        $em->flush();
        return new JsonResponse("ok");
    }

    public function SupprimerComMobileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository(Commentaire::class)->find($request->get("idCom"));
        $em->remove($p);
        $em->flush();
        return new JsonResponse("ok");
    }

    public function AfficherComPubMobileAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository(Commentaire::class)->findBy(array('idpublication' => $request->get("idPub")));
        $serializer = new Serializer([new ObjectNormalizer()]);
        $data = $serializer->normalize($p);
        return new JsonResponse($data);
    }


    public function AfficherPubMobileAction()
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository(Publication::class)->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $data = $serializer->normalize($p);
        return new JsonResponse($data);
    }


    public function AjouterComMobileAction(Request $request) {
        $pub = new Commentaire();
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($request->get("idUser"));
        $pub->setIdUser($user);
        $pub->setDescriptionc($request->get("description"));
        $publication = $em->getRepository(Publication::class)->find($request->get("idPub"));
        $pub->setIdpublication($publication->getId());
        $date=new \DateTime();
        $pub->setDatec($date);

        $em->persist($pub);
        $em->flush();
        return new JsonResponse("ok");
    }


    public function deleteAction($id)
    {
        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $u->setNbp($u->getNbp()-1);
        $pub=$this->getDoctrine()->getRepository(Publication::class)->find($id);
        if($pub->getIdUser() == $u) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($u);
            $em->remove($pub);
            $em->flush();
        }
        return $this->redirectToRoute('publication_addPublication');

    }
    public function deleteCommentAction($id)
    {
        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $pub=$this->getDoctrine()->getRepository(Commentaire::class)->find($id);
        if($pub->getIduser() == $u) {

            $em = $this->getDoctrine()->getManager();
            $em->remove($pub);
            $em->flush();
        }
        return $this->redirectToRoute('publication_addPublication');

    }
    public function suppAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);

        $pub=$this->getDoctrine()->getRepository(Publication::class)->find($id);
        $userpost=$pub->getIdUser();
        $userpost->setNbp($userpost->getNbp()-1);
        $comm=$this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idpublication'=>$id));


        foreach ($comm as $c)
            $em->remove($c);



        $em->persist($userpost);
        $em->remove($pub);
        $em->flush();

        return $this->redirectToRoute('publication_affiche');

    }
    public function suppCommentAction($id)
    {
        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $pub=$this->getDoctrine()->getRepository(Commentaire::class)->find($id);
        if($pub->getIduser() == $u) {

            $em = $this->getDoctrine()->getManager();
            $em->remove($pub);
            $em->flush();
        }

        return $this->redirectToRoute('publication_affiche');

    }
    public function afficheAction()
    {

        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }

        if($user->getUsername()!="Admin")
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }
        $em=$this->getDoctrine()->getRepository(Publication::class)->findAll();

        $postotal=0;
        foreach ($em as $row)
        {
            $postotal+=$row->getIdUser()->getNbp();

        }

        $data= array();
        $stat=['User','Postes'];
        $nb=0;
        array_push($data,$stat);
        foreach ($em as $row)
        {
            $stat=array();
//            array_push($stat,$row->getPartenaire()->getNom(),(($row->getMontant())*100)/$montantTotal);
//            $nb=($row->getMontant()*100)/$montantTotal;

            array_push($stat,$row->getIdUser()->getNom(),$row->getIdUser()->getNbp());

            $nb=$row->getIdUser()->getNbp();

            $stat=[$row->getIdUser()->getNom()." ".$row->getIdUser()->getPrenom(),$nb];
            array_push($data,$stat);
        }

        $pieChart = new PieChart();
        $pieChart->getData()->setArrayToDataTable($data);
        $pieChart->getOptions()->setTitle('Publication poster par chaque Utilisateur');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(1125);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#00008B');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        $em1=$this->getDoctrine()->getRepository(Commentaire::class)->findAll();
        return $this->render('@Forum/Publication/suppPublication.html.twig',array(
            'list'=>$em,
            'list1'=>$em1,
            'piechart'=>$pieChart,

        ));
    }
    public function detailsAction($id)
    {
        $user=$this->getUser();
        if(!is_object($user) || !$user instanceof UserInterface)
        {
            return $this->redirect("http://localhost/pi-dev/web/app_dev.php/login");
        }
        $publication=$this->getDoctrine()->getRepository(Publication::class)->find($id);

        $commentaires=$this->getDoctrine()->getRepository(Commentaire::class)->findBy(array('idpublication'=>$id));
        return $this->render('@Forum/Publication/detailsPublication.html.twig',array(
            'pub'=>$publication,
            'comment'=>$commentaires,

        ));
    }




}

