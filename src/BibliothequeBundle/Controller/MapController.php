<?php

namespace BibliothequeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MapController extends Controller
{
    /**
     * @Route("/map")
     */
    public function mapAction()
    {
        return $this->render('@Bibliotheque/Map/map.html.twig', array(
            // ...
        ));
    }

}
