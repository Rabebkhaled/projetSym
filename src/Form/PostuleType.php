<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Annonce;
use App\Entity\Demande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Shapecode\Bundle\HiddenEntityTypeBundle\Form\Type\HiddenEntityType;

class PostuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class , [

                'attr'=>['placeholder' => 'Nom']
            ],
            
       
            
            )
            ->add('tel',TextType::class , [

                'attr'=>['placeholder' => 'Télephone']
            ],
            
       
        
            )
            
            ->add('adresse',TextType::class , [

                'attr'=>['placeholder' => 'Adresse']
            ],
            
       
            
            )
            ->add('formation',TextType::class , [

                'attr'=>['placeholder' => 'Formation']
            ],
            
       
            
            )
            
            ->add('annonce' , HiddenEntityType::class,array (
                'class' => Annonce::class,
               
            ))
            ->add('user', HiddenEntityType::class,array (
                'class' => User::class
            ))

            ->add('brochure', FileType::class, [
                'label' => 'Brochure (PDF file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PDF document',
                    ])
                ],
            ])
            // ...
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);
    }
}
