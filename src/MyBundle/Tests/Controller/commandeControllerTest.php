<?php

namespace MyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class commandeControllerTest extends WebTestCase
{
    public function testCommender()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/commenderlivre');
    }

}
