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

    #[Route('catalog/{category}')]
    public function catalogCategory(string $category) {
        $categoryCatalog = ['Alimentation', 'Électronique', 'Vêtements et mode', 'Beauté et santé', 'Sports et loisirs', 'Livres et papeterie'];

        if(in_array($category, $categoryCatalog)) {
            $em = $this->getDoctrine()->getManager();
            $products = $em->getRepository(Product::class)->findBy(array('categorie' => $category));

            return $this->render('home/index.html.twig', [
                'products' => $products
            ]);
        } else {
            return $this->redirectToRoute('home');
        }
    }
}