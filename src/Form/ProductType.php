<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\Category;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Positive;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',null,[
                'label' => 'Nom du produit',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un nom pour ce produit'
                    ]),
                    new Length([
                        'min'=> 4,
                        'minMessage' => 'Le nom doit contenir au moins 4 caractères',
                        'max' => 40,
                        'maxMessage' => 'Le nom doit contenir au plus 40 caractères'
                    ])
                ]
            ])
            ->add('price',MoneyType::class,[
                'label' => 'Prix du produit',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un prix pour ce produit'
                    ]),
                    new Positive([
                        'message' => 'Le prix doit être un nombre positif'
                    ])  
                ]   

            ])
            ->add('description' , null,[
                'label' => false,
                'help' => 'Ecrire une description pour ce produit',
                'help_attr' => [
                    'class' => 'text-info',
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'La description doit contenir au moins 10 caractères',
                        'max' => 300,
                        'maxMessage' => 'La description doit contenir au plus 100 caractères'
                    ])
                ]
            ])
            ->add('quantity')
            ->add('ajouter',SubmitType::class)
            ->add('category', EntityType::class , [
                'class' => Category::class,
                'choice_label' => 'name',
                'expanded' => false, // Un select qui devient liste déroulante (radio / checkbox)
                'label' => 'Catégorie',
                'placeholder' => 'Choisir une catégorie',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir une catégorie'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
