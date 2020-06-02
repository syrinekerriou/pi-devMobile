<?php

namespace serviceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('serviceBundle:Default:index.html.twig');
    }
}
