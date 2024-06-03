<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Form;

use App\Product\Application\DTO\VariantDTO;
use App\Product\Domain\Service\AttributeServiceInterface;
use App\Product\Domain\Service\CategoryManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantType extends AbstractType
{
    public function __construct(
        private CategoryManagerInterface $categoryManager,
        private AttributeServiceInterface $attributeService,
    ) {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('name', TextType::class, [
               
                'label' => 'Nazwa wariantu'
             ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Zdjęcia',
            
                'attr' => [
                    'class' => 'collection-images',
                   
                ]
                
            ])
            ->add('attributes', VariantAttributesType::class, [
                'label' => 'Rozmiar',

            ])
            ->add('save', SubmitType::class, [
                'label' => 'Zapisz'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => VariantDTO::class,
        ]);
    }
}