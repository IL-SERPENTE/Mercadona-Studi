<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use App\Entity\Promotion;
use PHPUnit\Framework\TestCase;

class PromotionTest extends TestCase
{
    /**
     * @dataProvider specPromotion_DataProvider
     */
    public function testGetSpecPromotion_WithProvider($productID, $startingDate, $endingDate, $remise)
    {
        $promotion = new Promotion();
        $promotion->setProductID($productID);
        $promotion->setDateDebut($startingDate);
        $promotion->setDateFin($endingDate);
        $promotion->setPourcentageRemise($remise);

        $this->assertSame($productID, $promotion->getProductID());
        $this->assertSame($startingDate, $promotion->getDateDebut());
        $this->assertSame($endingDate, $promotion->getDateFin());
        $this->assertEquals($remise, $promotion->getPourcentageRemise());
    }

    public function specPromotion_DataProvider()
    {
        $product = $this->createMock(Product::class);

        return[
            [$product, date_create("2023-11-25"), date_create("2023-12-30"), 50],
            [$product, date_create("2023-12-11"), date_create("2024-01-15"), 25]
        ];
    }
}
