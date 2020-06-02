<?php

namespace BibliothequeBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use MyBundle\Entity\Livre;
use MyBundle\Entity\User;
use MyBundle\Entity\Commande;
use MyBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BibliothequeBundle\Repository\BibliothequeRepository;

class commandeController extends Controller
{
    public function commenderAction(Request $request,$idlivre)
    {
        $user=$this->getUser();
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $id=$u->getId();
        $com = new Commande();
        $com->setDatecommande(new \DateTime('now'));
        $livre=$this->getDoctrine()->getRepository(Livre::class)->find($idlivre);
        $livre->setQuantitelivre($livre->getQuantitelivre()-1);
        $com->setIdlivre($livre);
        $com->setIdUser($id);
        $com->setCommandepaye(0);

            $em = $this->getDoctrine()->getManager();
            $em->persist($com);


            $em->flush();
      return $this->redirectToRoute('frontshowlivre');
    }
    public function annulerAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $v=$em->getRepository(Commande::class)->find($request->get('idcommande'));
        $em->remove($v);
        $em->flush();
        return $this->redirectToRoute('backshowcommande');
    }
    public function annulerfrontAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $v=$em->getRepository(Commande::class)->find($request->get('idcommande'));
        $em->remove($v);
        $em->flush();

        $listCommande=$this->getDoctrine()->getRepository(Commande::class)->findAll();

        return $this->render('@Bibliotheque/Bibilotheque/Livre/commender.html.twig', array(
            'list'=>$listCommande));
    }
    public function backshowcommandeAction()
    {
        $em = $this->getDoctrine();
        $commande=$em->getRepository(Commande::class)->findAll();
        return $this->render('@Bibliotheque/Bibilotheque/Livre/showcom.html.twig', array('commande'=>$commande));
    }
    public function mycommandeAction(Request $request)
    {

        $auth_checker = $this->get('security.authorization_checker');
        $this->denyAccessUnlessGranted('ROLE_USER');
        if ($auth_checker->isGranted('ROLE_USER')) {


            $token = $this->container->get('security.token_storage')->getToken()->getUser();
            $user=$token->getId();
            $em = $this->getDoctrine()->getManager();
            $commande = $em->getRepository(Commande::class)->findCommande($user);
            return $this->render('@Bibliotheque/Bibilotheque/Livre/mycommand.html.twig', array(
                'list'=>$commande));
        }
        else
        {
            return $this->redirectToRoute('homepage');
        }
    }



    public function paymentAction(Request $request,$idcommande)
    {

        $com=$em=$this->getDoctrine()->getManager()->getRepository(Commande::class)->find($idcommande);



        $amount=$com->getIdlivre()->getPrixlivre();


        if ($request->isMethod("GET")) {

            \Stripe\Stripe::setApiKey("sk_test_gpKkx2i75i9ZEgbDtmczQo3600enJvzSfr");



            //dump($amount);
            // Token is created using Checkout or Elements!
            // Get the payment token ID submitted by the form:
            $charge = \Stripe\Charge::create([
                'amount' => $amount,
                'currency' => 'usd',
                'description' => 'Example charge',
                'source' => 'tok_visa',
            ]);


            return $this->render('@Bibliotheque/Bibilotheque/Livre/payment.html.twig', array('id'=>$idcommande));
        }


    }


}
