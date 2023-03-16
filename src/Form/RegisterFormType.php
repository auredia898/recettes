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
            ->add('roles')
            ->add('password')
            ->add('firstname')
            ->add('lastname')
            ->add('language')
            ->add('Country')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
