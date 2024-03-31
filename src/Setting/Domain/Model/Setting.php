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

    public static function create(
        SettingId $id,
        string $name,
        string $data
    ): self 
    {
        return new self($id, $name, $data);
    }

    public static function restore(
        SettingId $id,
        string $name,
        string $data
    ): self 
    {
        return new self($id, $name, $data);
    }

    public function getId() 
    {
        return $this->id;
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