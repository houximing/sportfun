<?php

namespace SportFunBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrderControllerTest extends WebTestCase
{
    public function testFill()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fill');
    }

    public function testBillingdetails()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/billingDetails');
    }

    public function testPayment()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/payment');
    }

}
