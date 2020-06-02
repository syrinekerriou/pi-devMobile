<?php

namespace MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MobileBundle:Default:index.html.twig');
    }
}
