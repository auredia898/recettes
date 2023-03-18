<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\LanguageType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //EmailType for input type
            ->add('firstname', TextType::class, [
                'label' => 'Votre Prénom',
                'attr' => [
                    'placeholder' =>'Saisissez votre Prénom'
                ]
            ])

            ->add('lastname', TextType::class,[
                'label' => 'Votre Nom',
                'attr' => [
                    'placeholder' =>'Saisissez votre Nom'
                ]
            ])

            ->add('email', EmailType::class,[
                'label' => 'Votre Email',
                'attr' => [
                    'placeholder' =>'Saisissez votre Email'
                ]
            ])

            ->add('language', LanguageType::class, [
                'label' =>'Langue parlée',
                'attr'=> [
                    'placeholder' => 'Votre langue'
                ]
            ])
            ->add('Country', CountryType::class, [
                'label' =>' Pays',
                'attr' =>[
                    'placeholder' =>'Entrez votre Pays',
                    'class'=>'form-control'
                ]
            ])

            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'les mots de passe ne sont pas identiques',
                'label' => 'Mot de Passe',
                'required' => true,
                # 'contraints' =>new Length(8, 30),
                'first_options' => [
                    'label' => 'Mot de Passe',
                    'attr' => [
                        'placeholder' =>'Choisissez un mot de passe'
                    ]
                ],

                'second_options' =>[
                    'label' => 'Cofirmez votre Mot de Passe',
                    'attr' => [
                        'placeholder' =>'Confirmez votre mot de passe'
                    ]
                ],

            ])

            ->add('submit', SubmitType::class,[
                'label' => "S'inscrire",
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
