<?php

namespace App\DataFixtures;

use App\Product\Infrastructure\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Shared\Application\Service\IdGeneratorInterface;

class CategoriesFixtures extends Fixture
{
    public function __construct(
        private IdGeneratorInterface $idGenerator
    ) {
    }
    
    public function load(ObjectManager $manager): void
    {
        $categories = [
            [
                'name' => 'Worki sanitarne',
                'parent' => null
            ],
            [
                'name' => 'Worki do selektywnej zbiórki',
                'parent' => null
            ],
            [
                'name' => 'Worki na odpady medyczne',
                'parent' => null
            ]
        ];
            
        
        foreach ($categories as $category) {
            $categoryEntity = new Category(
                $this->idGenerator->generate()->toString(),
                $category['name']
            );
            $manager->persist($categoryEntity);
        }    
         
        $manager->flush();
    }
}
