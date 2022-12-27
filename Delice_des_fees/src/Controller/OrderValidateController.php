<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderValidateController extends AbstractController
{
        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }


        #[Route('/commande/merci/{StripeSessionId}', name: 'order_validate')]
    public function index(Cart $cart, $StripeSessionId): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionId($StripeSessionId);
        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }



            if(!$order->getIsPaid()){

                $cart->remove();
                $order->setIsPaid(1);
                $this->entityManager->flush();
            }




        return $this->render('order_validate/success.html.twig', [

            "title" => "Confirmation de commande",
            "message" => "Votre commande est confirmée",
            'order' => $order,
        ]);
    }
}


