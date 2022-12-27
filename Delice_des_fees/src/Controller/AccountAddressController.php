<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class AccountAddressController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/compte/addresses', name: 'address')]
    public function index(): Response
    {
        return $this->render('account/address.html.twig', [
            "title" => "Vos adresses",
            "message" => "Vous pouvez modifier vos adresses ici",
        ]);
}


#[Route('/compte/ajouter-addresses', name: 'address_add')]
public function add(Cart $cart, Request $request): Response
{
    $address = new Address();

    $form= $this->createForm(AddressType::class, $address);

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        $address->setUser($this->getUser());
        $this->entityManager->persist($address);
        $this->entityManager->flush();
        if ($cart->get()) {
            return $this->redirectToRoute('order');
        }
        return $this->redirectToRoute('address');
    }

    return $this->render('account/address_add.html.twig', [
        "title" => "Ajouter des addresses",
        "message" => "Ajouter des addresses ",
        'form'=> $form->createView(),
    ]);
}



#[Route('/compte/modifier-addresse/{id}', name: 'address_modif')]
public function modifier(Request $request, $id): Response
{
    $address = $this->entityManager->getRepository(Address::class)->findOneById($id);

   if (!$address || $address->getUser() != $this->getUser()){
    return $this->redirectToRoute('address');
   }
$form = $this->createForm(AddressType::class, $address);

   $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()){
        $this->entityManager->flush();
        return $this->redirectToRoute('address');
    }

    return $this->render('account/address_add.html.twig', [
        "title" => "Ajouter des addresses",
        "message" => "Ajouter des addresses ",
        'form'=> $form->createView(),
    ]);
}


#[Route('/compte/supprimer-addresse/{id}', name: 'address_suppr')]
public function supprimer(Request $request, $id): Response
{
    $address = $this->entityManager->getRepository(Address::class)->findOneById($id);

   if ($address && $address->getUser() == $this->getUser()){
        $this->entityManager->remove($address);
        $this->entityManager->flush();

    }

    return $this->redirectToRoute('address');
}

}

