<?php

declare(strict_types=1);

namespace App\Setting\Domain\Model;

final class Setting 
{
    private function __construct(
        private SettingId $id,
        private string $name,
        private string $data
    )
    {
        
    }
}