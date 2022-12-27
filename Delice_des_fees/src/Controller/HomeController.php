<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig',[
            "title" => "Accueil",
            "message" => "Bienvenue sur le site du Délice des fées !",


        ]);

    }


#[Route('/contact', name: 'contact')]

    public function contact() {


        return $this->render("home/contact.html.twig",[
            "title" => "Contact",
            "message" => "Retrouvez nous ici",

        ]);
    }

    #[Route('/contact/mail', name: 'mail')]
    public function mail(Request $request, ContactNotification $notification){
        $mail = new Contact();
        $form = $this->createForm(ContactType::class, $mail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
                $notification->contactNotify($mail);
                $this ->addFlash('success', "Email envoyé");

        }

        return $this->render("home/mail.html.twig",[
            "title" => "E-mail",
            "message" => "Envoyez un mail",
            "form" => $form->createView()
        ]);
    }


}
