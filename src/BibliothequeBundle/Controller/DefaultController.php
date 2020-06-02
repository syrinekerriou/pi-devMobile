<?php

namespace BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BibliothequeBundle:Default:index.html.twig');
    }
}
