<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Entity\Promotion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $product1 = (new Product())
            ->setLibelle("Eragon")
            ->setDescription("Eragon n'a que quinze ans, mais le destin de l'Empire est désormais entre ses 
            mains ! C'est en poursuivant une biche dans la montagne que le jeune Eragon, quinze ans, tombe sur une 
            magnifique pierre bleue...")
            ->setPrix(12.90)
            ->setImage("Eragon.jpg")
            ->setCategorie("Livres et papeterie");
        $manager->persist($product1);

        $product2 = (new Product())
            ->setLibelle("L'aîné")
            ->setDescription("Une plongée dans les ténèbres : les certitudes s'évanouissent et les forces du 
            mal règnent. Eragon et sa dragonne, Saphira, sortent à peine de la victoire de Farthen Dûr contre les Urgals,
             qu'une nouvelle horde de monstres surgit...")
            ->setPrix(12.90)
            ->setImage("L'aîné.jpg")
            ->setCategorie("Livres et papeterie");
        $manager->persist($product2);

        $promoProduct3 = (new Promotion())
            ->setDateDebut(date_create("2023-11-20"))
            ->setDateFin(date_create("2023-12-10"))
            ->setPourcentageRemise(50);
        $product3 = (new Product())
            ->setLibelle("Téléviseur OLED")
            ->setDescription("Plongez dans des films, programmes de télévision de qualité, émissions sportives et jeux grâce à notre technologie d'écran nouvelle génération")
            ->setPrix(4999.99)
            ->setImage("Téléviseur.jpg")
            ->setCategorie("Électronique")
            ->setPromotion($promoProduct3);
        $manager->persist($product3);

        $product4 = (new Product())
            ->setLibelle("Brisingr")
            ->setDescription("Eragon a une double promesse à tenir : aider Roran à délivrer sa fiancée, Katrina...")
            ->setPrix(12.90)
            ->setImage("Brisingr.jpg")
            ->setCategorie("Livres et papeterie");
        $promoProduct4 = (new Promotion())
            ->setDateDebut(date_create("2023-11-29"))
            ->setDateFin(date_create("2023-12-15"))
            ->setPourcentageRemise(10)
            ->setProductID($product4);
        $manager->persist($promoProduct4);

        $manager->flush();
    }
}