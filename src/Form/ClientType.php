<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Username', null, ['attr' => [
                'placeholder' => "Nom d'utilisateur",
            ],
                "label" => "Nom d'utilisateur"
            ])
            ->add('Email', null, [
                'attr' => [
                    'placeholder' => 'Email',
                ],
                "label" => "Email"
            ])
            ->add('Password', null, [
                'attr' => [
                    'placeholder' => 'Mot de passe',
                ],
                "label" => "Mot de passe"
            ])
            ->add('name', null, [
                'attr' => [
                    'placeholder' => 'Nom',
                ],
                "label" => "Nom"
            ])
            ->add('prenom', null, [
                'placeholder' => 'Prénom',
                "label" => "Prénom"
            ])
            ->add('conditions', CheckboxType::class,
                [
                    'label' => "Conditions d'utilisation",
                    'mapped' => false
                ]
            )
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
