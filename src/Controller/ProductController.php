<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Form\NewPromotionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Entity\Product;
use App\Form\NewProductType;
use App\Form\UpdateProductType;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductController extends AbstractController
{
    // Création du produit et ajout en BDD
    #[Route('/admin/product', name:'new_product')]
    public function createProduct(Request $request, SluggerInterface $slugger): Response {
        // Entity manager de symfony
        $em = $this->getDoctrine()->getManager();

        $product = new Product();

        $form = $this->createForm(NewProductType::class, $product);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $product->setLibelle($form->get('libelle')->getData());
            $product->setDescription($form->get('description')->getData());
            $product->setPrix($form->get('prix')->getData());
            $product->setCategorie($form->get('categorie')->getData());

            $image = $form->get('image')->getData();
            $originalImageName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $safeImageName = $slugger->slug($originalImageName);
            $newImageName = $safeImageName.'-'.uniqid().'.'.$image->guessExtension();

            $image->move(
                'assets/image_product',
                $newImageName
            );

            $product->setImage($newImageName);

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('new_product');
        }

        $parameters = array(
            'form' => $form->createView(),
            'product' => $product
        );

        return $this->render('product/new.html.twig', $parameters);
    }


    // Ajout d'une promotion a un poduit
    #[Route('/admin/promotion/{id}', name: 'set_promotion', methods: ['GET', 'POST'])]
    public function newPromotion(Request $request,int $id): Response {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository(Product::class)->find($id);

        if($product == null){
            return $this->redirectToRoute('home');
        }

        $promo = new Promotion();

        $form = $this->createForm(NewPromotionType::class, $promo);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $promo->setProductID($product);
            $promo->setDateDebut($form->get('dateDebut')->getData());
            $promo->setDateFin($form->get('dateFin')->getData());
            $promo->setPourcentageRemise($form->get('pourcentageRemise')->getData());

            $em->persist($promo);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        $parameters = array(
            'form' => $form->createView(),
            'promo' => $promo,
            'prodcutName' => $product->getLibelle()
        );

        return $this->render('product/setPromotion.html.twig', $parameters);
    }

    // Modification d'un produit et enrengistrement des changement en BDD
    #[Route('/admin/product/{id}', name:'update_product', methods: ['GET', 'POST'])]
    public function updateProduct(Request $request, int $id) {

    }
}