<?php

declare(strict_types=1);

namespace App\Setting\Application\DTO;

readonly class SettingDTO
{
    public function __construct(
        private string $name,
        private array $data
    )
    {    
    }

    public function getName()
    {
        return $this->name;
    }

    public function getData()
    {
        return $this->data;
    }

}