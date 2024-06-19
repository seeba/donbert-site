<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Form;

use App\Product\Application\DTO\ProductDTO;
use App\Product\Domain\Service\CategoryManagerInterface;
use App\Product\Infrastructure\UI\Web\Form\Attributes\SizeAttributeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function __construct(
        private CategoryManagerInterface $categoryManager
    ) {
    }
     
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa produktu'
             ])
            ->add('categoriesIds', ChoiceType::class, [
                'choices' => $this->categoryManager->getParentCategoryChoices(),
                'required' => true,
                'multiple' => true,
                'expanded' => true,     
            ])
            ->add('size', SizeAttributeType::class, [
                'label' => 'Rozmiar'
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label' => 'Zdjęcia',
            
                'attr' => [
                    'class' => 'collection-images',     
                ]           
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
          'data_class' => ProductDTO::class,
        ]);
    }
}