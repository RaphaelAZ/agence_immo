<?php

namespace App\Form;

use App\Entity\Announce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnounceCreateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre :',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix :',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('surface', NumberType::class, [
                'label' => 'Surface :',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Maison' => 'Maison',
                    'Appartement' => 'Appartement',
                    'Studio' => 'Studio',
                    'Local' => 'Local',
                ],
                'label' => 'Type :',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('location', TextType::class, [
                'label' => 'Emplacement :',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description :',
                'required' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('image', FileType::class, [
                'label' => 'Image :',
                'required' => true,
                'data_class' => null,
                'attr' => ['class' => 'form-control'],
            ])
            // ->add('creation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announce::class,
        ]);
    }
}
