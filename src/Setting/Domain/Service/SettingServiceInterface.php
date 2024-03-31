<?php

declare(strict_types=1);

namespace App\Setting\Domain\Service;

use App\Setting\Application\DTO\SettingDTO;

interface SettingServiceInterface
{
    public function getThumbSettings(): SettingDTO;
}