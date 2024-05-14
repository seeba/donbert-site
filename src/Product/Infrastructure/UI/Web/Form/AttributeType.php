<?php

declare(strict_types=1);

namespace App\Product\Infrastructure\UI\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSetDataEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\NotBlank;

class AttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                    'label' => 'Typ atrybutu',
                    'choices' => [
                        'Kolor' => 'color',
                        'Rozmiar' => 'size',
                        'Grubość' => 'thickness',
                        'Ilość sztuk' => 'quantity_per_roll'
                    ]
            ])
            ->add('submit', SubmitType::class, ['label' => 'Dalej'])
            ->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'onPreSubmitData'] );
    }

    public function onPreSubmitData(FormEvent $event)
    {
        $data = $event->getData();
        
        $form = $event->getForm();
        $form
            ->add('name', TextType::class,[
                'label' => 'Nazwa atrybutu'
                ])
            ->remove('submit')
            ->add('submit', SubmitType::class, ['label' => 'Zapisz']);
       
       $type = $data['type'] ?? null;
        if ($type === 'color') {
            $form
                ->add('color', TextType::class, [
                    'label' => 'Kolor',
                    'constraints' => [
                        new NotBlank()
                    ]    
                ]);
        

        } elseif ($type === 'size') {
            $form
                ->add('width', TextType::class, [
                    'label' => 'Szerokość',
                    'constraints' => [
                        new NotBlank()
                    ]
                ])
                ->add('height', TextType::class, [
                    'label' => 'Wysokość',
                    'constraints' => [
                        new NotBlank()
                    ]
                ]);
            
        } elseif ($type === 'thickness') {
            $form
                ->add('thickness', TextType::class, [
                    'label' => 'Grubość',
                    'constraints' => [
                        new NotBlank()
                    ]    
                ]);

        } elseif ($type === 'quantity_per_roll') {
            $form
            ->add('thickness', TextType::class, [
                'label' => 'Ilość sztuk na rolce/ w paczce',
                'constraints' => [
                    new NotBlank()
                ]    
            ]);
        } else {
            $form
                ->remove('color')
                ->remove('width')
                ->remove('height');      
        }
    }
}