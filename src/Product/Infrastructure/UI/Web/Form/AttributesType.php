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

class AttributesType extends AbstractType
{
    public function __construct(
        private CategoryManagerInterface $categoryManager,
        private AttributeServiceInterface $attributeService,
    ) {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder
            ->add('size', ChoiceType::class, [
                'label' => 'Rozmiar',
                'choices' => $this->attributeService->getSizeAttributesToForm(),
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])

            ->add('color', ChoiceType::class, [
                'label' => 'Kolor',
                'choices' => $this->attributeService->getColorAttributesToForm(),
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])

            ->add('thickness', ChoiceType::class, [
                'label' => 'Grubość',
                'choices' => $this->attributeService->getThicknessAttributesToForm(),
                'required' => true,
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('quantityPerRoll', ChoiceType::class, [
                'label' => 'Ilość sztuk na rolce',
                'choices' => $this->attributeService->getQuantityPerRollAttributesToForm(),
                'required' => true,
                'multiple' => false,
                'expanded' => false,
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