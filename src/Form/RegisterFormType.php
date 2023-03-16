<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //EmailType for input type
            ->add('email', EmailType::class, [
                //llabel form 
                'label' => 'Email',
                'attr' => [
                    //placeholder form
                    'placeholder' =>'Entrez votre email'
                ]
            ])
            ->add('password', PasswordType::class, [
                //llabel form 
                'label' => 'Mot de passe',
                'attr' => [
                    //placeholder form
                    'placeholder' =>'Entrez votre email'
                ]
            ])
            ->add('firstname', TextType::class,[
                //llabel form 
                'label' => 'Firstname',
                'attr' => [
                    //placeholder form
                    'placeholder' =>'Entrez votre nom'
                ]
            ])
            ->add('lastname', TextType::class,[
                //llabel form 
                'label' => 'Lastname',
                'attr' => [
                    //placeholder form
                    'placeholder' =>'Entrez votre prénom'
                ]
            ])
            ->add('language', TextType::class,[
                //llabel form 
                'label' => 'Language',
                'attr' => [
                    //placeholder form
                    'placeholder' =>'Quelle langue parlez-vous?'
                ]
            ])
            ->add('Country', TextType::class,[
                //llabel form 
                'label' => 'Country',
                'attr' => [
                    //placeholder form
                    'placeholder' =>'Entrez votre pays'
                ]
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
