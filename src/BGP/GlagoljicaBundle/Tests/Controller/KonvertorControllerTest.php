<?php

namespace BGP\GlagoljicaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class KonvertorControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/konvertor');
		
		// Assert a specific 200 status code
		$this->assertEquals(
		    Response::HTTP_OK,
		    $client->getResponse()->getStatusCode()
		);
		
		// Jel imamo h1 na stranici
		$this->assertEquals(1, $crawler->filter('h1')->count());
    }
}
