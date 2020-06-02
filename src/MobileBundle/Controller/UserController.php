<?php

namespace MobileBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use MyBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class UserController extends Controller
{
    public function inscriptionAction(Request $request)
    {
        $entitymanager = $this->getDoctrine()->getManager();
        $nom = $request->get('nom');
        $prenom = $request->get('prenom');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');




        $user = new User();
        $user->setUsername($username);
        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setPlainPassword($password);
        $user->setEnabled(true);
        $user->addRole("ROLE_CLIENT");
        $entitymanager->persist($user);
        $entitymanager->flush();


        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);

    }
    public function findallAction()
    {

        $users = $this->getDoctrine()->getManager()
            ->getRepository('MyBundle:User')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($users);
        return new JsonResponse($formatted);
    }


    public function  loginAction(  $username,$password )
    {



        $em1 = $this->getDoctrine()->getManager();
        $user=$em1->getRepository(User::class)->findOneBy(array("username"=>$username));


        $test=array();
        $u=new User();

        $pass = $password;
        $salt = $user->getSalt();
        $iterations = 5000; // Par défaut
        $result = '';
        $salted = $pass.'{'.$salt.'}';

        $digest = hash('sha512', $salted, true);

        for ($i = 1; $i < $iterations; $i++) {
            $digest = hash('sha512', $digest.$salted, true);

        }
        $cryptedPass = base64_encode($digest);

        if ($user==null)
        {
            $u->setId(0);
            $us=["user"=>$u];

            $msg=["message"=>"username non valid"];
            array_push($test,$msg);
            array_push($test,$us);

        }

        else if($user->getPassword() != $cryptedPass)
        {
            $u->setId(0);
            $us=["user"=>$u];
            $msg=["message"=>"password non valid"];
            array_push($test,$msg);
            array_push($test,$us);
        }
        else
        {
            $u=$user;

            $us=["user"=>$u,"message"=>"connection etablie"];

            //array_push($test,$msg);
            array_push($test,$us);
        }

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($test);
        return new JsonResponse($formatted);

    }
    public function updatemdpAction(Request $request)
    {

        $token = $request->get('id');
        $password = $request->get('password');


        $entitymanager = $this->getDoctrine()->getManager();
        $user = $entitymanager->getRepository('MyBundle:User')->find($token);
        $pass = $password;
        $salt = $user->getSalt();
        $iterations = 5000; // Par défaut
        $result = '';
        $salted = $pass.'{'.$salt.'}';

        $digest = hash('sha512', $salted, true);

        for ($i = 1; $i < $iterations; $i++) {
            $digest = hash('sha512', $digest.$salted, true);

        }
        $cryptedPass = base64_encode($digest);
        $user->setPassword($cryptedPass);
        $entitymanager->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($user);
        return new JsonResponse($formatted);
    }

}
