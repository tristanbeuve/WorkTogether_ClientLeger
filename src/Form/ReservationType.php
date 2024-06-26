<?php

namespace App\Form;

use App\Dto\ReservationAboDto;
use App\Entity\Abonnement;
use App\Entity\Renouvellement;
use App\Entity\Reservation;
use Doctrine\DBAL\Types\BooleanType;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('IdentifiantAbonnement', EntityType::class, [
                'class' => Abonnement::class,
                'choice_label'=>'nom',
                'label'=>'Abonnement :',
            ])
//            ->add('Numero', null, ['label'=>'Numéro'])
//            ->add('dateDeb' , DateType::class, [
//                'label' => 'Date de Début',
//        'widget' => 'single_text',
//        'html5' => false,
//        'attr' => ['class' => 'js-datepicker'],
//    ])
//            ->add('dateEnd', DateType::class, [
//                'label' => 'Date de Fin',
//        'widget' => 'single_text',
//        'html5' => false,
//        'attr' => ['class' => 'js-datepicker'],
//    ])
            ->add('renouvellement', EntityType::class, [
                'class' => Renouvellement::class,
                'choice_label' => 'nom',
                'label' => 'Type de Renouvellement :',
                ])
            ->add('ren_auto',CheckboxType::class, ['label'=>'Renouvellement Automatique'])
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
