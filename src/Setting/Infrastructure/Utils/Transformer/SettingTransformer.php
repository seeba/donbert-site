<?php

declare(strict_types=1);

namespace App\Setting\Infrastructure\Utils\Transformer;

use App\Setting\Domain\Model\Setting;
use App\Setting\Domain\Model\SettingId;
use App\Setting\Infrastructure\Entity\Setting as SettingEntity;
use App\Setting\Infrastructure\Repository\SettingRepository;

final class SettingTransformer
{
    public function __construct(
        private SettingRepository $settingRepository
    )
    {
        
    }

    public function fromDomain(Setting $setting)
    {
        $settingEntity = $this->settingRepository->find($setting->getId()->toString());
        if ($settingEntity === null) {
            $settingEntity = new SettingEntity(
                $setting->getId()->toString(),
                $setting->getName(),
                $setting->getData()
            );
        }

        return $settingEntity;

    }

    public function toDomain(SettingEntity $settingEntity)
    {
        return Setting::restore(
            new SettingId($settingEntity->getId()),
            $settingEntity->getName(),
            $settingEntity->getData()
        );
    }
}