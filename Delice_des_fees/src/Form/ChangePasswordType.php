<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'disabled' => true,
            ])
            ->add('old_password',PasswordType::class, [
                'label' => "Mot de passe actuel",
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                ],
            ])
            ->add('firstname', TextType::class, [
                'disabled' => true,
            ])

            ->add('lastname', TextType::class, [
                'disabled' => true,
            ])



            ->add('new_password', RepeatedType::class, [
                'type'=> PasswordType::class,
                'constraints' => new Length ([
                    'min' => 8,
                ]),
                'mapped' => false,
                'required' => true,
                'first_options' =>  ['label' => "Mon nouveau mot de passe"
                ,
                'attr'=>['placeholder' => "Merci d'entrer votre nouveau mot de passe"]
                ],
                'second_options' => ['label' => "Confirmez votre nouveau mot de passe",
                'attr'=>['placeholder' =>"Merci de confirmer votre mot de passe"
                ]],
                'invalid_message'=>'Les deux mots de passe ne correspondent pas',
                ]
            )


        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
