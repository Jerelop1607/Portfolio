<?php
namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => "Entrez votre prénom",
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' =>'Votre nom',
                'attr' => [
                    'placeholder' => "Entrez votre nom",
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse e-mail',
                'attr' => [
                    'placeholder' => "Entrez votre email",
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'=> PasswordType::class,

                'required' => true,
                'first_options' =>  ['label' => "Entrez votre mot de passe",
                'attr'=>['placeholder' => "Merci d'entrer votre mot de passe"]
                ],
                'second_options' => ['label' => "Confirmez votre mot de passe",
                'attr'=>['placeholder' =>"Merci de confirmer votre mot de passe"
                 ]
            ],
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
