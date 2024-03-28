<?php

declare(strict_types=1);

namespace App\Setting\Infrastructure\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity()]
#[ORM\Table(name:"settings")]
class Setting
{
    #[ORM\Id]
    #[ORM\Column(type:Types::GUID)]
    private string $id;

    #[ORM\Column(type:Types::STRING, length:255)]
    private string $name;

    #[ORM\Column(type:Types::JSON)]
    private string $data;

    public function __construct(
        string $id,
        string $name,
        string $data
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->data = $data;   
    }
}