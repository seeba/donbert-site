<?php

declare(strict_types=1);

namespace App\Setting\Domain\Repository;

use App\Setting\Domain\Model\Setting;
use App\Setting\Domain\Model\SettingId;

interface SettingRepositoryInterface
{
    public function get(SettingId $id): Setting;

    public function save(Setting $setting): void;

    public function findByName(string $name): Setting;
}