<?php

namespace MyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/frontoffice", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/admin/backoffice", name="backoffice")
     */
    public function backAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index2.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
     * @Route("/redirect")
     */
    public function redirectAction()
    {
        $authChecker = $this->container->get('security.authorization_checker');
        if($authChecker->isGranted('ROLE_SUPER_ADMIN')) {
            return $this->redirectToRoute('backoffice');
        }
        else if($authChecker->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('homepage');
        }
        else{
            return $this->render('@FOSUser/Security/login.html.twig');
        }
    }
}
