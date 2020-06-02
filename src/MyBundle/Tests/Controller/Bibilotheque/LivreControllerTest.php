<?php

namespace MyBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Bibilotheque\LivreControllerTest extends WebTestCase
{
    public function testAdd()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addlivre');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editlivre');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deletelivre');
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/showlivre');
    }

}
