<?php

namespace BlogBundle\Controller;



use FOS\UserBundle\Model\UserInterface;
use MyBundle\Entity\Blog;
use MyBundle\Entity\User;
use BlogBundle\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class BlogController extends Controller
{
    public function addBlogAction(Request $request)
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

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $rec=new Blog();
        $form=$this->createForm(BlogType::class,$rec);
        $form=$form->handleRequest($request);
        if($form->isValid() )
        {
            $rec->setType($form['sujet']->getData());
            $rec->setDescription($form['description']->getData());
            $rec->setType($request->get('image'));
            var_dump($rec->getType());
            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('Blog_addBlog');
        }
        $form=$this->createForm(BlogType::class,null);
        $list=$this->getDoctrine()->getRepository(Blog::class)->findAll();
        return $this->render('@Blog/Blog/addBlog.html.twig',array(
            'form'=>$form->createView(),
            'list'=>$list,
            'u'=>$u
        ));
    }

    public function deleteAction($id)
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

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $rec=$this->getDoctrine()->getRepository(Blog::class)->find($id);
        if($rec->getIdUser() == $u)
        {

            $em = $this->getDoctrine()->getManager();
            $em->remove($rec);
            $em->flush();
        }
        return $this->redirectToRoute('Blog_affichageB');

    }
    public function affichageFAction(Request $request)
    {
        $em=$this->getDoctrine()->getRepository(Blog::class)->findAll();
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $blogs = $paginator->paginate(
            $em,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 2)
        );
        return $this->render('@Blog/Blog/affichageFBlog.html.twig',array(
            're'=>$blogs

        ));
    }

    public function affichageMobileAction()
    {
        $em = $this->getDoctrine()->getManager();
        $p = $em->getRepository(Blog::class)->findAll();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $data = $serializer->normalize($p);
        return new JsonResponse($data);
    }

    public function affichageBAction()
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
        $em=$this->getDoctrine()->getRepository(Blog::class)->findAll();
        return $this->render('@Blog/Blog/affichageBBlog.html.twig',array(
            're'=>$em

        ));
    }
    public function searchAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $blog = $em->getRepository('MyBundle:Blog')->findEntitiesByString($requestString);
        if(!$blog)
        {
            $result['blog']['error']="service introuvable :( ";

        }else{
            $result['blog']=$this->getRealEntities($blog);
        }

        return new Response(json_encode($result));

    }

    public function getRealEntities($blog){
        foreach ($blog as $blog){
            $realEntities[$blog->getIdb()] = [$blog->getSujet(), $blog->getDescription(), $blog->getType()];
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
    FROM MyBundle:Blog p
    ORDER BY p.sujet ASC'
            );
        }else {
            $query = $entityManager->createQuery(
                'SELECT p
    FROM MyBundle:Blog p
    ORDER BY p.sujet  DESC'
            );
        }



        $blog = $query->getResult();

        return $this->render('@Blog/Blog/sort.html.twig', array('blog'=>$blog));
    }
}
