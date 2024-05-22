<?php

namespace App\DataFixtures;

use App\Product\Infrastructure\Entity\Attribute\ColorAttribute;
use App\Product\Infrastructure\Entity\Attribute\QuantityPerRollAttribute;
use App\Product\Infrastructure\Entity\Attribute\SizeAttribute;
use App\Product\Infrastructure\Entity\Attribute\ThicknessAttribute;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Shared\Application\Service\IdGeneratorInterface;

class AttributesFixtures extends Fixture
{
    public function __construct(
        private IdGeneratorInterface $idGenerator
    ) {
    }
    
    public function load(ObjectManager $manager): void
    {
        $colors = [
            [
                'name' => 'Biały',
                'hex' => '#FFFFFF'
            ],
            [
                'name' => 'Niebieski',
                'hex' => '#0000FF'
            ],
            [
                'name' => 'Żółty',
                'hex' => '#FFFF00'
            ],
            [
                'name' => 'Zielony',
                'hex' => '#008000'
            ],
            [
                'name' => 'Brązowy',
                'hex' => '#A52A2A'
            ],
            [
                'name' => 'Czarny',
                'hex' => '#000000'
            ],
        ]; 

        $thickness = [
            [
                'name' => '0,025',
                'thickness' => '0.025'
            ],
            [
                'name' => '0,03',
                'thickness' => '0.03'
            ],
            [
                'name' => '0,035',
                'thickness' => '0.035'
            ],
            [
                'name' => '0,04',
                'thickness' => '0.04'
            ],
            [
                'name' => '0,05',
                'thickness' => '0.05'
            ],
            [
                'name' => '0,06',
                'thickness' => '0.06'
            ],
            [
                'name' => '0,07',
                'thickness' => '0.07'
            ],
            [
                'name' => '0,08',
                'thickness' => '0.08'
            ],
            [
                'name' => '0,10',
                'thickness' => '0.10'
            ],
        ];

        $sizes = [
            [
                'name' => '500x950',
                'width' => 500,
                'height' => 950
            ],
            [
                'name' => '600x800',
                'width' => 600,
                'height' => 800
            ],
            [
                'name' => '700x1050',
                'width' => 700,
                'height' => 1050
            ],
            [
                'name' => '500x600',
                'width' => 500,
                'height' => 600
            ],
            [
                'name' => '700x1100',
                'width' => 700,
                'height' => 1100
            ],
            [
                'name' => '910x1100',
                'width' => 910,
                'height' => 1100
            ],
            [
                'name' => '1010x1250',
                'width' => 1010,
                'height' => 1250
            ],
            [
                'name' => '500x670',
                'width' => 500,
                'height' => 670
            ],
            [
                'name' => '1200x1500',
                'width' => 1200,
                'height' => 1500
            ],
            [
                'name' => '500x950',
                'width' => 500,
                'height' => 950
            ],
        ];

        $quantitiesPerRoll = [
            [
                'name' => '5 szt',
                'quantity' => 5
            ],
            [
                'name' => '10 szt',
                'quantity' => 10
            ],
            [
                'name' => '15 szt',
                'quantity' => 15
            ],
            [
                'name' => '20 szt',
                'quantity' => 20
            ],
            [
                'name' => '25 szt',
                'quantity' => 25
            ],
        ];
        
        foreach ($colors as $color) {
            $colorAttr = new ColorAttribute(
                $this->idGenerator->generate()->toString(),
                $color['name'],
                $color['hex']
            );
            $manager->persist($colorAttr);
        }    
        
        foreach ($sizes as $size) {
            $sizeAttr = new SizeAttribute(
                $this->idGenerator->generate()->toString(),
                $size['name'],
                $size['width'],
                $size['height']
            );
            $manager->persist($sizeAttr);
        }

        foreach ($thickness as $t) {
            $thicknessAttr = new ThicknessAttribute(
                $this->idGenerator->generate()->toString(),
                $t['name'],
                $t['thickness']
            );
            $manager->persist($thicknessAttr);
        }

        foreach ($quantitiesPerRoll as $quantity) {
            $quantityAttr = new QuantityPerRollAttribute(
                $this->idGenerator->generate()->toString(),
                $quantity['name'],
                $quantity['quantity']
            );
            $manager->persist($quantityAttr);
        }
        
        $manager->flush();
    }
}
