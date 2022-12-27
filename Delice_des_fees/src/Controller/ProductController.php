<?php

namespace App\Controller;

use App\Entity\Products;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
    public function index(): Response
    {
        return $this->render('product/choix.html.twig', [
        "title" => "Glaces",
        "message" => "Nos glaces",

        ]);
    }


    #[Route('/product/glaces', name: 'glaces')]
    public function glaces(ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Products::class);
        $glaces = $repository->findBy(
            ['category' => 1],
            ['name' => 'ASC'],


        );



        return $this->render("product/glaces.html.twig",[
            "title" => "Les glaces",
            "message" => "Glaces",
            "glaces" => $glaces


        ]);

    }

    #[Route('/product/boules', name: 'boules')]
    public function boules(ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Products::class);
        $boules = $repository->findBy(
            ['category' => 2],
            ['name' => 'ASC'],


        );


        return $this->render("product/boules.html.twig",[
            "title" => "Les glaces en boule",
            "message" => "Les glaces en boule",
            "boules" => $boules


        ]);

    }

    #[Route('/product/bonbons', name: 'bonbons')]
    public function bonbons (ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Products::class);
        $bonbons = $repository->findBy(
            ['category' => 3],
            ['name' => 'ASC'],


        );


        return $this->render("product/bonbons.html.twig",[
            "title" => "Les bonbons",
            "message" => "Nos bonbons",
            "bonbons" => $bonbons


        ]);

    }

    #[Route('/product/boissons', name: 'boissons')]
    public function boissons (ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Products::class);
        $boissons = $repository->findBy(
            ['category' => 4],
            ['name' => 'ASC'],


        );


        return $this->render("product/boissons.html.twig",[
            "title" => "Les boissons",
            "message" => "Nos boissons",
            "boissons" => $boissons


        ]);

    }


    #[Route('/product/alcools', name: 'alcools')]
    public function alcools (ManagerRegistry $doctrine)
    {
        $repository = $doctrine->getRepository(Products::class);
        $alcools = $repository->findBy(
            ['category' => 5],
            ['name' => 'ASC'],


        );


        return $this->render("product/alcools.html.twig",[
            "title" => "Les alcools",
            "message" => "Nos Alcools",
            "alcools" => $alcools


        ]);

    }
    }


