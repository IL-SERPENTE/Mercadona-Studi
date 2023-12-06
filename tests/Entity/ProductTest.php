<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\Promotion;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    /**
     * @dataProvider productSpec_DataProvider
     */
    public function testGetSpecification_WithProvider($spec, $expected) {
        $product = new Product();
        $product
            ->setLibelle($spec[0])
            ->setDescription($spec[1])
            ->setImage($spec[2])
            ->setPrix($spec[3])
            ->setCategorie($spec[4]);

        $this->assertSame($expected[0], $product->getLibelle());
        $this->assertSame($expected[1], $product->getDescription());
        $this->assertSame($expected[2], $product->getImage());
        $this->assertEquals($expected[3], $product->getPrix());
        $this->assertSame($expected[4], $product->getCategorie());
    }

    public function testGetPromotion()
    {
        $promotion = $this->createMock(Promotion::class);

        $product = new Product();
        $product
            ->setLibelle("PC Portable")
            ->setDescription("PC conçus pour le jeux")
            ->setPrix(1999.99)
            ->setImage("Ordi-game.png")
            ->setCategorie("Électronique")
            ->setPromotion($promotion);

        $this->assertSame("PC Portable", $product->getLibelle());
        $this->assertSame("PC conçus pour le jeux", $product->getDescription());
        $this->assertEquals(1999.99, $product->getPrix());
        $this->assertSame("Ordi-game.png", $product->getImage());
        $this->assertSame("Électronique", $product->getCategorie());
        $this->assertSame($promotion, $product->getPromotion());
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
}