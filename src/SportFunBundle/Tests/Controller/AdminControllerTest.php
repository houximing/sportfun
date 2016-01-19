<?php

namespace SportFunBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testOrder()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/order');
    }

    public function testStadium()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/stadium');
    }

}
