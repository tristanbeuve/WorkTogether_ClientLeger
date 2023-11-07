<?php

namespace App\Form;

use App\Entity\Baie;
use App\Entity\Reservation;
use App\Entity\TypeUnite;
use App\Entity\Unite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UniteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero', null, [
                "label" => "Numéro"
            ])
            ->add('IdentifiantTypeUnite', EntityType::class, [
                'class' => TypeUnite::class,
                "label" => "Type",
                'choice_label'=>'nom',
            ])
            ->add('IdentifiantBaie', EntityType::class, [
                "class" => Baie::class,
                "label" => "Numéro de Baie",
                'choice_label'=>'id',
            ])
            ->add('status', null, [
                "label" => "Statut"
            ])
//            ->add('IdentifiantReservation', EntityType::class, [
//                'class' => Reservation::class,
//                "label" => "Reservation",
//                'choice_label'=>'name',
//            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Unite::class,
        ]);
    }
}
