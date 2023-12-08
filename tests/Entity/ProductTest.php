<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\Promotion;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    /**
     * @dataProvider productSpec_DataProvider
     */
    public function testGetSpecification_WithProvider($libelle, $desc, $image, $prix, $category) {
        $product = (new Product())
            ->setLibelle($libelle)
            ->setDescription($desc)
            ->setImage($image)
            ->setPrix($prix)
            ->setCategorie($category);

        $this->assertSame($libelle, $product->getLibelle());
        $this->assertSame($desc, $product->getDescription());
        $this->assertSame($image, $product->getImage());
        $this->assertEquals($prix, $product->getPrix());
        $this->assertSame($category, $product->getCategorie());
    }

    public function testGetPromotion()
    {
        $promotion = $this->createMock(Promotion::class);

        $product = (new Product())
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
            ["Eragon", "Un livre d'aventure et de fantaisie", "Eragon.jpg", 12.90, "Livre et papeterie"],
            ["L'aîné", "Un livre d'aventure et de fantaisie volume 2", "L'aîné.png", 12.90, "Livre et papeterie"],
            ["Téléviseur", "Plongez dans des films, programmes de télévision de qualité", "Téléviseur-oled.jpeg", 4999.99, "Électronique"]
        ];
    }
}