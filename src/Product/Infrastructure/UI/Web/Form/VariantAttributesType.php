<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Form;

use App\Product\Application\DTO\VariantAttributesDTO;
use App\Product\Application\DTO\VariantDTO;
use App\Product\Domain\Service\AttributeServiceInterface;
use App\Product\Domain\Service\CategoryManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantAttributesType extends AbstractType
{
    public function __construct(
        private AttributeServiceInterface $attributeService,
    ) {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('size', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'input-group'
                    ],
                    'label_attr' => [
                        'class' => 'input-group-text'
                    ],
                    'attr' => [
                        'class' =>'form-control'
                    ], 
                    'choices' => $this->attributeService->getSizeAttributesToForm(),
                    'multiple' => false,
                    'expanded' => false,
                ],
                'label' => 'Rozmiar',
                'required' => true,
                'allow_add' => true,
                'allow_delete' => true,
                
            ])
            ->add('color', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'input-group'
                    ],
                    'label_attr' => [
                        'class' => 'input-group-text'
                    ],
                    'attr' => [
                        'class' =>'form-control'
                    ], 
                    'choices' => $this->attributeService->getColorAttributesToForm(),
                    'multiple' => false,
                    'expanded' => false,
                ],
                'label' => 'Kolor',
                'required' => true,
                'allow_add' => true,
                'allow_delete' => true,
                
            ])
            ->add('thickness', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'input-group'
                    ],
                    'label_attr' => [
                        'class' => 'input-group-text'
                    ],
                    'attr' => [
                        'class' =>'form-control'
                    ], 
                    'choices' => $this->attributeService->getThicknessAttributesToForm(),
                    'multiple' => false,
                    'expanded' => false,
                ],
                'label' => 'Grubość',
                'required' => true,
                'allow_add' => true,
                'allow_delete' => true,
                
            ])
            ->add('quantityPerRoll', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'row_attr' => [
                        'class' => 'input-group'
                    ],
                    'label_attr' => [
                        'class' => 'input-group-text'
                    ],
                    'attr' => [
                        'class' =>'form-control'
                    ], 
                    'choices' => $this->attributeService->getQuantityPerRollAttributesToForm(),
                    'multiple' => false,
                    'expanded' => false,
                ],
                'label' => 'Ilość worków na rolce',
                'required' => true,
                'allow_add' => true,
                'allow_delete' => true,
                
            ])
            
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => VariantAttributesDTO::class,
        ]);
    }
}