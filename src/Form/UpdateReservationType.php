<?php

namespace App\Form;

use App\Dto\ReservationAboDto;
use App\Entity\Abonnement;
use App\Entity\Renouvellement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IdentifiantAbonnement', EntityType::class, [
                'class' => Abonnement::class,
                'choice_label'=>'nom',
            ])
            ->add('renouvellement', EntityType::class, [
                'class' => Renouvellement::class,
                'choice_label' => 'nom',
                'label' => 'Type de Renouvellement',
            ])->add('ren_auto',CheckboxType::class, ['label'=>'Renouvellement Automatique'])
            ->add('submit', SubmitType::class, ['label' => 'Réserver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationAboDto::class,
        ]);
    }
}
