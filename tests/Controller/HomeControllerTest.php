<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        echo $client->getResponse()->getContent();
    }

    /**
     * @dataProvider categoryProvider
     */
    public function testCatalogCategorie_WithProvider($category, $expected) {
        $client = static::createClient();
        $client->request('GET', "/catalog/".$category);
        $this->assertSame($expected, $client->getResponse()->getStatusCode());
    }

    public function categoryProvider() {
        return [
            ["Alimentation", 200],
            ["Électronique", 200],
            ["Vêtements et mode", 200],
            ["Beauté et santé", 200],
            ["Sports et loisirs", 200],
            ["Livres et papeterie", 200],
            ["Automobile", 302] // Catégorie non présente dans le catalogue, redirection vers page d'accueil
        ];
    }
}
