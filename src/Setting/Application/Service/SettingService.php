<?php

declare(strict_types=1);

namespace App\Setting\Application\Service;

use App\Setting\Application\DTO\SettingDTO;
use App\Setting\Domain\Service\SettingServiceInterface;
use App\Setting\Infrastructure\Utils\Repository\SettingRepository;

class SettingService implements SettingServiceInterface
{
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }
    
    public function getThumbSettings(): SettingDTO
    {
        $setting = $this->settingRepository->findByName('thumbs');

        $settingDTO = new SettingDTO(
            $setting->getName(),
            json_decode($setting->getData(), true)
        );
        
        return $settingDTO;
    }
}