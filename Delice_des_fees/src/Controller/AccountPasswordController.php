<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    #[Route('/compte/password', name: 'password')]
    public function index(Request $request, ManagerRegistry $doctrine, UserPasswordHasherInterface $encoder): Response
    {

        $notification = null;

            $user = $this-> getUser();
            $form = $this->createForm(ChangePasswordType::class, $user);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){

                $old_pwd = $form->get('old_password')->getData();

                    if ($encoder->isPasswordValid($user, $old_pwd)){
                        $new_pwd = $form->get('new_password')->getData();
                        $password = $encoder-> HashPassword($user,$new_pwd);

                        $user->setPassword($password);

                $em= $doctrine->getManager();
                $em->persist($user);
                $em->flush();
                $notification ="Votre mot de passe a bien été modifié";

            } else {
                $notification ="Votre mot de passe actuel n'est pas le bon";
            }
        }

        return $this->render('account/password.html.twig',[
            "title" => "Modifier le mot de passe",
            "message" => "Modifiez votre mot de passe",
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
