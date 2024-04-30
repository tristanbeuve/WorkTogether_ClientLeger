<?php

namespace App\Form;

use App\Dto\RegisterDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, ['label'=>'Nom :'])
            ->add('prenom', null, ['label'=>'Prénom :'])
            ->add('email', null, [ "label" => "Email :"])
            ->add('agreeTerms', CheckboxType::class, [
                "label" => "J'accepte les Condition d'utilisations",
            ])
            ->add('password', PasswordType::class, [
                "label"=>'Mot de passe :'])
            ->add('passwordConfirmation', PasswordType::class, [
                "label"=>'Confirmation du mot de passe :',
            ])
//                ->add('dateNaiss',DateType::class,[
//                "label" => "Date de Naissance :",
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RegisterDto::class,
        ]);
    }
}
