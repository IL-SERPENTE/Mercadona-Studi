<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase {

    public function testGetSpecification() {
        $product = new Product();
        $product->setLibelle("Eragon");
        $product->setDescription("Un livre d'aventure et de fantaisie");
        $product->setPrix(12.90);
        $product->setCategorie("Livre et papeterie");
    }
}
