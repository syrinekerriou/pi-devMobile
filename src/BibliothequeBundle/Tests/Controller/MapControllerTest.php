<?php

namespace BibliothequeBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MapControllerTest extends WebTestCase
{
    public function testMap()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/maplivraison');
    }

}
