<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderCancelController extends AbstractController
{
        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }

        #[Route('/commande/erreur/{StripeSessionId}', name: 'order_cancel')]
    public function index($StripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($StripeSessionId);
        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }


        return $this->render('order_cancel/index.html.twig', [

            "title" => "ERREUR DE PAIEMENT !",
            "message" => "Votre commande a rencontré une erreur de paiement",
            'order' => $order,
        ]);
    }
}


