<?php

declare(strict_types=1);

namespace App\Product\Application\Form;

use App\Product\Application\DTO\CategoryDTO;
use App\Product\Domain\Model\Category;
use App\Product\Domain\Service\CategoryManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    
    public function __construct(
        private CategoryManagerInterface $categoryManager
        )
    {
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('parentId', ChoiceType::class, [
                'choices' => $this->categoryManager->getParentCategoryChoices(),
                'required' => false,
                'placeholder' => 'Wybierz kategorię nadrzędną'
            ])
            ->add('save', SubmitType::class);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            $categoryDTO = $event->getData();

            // Modify the choices based on the current category data
            $this->updateParentCategoryChoices($form, $categoryDTO);
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            // Extract the category data from the submitted form data
            $categoryDTO = new CategoryDTO(
                $data['name'],
                $data['parentId']
            );

            // Modify the choices based on the submitted data
            $this->updateParentCategoryChoices($form, $categoryDTO);
        });
    }
    private function updateParentCategoryChoices($form, $categoryDTO)
    {
        $form->add('parentId', ChoiceType::class, [
            'choices' => $categoryDTO ? $this->categoryManager->getParentCategoryChoices() : [],
            'required' => false,
            'placeholder' => 'Wybierz kategorię nadrzędną',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoryDTO::class,
        ]);
    }
}