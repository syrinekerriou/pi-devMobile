<?php

namespace MyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LivraisonControllerTest extends WebTestCase
{
    public function testLivrer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/livrercommande');
    }

    public function testAnnulerliv()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/annulerlivraisoncommande');
    }

    public function testShowlivraison()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showlivraison');
    }

}
