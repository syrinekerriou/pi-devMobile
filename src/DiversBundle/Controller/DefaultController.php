<?php

namespace DiversBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DiversBundle:Default:index.html.twig');
    }
}
