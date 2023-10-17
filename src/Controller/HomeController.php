<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController {
    #[Route('/', name:'home')]
    public function index(): Response {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // Récupération des produit de base de données
        $products = $em->getRepository(Product::class)->findAll();

        return $this->render('home/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/{category}')]
    public function catalogCategory(string $category) {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository(Product::class)->findBy(array('categorie' => $category));

        return $this->render('home/index.html.twig', [
            'products' => $products
        ]);
    }
}