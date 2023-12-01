<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    /**
     * @dataProvider productSpec_DataProvider
     */
    public function testGetSpecification_WithProvider($spec, $expected) {
        $product = new Product();
        $product->setLibelle($spec[0]);
        $product->setDescription($spec[1]);
        $product->setImage($spec[2]);
        $product->setPrix($spec[3]);
        $product->setCategorie($spec[4]);

        $this->assertSame($expected[0], $product->getLibelle());
        $this->assertSame($expected[1], $product->getDescription());
        $this->assertSame($expected[2], $product->getImage());
        $this->assertEquals($expected[3], $product->getPrix());
        $this->assertSame($expected[4], $product->getCategorie());
    }

    /**
     * @dataProvider productSpecError_DataProvider
     */
    public function testGetSpecProductNotIdentical($spec,$expected)
    {
        $product = new Product();
        $product->setLibelle($spec[0]);
        $product->setDescription($spec[1]);
        $product->setImage($spec[2]);
        $product->setPrix($spec[3]);
        $product->setCategorie($spec[4]);

        $this->assertNotSame($expected[0], $product->getLibelle());
        $this->assertNotSame($expected[1], $product->getDescription());
        $this->assertNotSame($expected[2], $product->getImage());
        $this->assertNotEquals($expected[3], $product->getPrix());
        $this->assertNotSame($expected[4], $product->getCategorie());
    }

    public function productSpec_DataProvider()
    {
        return [
            [
                ["Eragon", "Un livre d'aventure et de fantaisie", "Eragon.jpg", 12.90, "Livre et papeterie"],
                ["Eragon", "Un livre d'aventure et de fantaisie", "Eragon.jpg", 12.90, "Livre et papeterie"]
            ],
            [
                ["L'aîné", "Un livre d'aventure et de fantaisie volume 2", "L'aîné.png", 12.90, "Livre et papeterie"],
                ["L'aîné", "Un livre d'aventure et de fantaisie volume 2", "L'aîné.png", 12.90, "Livre et papeterie"]
            ],
            [
                ["Téléviseur", "Plongez dans des films, programmes de télévision de qualité", "Téléviseur-oled.jpeg", 4999.99, "Électronique"],
                ["Téléviseur", "Plongez dans des films, programmes de télévision de qualité", "Téléviseur-oled.jpeg", 4999.99, "Électronique"]
            ]
        ];
    }

    public function productSpecError_DataProvider()
    {
        return [
            [
                ["Brinsingr", "Un livre d'aventure et de fantaisie volume 3", "Brinsingr.png", 12.90, "Livre et papeterie"],
                ["Brinsinger", "Un livre d'aventure et de fantaisie volume 2", "Brinsingr.jpg", 12, "Livr et papeterie"]
            ],
            [
                ["Télévisueur OLED", "Plongez dans des films, programmes de télévision de qualité", "Téléviseur.png", 6999.99, "Électronique"],
                ["Téléviseur", "Plongez dans des films, émissions sportives et jeux", "Télévisueur.jpg", 7999.99, "Électroniqu"]
            ]
        ];
    }
}