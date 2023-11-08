<?php

namespace App\Form;

use App\Entity\Abonnement;
use App\Entity\Renouvellement;
use App\Entity\Reservation;
use phpDocumentor\Reflection\Types\Boolean;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                "label" => "Abonnement",
                'choice_label'=>'nom',
            ])
            ->add('Numero', null, ['label'=>'Numéro'])
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
            ->add('quantity', null, ['label' => 'Quantité'])
            ->add('renouvellement', EntityType::class, [
                'class' => Renouvellement::class,
                'choice_label' => 'nom',
                'label' => 'Type de Renouvellement',
                ])
            ->add('ren_auto',null, ['label' => 'Renouvellement Automatique'] )
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}