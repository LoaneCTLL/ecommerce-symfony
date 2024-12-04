<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ProductType;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product_index')]
    public function index(ProduitRepository $produitRepository): Response
    {

        $produits = $produitRepository->findAll();


        // dd($produits);

        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
            'produits' => $produits,
        ]);

    }



    #[Route('/product/new', name: 'app_product_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        //dump($request);
    
        $product = new Produit();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            //dump($product);
            //dd($product);
            $em->persist($product);
            $em->flush();
    
            return $this->redirectToRoute('app_product_index'); 
        }
    
        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/product/show/{id}', name: 'app_product_show')]
    public function show(Produit $produit): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $produit,
        ]);
    }

    #[Route('/product/edit/{id}', name: 'app_product_edit')]
    public function edit(Produit $produit,Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProductType::class,$produit);

        $form->handleRequest($request);
        if($form->isSubmitted()&& $form-> isValid()){
            $em->flush();
            return $this->redirectToRoute('app_product_index');
        }
        return $this->render('product/edit.html.twig', [
            'formproduct' => $form->createView()
        ]);
    }

    #[Route('/product/delete/{id}', name: 'app_product_delete')]
    public function delete(Produit $produit, EntityManagerInterface $em): Response
    {
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('app_product_index');
       
    }

}

