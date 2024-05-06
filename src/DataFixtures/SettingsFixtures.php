<?php

namespace App\DataFixtures;

use App\Setting\Infrastructure\Entity\Setting;
use App\Shared\Application\Service\IdGeneratorInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class SettingsFixtures extends Fixture implements FixtureGroupInterface
{
    public function __construct(
        private IdGeneratorInterface $idGenerator
    )
    {
        
    }
    
    public function load(ObjectManager $manager): void
    {
        $data = [
            'sizes' => [
                [
                    'width' => 900,
                    'height' => 1057
                ],
                [
                    'width' => 250,
                    'height' => 294
                ],
                [
                    'width' => 450,
                    'height' => 514
                ]
                ],
            'background_color' => '#ffffff'
            
        ];

        $jsonData = json_encode($data);

        $setting = new Setting(
            $this->idGenerator->generate()->toString(),
            'thumbs', $jsonData
        );

        $manager->persist($setting);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['thumbs'];
    }
}
