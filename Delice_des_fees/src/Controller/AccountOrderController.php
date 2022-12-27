<?php

namespace App\Controller;

use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountOrderController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte/mes-commandes', name: 'account_order')]
    public function index(): Response
    {

            $orders = $this->entityManager->getRepository(Order::class)
            ->findSuccesOrders($this->getUser());




        return $this->render('account/order.html.twig', [
            "title" => "Mes commandes",
            "message" => "Vous pouvez voir vos commandes ici",
            'orders' =>$orders
        ]);
    }

    #[Route('/compte/mes-commandes/{reference}', name: 'account_order_show')]
    public function show($reference): Response
    {

            $order = $this->entityManager->getRepository(Order::class)
            ->findOneByReference($reference);

            if (!$order || $order->getUser() != $this->getUser()){
                return $this->redirectToRoute('account_order');
            }



        return $this->render('account/order_show.html.twig', [
            "title" => "Ma commande",
            "message" => "Ma commande",
            'order' =>$order
        ]);
    }
}
