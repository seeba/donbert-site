<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Form\Attributes;

use App\Product\Domain\Service\AttributeServiceInterface;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SizeAttributeType extends AbstractType
{
    public function __construct(
       private AttributeServiceInterface $attributeService
    ) {
    }
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('size', ChoiceType::class, [
                'label' => 'Rozmiar',
                'choices' => $this->attributeService->getSizeAttributesToForm(),
                'required' => false,
                'row_attr' => [
                    'class' => 'form-check'
                ],
                'label_attr' => [
                    'class' => 'form-check-label'
                ],
                'attr' => [
                    'class' =>'form-check-input'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
    
        ]);
    }
}