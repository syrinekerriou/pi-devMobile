<?php

namespace reclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('reclamationBundle:Default:index.html.twig');
    }
}
