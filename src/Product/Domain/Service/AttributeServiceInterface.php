<?php

declare(strict_types=1);

namespace App\Product\Domain\Service;

interface AttributeServiceInterface 
{
    public function getSizeAttributesToForm(): array;
    public function getColorAttributesToForm(): array;
    public function getThicknessAttributesToForm(): array;
    public function getQuantityPerRollAttributesToForm(): array;
}