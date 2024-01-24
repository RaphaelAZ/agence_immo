<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserLoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('_username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'attr' => ['class' => 'form-control', 'name'=> '_username'],
            ])
            ->add('_password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => ['class' => 'form-control', 'name'=> '_password'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }

    public function getBlockPrefix(): string {
        return '';
    }
}
